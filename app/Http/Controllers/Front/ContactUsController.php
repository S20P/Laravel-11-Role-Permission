<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsEmail;
use App\Models\ContactUs;
class ContactUsController extends Controller
{
    public function contact(Request $request){
        return view("front.pages.contact");
    }

    public function contactSave(Request $request){
           //validation area
           $rules = [
            'name'=> 'required|string|max:255',
            'email' => 'required|email',           
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        //validation area end


        //  $recaptcha = $request->input('g-recaptcha-response');
        //  if (is_null($recaptcha)) {
        //     return redirect()->back()->withErrors(array('codes' => [ 0 => 'Please complete the recaptcha again to proceed.' ]))->withInput();    
        //  }
        //  $client = new Client();
        //  $url = "https://www.google.com/recaptcha/api/siteverify";
        //  $params = [
        //     'secret' => config('services.recaptcha.secret'),
        //     'response' => $recaptcha,    
        //     'remoteip' => IpUtils::anonymize($request->ip())        
        //    ];
          
        //    $response =  $client->post($url, $params);
        //    $statusCode = $response->getStatusCode();           
        //    if ($statusCode !== 200) {
        //        return redirect()->back()->withErrors(array('codes' => [ 0 => 'Please complete the recaptcha again to proceed.' ]))->withInput();
        //    }
        
    

    $name = $request->name;   
    $email  = $request->email;
    $subject  = $request->subject;
    $message  = $request->message;

    ContactUs::create([
        'name' => $name,
        'email' => $email,
        'phone'  => "",
        'subject' => $subject,
        'message' => $message
    ]);

    $mailData = [           
        'name' => $name,      
        'email' => $email,
        'subject' => $subject,
        'message' => $message,
    ];
       
    Mail::to('satish6073@gmail.com')->send(new ContactUsEmail($mailData));
         
 
    $request->session()->flash('success', 'Thank You For Submitting Your Details, Our Support Team  will Contact You Soon.');
    // Redirect back to the previous page
    return redirect()->route('front.page.contact');

    }
}
