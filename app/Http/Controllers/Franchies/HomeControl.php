<?php 
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Rider;
use DataTables;
use DB;
use Exception;
use Throwable;
use Log;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;

class HomeControl extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Zone::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){    
                        $btn = '<a href="'.route('zone.assign.map_polygon',$row->id).'" type="button" class="btn btn-primary btn-padding-fs btn-margin ml-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Assign Geofencing"><b>Assign Geofencing</b></a><br>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('welcome');
    }

    public function assignMapPolygon($id){

        $zone = Zone::find($id);

        if (empty($zone) || is_null($zone)) {
            return redirect()->route('index');
        }

        $currentPolygon = $currentPolygonLatLng = [];
        // check if polygon points exist than only create polygon array
        if(!empty($zone->map_polygon) && method_exists($zone->map_polygon,'getLineStrings') && !empty($zone->map_polygon->getLineStrings()) && isset($zone->map_polygon->getLineStrings()[0]) && !empty($zone->map_polygon->getLineStrings()[0]) ){
            foreach ($zone->map_polygon->getLineStrings()[0]->getPoints() as $value) {
                $currentPolygonLatLng[] = [
                    'lat'=>$value->getLat(),
                    'lng'=>$value->getLng()
                ];
            }
        }

        // if polygon points exist than create polygon object for frontend map
        if(!empty($currentPolygonLatLng)){
            $currentPolygon =[
                "path"=> $currentPolygonLatLng,
                "strokeColor"=> "#1f9d57",
                "strokeOpacity"=> 0.8,
                "strokeWeight"=> 2,
                "fillColor"=> "#00FF00",
                "fillOpacity"=> 0.4,
                "city_latitude"=>$zone->city_latitude,
                "city_longitude"=>$zone->city_longitude,
                "zone_center_latitude"=>$zone->zone_center_latitude ?? ($zone->city_latitude ?? 28.7041),
                "zone_center_longitude"=>$zone->zone_center_longitude ?? ($zone->city_longitude ?? 77.1025),
                "zone_name"=>$zone->name,
                "id"=>$zone->id,
                "label"=>$zone->name."[$zone->city_full_address]",
            ];
        }

        // check if city is added than pick city lat long else New Delhi lat long
        $mapCenter = [
            'lat'=>!empty($zone->city_latitude) ? $zone->city_latitude : 28.7041,
            'lng'=>!empty($zone->city_longitude) ? $zone->city_longitude : 77.1025
        ];

        return view('mapPolygon',compact('id','zone','mapCenter','currentPolygon'));
    }

    public function assignMapPolygonStore(Request $request){
        $input = $request->all();

        //DB Transaction start
        DB::beginTransaction();
            $zone = Zone::find($input['zone_id']);
            // declare a point array to assign in linestring
            $polygon_points = [];
            foreach ($input['map_polygon'] as $value) {
                // create a new point array for each polygon points
                $polygon_points[] = new Point($value['lat'], $value['lng']);
            }

            // pass first position value as last to complete the polygon
            $polygon_points[] = new Point($input['map_polygon'][0]['lat'], $input['map_polygon'][0]['lng']);

            // create a polygon from linestring and point array & assign polygon to zone object
            $zone->map_polygon = new Polygon([new LineString($polygon_points)]);
            
            $zone_center = isset($input['polygon_center']) && !empty($input['polygon_center']) ? $input['polygon_center'] : [];
            $zone->zone_center_latitude = $zone_center['lat'] ?? NULL;
            $zone->zone_center_longitude = $zone_center['lng'] ?? NULL;

            // save updated polygon
            $zone->save();

            DB::commit();
            return response()->json(['success'=>'Zone Geofencing saved successfully']);
        try {

        }catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            report($e);
            return response()->json(['dberror'=>config('celcius.operation_dbtransaction_message')]);
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            report($e);
            return response()->json(['dberror'=>config('celcius.operation_dbtransaction_message')]);
            //throw $e;
        }
        //DB Transaction End
    }

    public function assignMapPolygonClear(Request $request){
        $input = $request->all();
        $zone = Zone::find($input['zone_id']);

        //DB Transaction start
        DB::beginTransaction();

        try {
            $zone->map_polygon = NULL;
            $zone->zone_center_latitude = NULL;
            $zone->zone_center_longitude = NULL;
            $zone->save();

            DB::commit();
            return response()->json(['success'=>'Zone Geofencing cleared successfully']);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            report($e);
            return response()->json(['dberror'=>config('celcius.operation_dbtransaction_message')]);
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            report($e);
            return response()->json(['dberror'=>config('celcius.operation_dbtransaction_message')]);
            //throw $e;
        }
        //DB Transaction End
    }

    public function createRider(){
        return view('riderCreate');
    }

    public function createRiderStore(Request $request){
        $input = $request->all();
        $latitude = $input['from_latitude'];
        $longitude = $input['from_longitude'];

        $location = findZoneByLatLng($latitude,$longitude);

        if(!empty($location)){
            $input['zone_id'] = $location->id;
            Rider::create($input);
            return redirect()->route('index');
        }else{
            return "<center><h1>No Location Found</h1></center>";
        }
    }
}