<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
class MailController extends Controller
{
    public function index()
    {
        $mailData = [           
            'name' => 'satish parmar',
        ];
           
        Mail::to('satish6073@gmail.com')->send(new WelcomeEmail($mailData));
             
        dd("Email is sent successfully.");
    }
}
