<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Polygon;

class PolygonController extends Controller
{

    public function index()
    {
        $polygons = Polygon::all();
        return view('employee.zone.index', compact('polygons'));
    }

    public function create()
    {
        return view('employee.zone.create');
    }

  
    public function storeee(Request $request)
    {
        $polygonData = $request->input('polygonData');
        $polygonName = $request->input('polygonName');
        $ppolygonDescription = $request->input('polygonDescription');
        $otherField = $request->input('otherField');
        $anotherField = $request->input('anotherField');

        // Create a new polygon instance
        $polygon = new Polygon();
        $polygon->coordinates = $polygonData;
        $polygon->polygonName = $polygonName;
        $polygon->ppolygonDescription = $ppolygonDescription;
        $polygon->otherField = $otherField;
        $polygon->anotherField = $anotherField;
        // Save the polygon
        $polygon->save();
        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'polygonId' => 'sometimes|integer', 
            'polygonName' => 'required|string',
            'polygonDescription' => 'required|string',
            'otherField' => 'string',
            'anotherField' => 'string',
            'polygonData' => 'required|json', 
        ]);

        $data = [
            'polygonName' => $validatedData['polygonName'],
            'ppolygonDescription' => $validatedData['polygonDescription'],
            'otherField' => $validatedData['otherField'],
            'anotherField' => $validatedData['anotherField'],
            'coordinates' => json_decode($validatedData['polygonData'], true), // Decode JSON coordinates
        ];

        // Determine whether to create or update the Polygon model
        if ($validatedData['polygonId']) {
            // Update an existing polygon based on polygonId
            $polygon = Polygon::where('id', $validatedData['polygonId'])->update($data);
        }

        // Return a response indicating success or failure
        if ($polygon) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    public function edit($id)
    {
        $polygon = Polygon::findOrFail($id);
        $polygonCoordinates = json_decode($polygon->coordinates);

        return view('polygons_edit', compact('polygon', 'polygonCoordinates'));
    }

}
