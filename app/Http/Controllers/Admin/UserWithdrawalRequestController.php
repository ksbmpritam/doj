<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\UserWithdrawalRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserTransactionMail;
use App\Mail\UserTransactionCancelMail;
use Illuminate\Support\Facades\Log;

class UserWithdrawalRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        // $user = UserWithdrawalRequest::with('customer')->get();
        $user = UserWithdrawalRequest::with('customer')
        ->orderBy('status', 'asc') // Order by status in ascending order
        ->latest() // Then order by creation date in descending order
        ->get();
        // dd($user);
        return view("admin.user_request.index",compact('user'));
    }
    
    public function edit($id){
        $user = UserWithdrawalRequest::findOrFail($id);
        return view("admin.user_request.edit",compact('user'));
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
    
            $user = UserWithdrawalRequest::findOrFail($id);
    
            if ($request->hasFile('image')) {
                $oldImagePath = public_path('images/user/transaction/') . $user->profile_image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
    
                $image = $request->file('image');
                $profileImage = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/user/transaction/'), $profileImage);
    
                $user->image = $profileImage;
            }
    
            $rest_data = Customer::findOrFail($user->customer_id);
            // dd($rest_data);
            if ($request->status == 3) {
                $updatedWalletAmount = max(0, $rest_data->total_wallet - $user->amount);
                
                $rest_data->total_wallet = $updatedWalletAmount;
                // dd($rest_data->wallet_amount);
                if ($rest_data->email) {
                    $emailData = [
                        'name' => $rest_data->name,
                        'updated_wallet_amount' => $rest_data->total_wallet,
                    ];
                    Mail::to($rest_data->email)->send(new UserTransactionMail($emailData));
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
                            'name' => $rest_data->name,
                            'updated_wallet_amount' => $rest_data->total_wallet,
                        ];
                        Mail::to($rest_data->email)->send(new UserTransactionCancelMail($emailData));
                        if($rest_data->fcm_token){
                            
                            $this->successNotificationSend($rest_data->fcm_token, $emailData, $request->status);
                        }  
                    }
                }
            }
    
            $user->status = $request->input('status');
    
            if ($user->save()) {
                $rest_data->save();
                DB::commit(); // Commit the transaction
                return redirect()->route('admin.user.withdrawal.request')->with('success', 'Status updated successfully.');
            }
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction on exception
            return redirect()->route('admin.user.withdrawal.request')->with('error', 'Failed to update status.');
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
