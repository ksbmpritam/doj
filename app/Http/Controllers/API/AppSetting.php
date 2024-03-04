<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\About;
use App\Models\TermsCondition;
use App\Models\PrivacyPolicy;
use App\Models\Faq;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Models\Restaurant;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\HelpWithUs;
use App\Models\Feedback;

class AppSetting extends Controller
{
    public function get_data(Request $request)
    {
        
        if ($request->roles === 'partner') {
            
            $data['restaurant'] = Restaurant::all(); 
            return response()->json($data);
            
        } elseif ($request->roles === 'driver') {
            
            $data['drivers']  = Driver::all();
            return response()->json($data);
            
        }elseif($request->roles === 'customer'){
            
            $data['customer']= Customer::whereNotNull('name')->get();
            return response()->json($data);
            
        }
        
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    
    public function get_driver_about_us()
    {
        $about = About::where('app',1)->first();
        if ($about) {
            
            $about->title = strip_tags($about->title);
            
            $about->content = str_replace(["\r", "\n"], '', $about->content);

            $about->content = strip_tags($about->content);
    
            return response()->json($about, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }  
    }
    
    public function get_customer_about_us()
    {
        $about = About::where('app',2)->first();
        
        if ($about) {
            
            $about->title = strip_tags($about->title);
            
            $about->content = str_replace(["\r", "\n"], '', $about->content);

            $about->content = strip_tags($about->content);
    
            return response()->json($about, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }
    }
    
    
    public function get_restaurant_about_us()
    {
        $about = About::where('app',3)->first();
        
        if ($about) {
            
            $about->title = strip_tags($about->title);
            
            $about->content = str_replace(["\r", "\n"], '', $about->content);

            $about->content = strip_tags($about->content);
    
            return response()->json($about, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }  
    }
    
    
    public function get_driver_faq()
    {
        
        $faqs = Faq::where('app', 1)->where('status',1)->get();
        
        if ($faqs->isNotEmpty()) {
            foreach ($faqs as $faq) {
                $faq->title = strip_tags(str_replace(["\r", "\n"], '', $faq->title));
    
                $faq->content = strip_tags(str_replace(["\r", "\n"], '', $faq->content));
            }
            
            return response()->json($faqs, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'FAQs not found'], Response::HTTP_NOT_FOUND);
        }
    }
    
    
    public function get_customer_faq()
    {
        $faqs = Faq::where('app', 2)->where('status',1)->get();
    
        if ($faqs->isNotEmpty()) {
            foreach ($faqs as $faq) {
                $faq->title = strip_tags(str_replace(["\r", "\n"], '', $faq->title));
    
                $faq->content = strip_tags(str_replace(["\r", "\n"], '', $faq->content));
            }
    
            return response()->json($faqs, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'FAQs not found'], Response::HTTP_NOT_FOUND);
        }
    }
    
    
    public function get_restaurant_faq()
    {
        $faqs = Faq::where('app', 3)->where('status',1)->get();
        
        if ($faqs->isNotEmpty()) {
            foreach ($faqs as $faq) {
                $faq->title = strip_tags(str_replace(["\r", "\n"], '', $faq->title));
                
                $faq->content = strip_tags(str_replace(["\r", "\n"], '', $faq->content));
            }
    
            return response()->json($faqs, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'FAQs not found'], Response::HTTP_NOT_FOUND);
        }
    }
    
    
    public function get_driver_terms_condition()
    {
        $term = TermsCondition::where('app',1)->first();
        
        if ($term) {
            $term->title = strip_tags(str_replace(["\r", "\n"], '', $term->title));
                
            $term->content = strip_tags(str_replace(["\r", "\n"], '', $term->content));
    
            return response()->json($term, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }  
    }
    
  
    public function get_customer_terms_condition()
    {
        $term = TermsCondition::where('app', 2)->first();
        
        if ($term) {
            $term->title = strip_tags(str_replace(["\r", "\n"], '', $term->title));
                
            $term->content = strip_tags(str_replace(["\r", "\n"], '', $term->content));
            
            return response()->json($term, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }
    }
    
    public function get_restaurant_terms_condition()
    {
        $term = TermsCondition::where('app',3)->first();
        
        if ($term) {
            $term->title = strip_tags(str_replace(["\r", "\n"], '', $term->title));
                
            $term->content = strip_tags(str_replace(["\r", "\n"], '', $term->content));
    
            return response()->json($term, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }   
    }
    
    
    public function get_driver_privacy_policy()
    {
        $term = PrivacyPolicy::where('app',1)->first();
        
        if ($term) {
            $term->title = strip_tags(str_replace(["\r", "\n"], '', $term->title));
                
            $term->content = strip_tags(str_replace(["\r", "\n"], '', $term->content));
    
            return response()->json($term, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }
    }
    
    public function get_customer_privacy_policy()
    {
        $term = PrivacyPolicy::where('app',2)->first();
        
        if ($term) {
            $term->title = strip_tags(str_replace(["\r", "\n"], '', $term->title));
                
            $term->content = strip_tags(str_replace(["\r", "\n"], '', $term->content));
    
            return response()->json($term, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }
        
    }
    
    public function get_restaurant_privacy_policy()
    {   
        
        $term = PrivacyPolicy::where('app',3)->first();
        
        if ($term) {
            
            $term->title = strip_tags(str_replace(["\r", "\n"], '', $term->title));
                
            $term->content = strip_tags(str_replace(["\r", "\n"], '', $term->content));
    
            return response()->json($term, Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Term not found'], Response::HTTP_NOT_FOUND);
        }   
    }
    
    
    public function helpWithUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'help_us' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'message' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
    
        // Assuming you want to store feedback in a model named HelpWithUs
        $feedback = new HelpWithUs();
        $feedback->user_id = $request->user_id;
        $feedback->help_us = $request->help_us;
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->mobile_no = $request->mobile_no;
        $feedback->message = $request->message;
    
        $res = $feedback->save();
    
        if ($res) {
            return response()->json([
                'message' => 'HelpWithUs sent successfully.',
                'data' => $feedback, 
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to  HelpWithUs.',
            ]);
        }
    }
    
    public function sendFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'message' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
    
        // Assuming you want to store feedback in a model named Feedback
        $feedback = new Feedback();
        $feedback->user_id = $request->user_id;
        $feedback->message = $request->message;
    
        $res = $feedback->save();
    
        if ($res) {
            return response()->json([
                'message' => 'Feedback sent successfully.',
                'data' => $feedback, 
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to send feedback.',
            ]);
        }
    }

    
}