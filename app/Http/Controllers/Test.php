<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EcomMailer;
use Illuminate\Support\Facades\Mail;

class Test extends Controller
{
    public function sendEmail()
    {
        try {
            $data = [
                'subject'=>'Testing Email',
                'template' => 'emails.example',
                'name' => 'John Doe'
            ];
            //Mail::to('dev.karunendu.mishra@gmail.com')->send(new EcomMailer($data));
            Mail::to('dev.karunendu.mishra@gmail.com')->queue(new EcomMailer($data));
            return 'Email sent successfully';
        } catch (\Exception $th) {
             // Log the error for debugging
            \Log::error('Error sending email: '.$th->getMessage());
            // Return a more descriptive error message
            return response()->json(['error' => 'Failed to send email. Please try again later.'], 500);
   
        }

    }
}
