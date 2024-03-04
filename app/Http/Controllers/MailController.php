<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
  
class MailController extends Controller
{
    
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];
        
        Mail::to('ksbmpritam@gmail.com')->send(new DemoMail($mailData));
           
        if (Mail::failures()) {
            return "Email could not be sent.";
        }

        return "Email is sent successfully.";    
        
    }
}