<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\DriverWithdrawalRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\DriverTransactionMail;
use App\Mail\DriverTransactionCancelMail;
use Illuminate\Support\Facades\Log;

class DriverWithdrawalRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        // $driver = DriverWithdrawalRequest::with('driver')->get();
        $driver = DriverWithdrawalRequest::with('driver')
        ->orderBy('status', 'asc') // Order by status in ascending order
        ->latest() // Then order by creation date in descending order
        ->get();
        // dd($driver);
        return view("admin.driver_request.index",compact('driver'));
    }
    
    public function edit($id){
        $driver = DriverWithdrawalRequest::findOrFail($id);
        return view("admin.driver_request.edit",compact('driver'));
    }
    
    

    public function update(Request $request, $id)
    {
        DB::beginTransaction(); // Start a database transaction
        
        try {
            $validation = Validator::make($request->all(), [
                'status' => 'required|string|max:255',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }
    
            $driver = DriverWithdrawalRequest::findOrFail($id);
    
            if ($request->hasFile('image')) {
                // dd($request->hasFile('image'));
                $oldImagePath = public_path('images/driver/transaction/') . $driver->image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
    
                $image = $request->file('image');
                $profileImage = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/driver/transaction/'), $profileImage);
    
                $driver->image = $profileImage;
            }
    
            $rest_data = Driver::findOrFail($driver->driver_id);
            // dd($rest_data);
            if ($request->status == 3) {
                $updatedWalletAmount = max(0, $rest_data->wallet - $driver->amount);
                
                $rest_data->wallet = $updatedWalletAmount;
        
                if ($rest_data->email) {
                    $emailData = [
                        'name' => $rest_data->first_name .''.$rest_data->last_name,
                        'updated_wallet' => $rest_data->wallet,
                    ];
                    // dd($emailData);
                    Mail::to($rest_data->email)->send(new DriverTransactionMail($emailData));
                    if($rest_data->fcm_token){
                        // dd($rest_data->fcm_token);
                        $this->successNotificationSend($rest_data->fcm_token, $emailData, $request->status);
                    }   
                }
            }
            elseif($request->status == 2){
                if ($rest_data->save()) {
                    if ($rest_data->email) {
                        $emailData = [
                            'name' => $rest_data->first_name .''.$rest_data->last_name,
                            'updated_wallet' => $rest_data->wallet,
                        ];
                        Mail::to($rest_data->email)->send(new DriverTransactionCancelMail($emailData));
                        if($rest_data->fcm_token){
                            
                            $this->successNotificationSend($rest_data->fcm_token, $emailData, $request->status);
                        }  
                    }
                }
            }
    
            $driver->status = $request->input('status');
    
            if ($driver->save()) {
                $rest_data->save();
                DB::commit(); // Commit the transaction
                return redirect()->route('admin.driver.withdrawal.request')->with('success', 'Status updated successfully.');
            }
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction on exception
            return redirect()->route('admin.driver.withdrawal.request')->with('error', 'Failed to update status.');
        }
    }
    private function successNotificationSend($fcm_token,$emailData, $status)
    {
        $fcm = $fcm_token;
        // dd($fcm);
        if($status == 3){
            $notification = array(
                'title' => 'Transaction Success',    
                'body' => 'Your requested amount is successfully Credited.',
                // 'image' => $data['image_url'],
            );
        }
        elseif($status == 2){
            $notification = array(
                'title' => 'Transaction Cancel',    
                'body' => 'Your requested amount is Canceled.',
                // 'image' => $data['image_url'],
            );
        }
        $data = array(
            'title' => 'title',    
            'body' => 'description',
            'type' => 'schedule'
        );
        
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            "to" => $fcm,
            "collapse_key" => "type_a",
            "notification" => $notification,
            "data" => $data
        );
            
        $fields = json_encode($fields, true);
        $headers = array(
            'Authorization: key=AAAA7DzmY8Q:APA91bFiESWHN5VYdm-0QBljhZwJLXQn_pQ-2vVTa3HQ12dn4rG51YJxYEhozXfvKovoUcmyyNT-wHgFdQ_QP699q1d217owQLiC1mlLC_EQ8b4gEQZcisR2g9TPtUj68rGSwVPEf2Qc',
            'Content-Type:  application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        // dd($result);
        Log::info('check user '. $result);
        curl_close($ch);
        // echo $result;
    }
}