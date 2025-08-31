<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactUsMessage;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    # store contact us form data
    public function store(Request $request)
    {
        // Only validate recaptcha if it's enabled
        if (getSetting('enable_recaptcha') == 1) {
            $score = recaptchaValidation($request);
            $request->request->add([
                'score' => $score
            ]);
            $data['score'] = 'required|numeric|min:0.9';

            $request->validate($data,[
                'score.min' => localize('Google recaptcha validation error, seems like you are not a human.')
            ]);
        }

        $msg = new ContactUsMessage;
        
        // Handle different form field names
        if ($request->has('first_name') && $request->has('last_name')) {
            // Contact form with separate first/last name fields
            $msg->name = trim($request->first_name . ' ' . $request->last_name);
        } else {
            // Standard form with single name field
            $msg->name = $request->name;
        }
        
        $msg->email = $request->email;
        
        // Handle phone field variations
        if ($request->has('mobile') && !empty($request->mobile)) {
            $msg->phone = $request->mobile;
        } else {
            $msg->phone = $request->phone ?? '';
        }

        // Add subject if provided
        $subject = '';
        if ($request->has('subject') && !empty($request->subject)) {
            $subject = "Subject: " . $request->subject . "\n\n";
        }

        // Handle product inquiry
        if ($request->has('inquiry_product')) {
            $msg->support_for = 'product_inquiry';
            $msg->message = 'Product ID: ' . $request->inquiry_product . "\n\n" . $subject . $request->message;
        } else {
            $msg->support_for = $request->support_for ?? 'other_service';
            
            // Build message with additional information
            $message_parts = [];
            
            if ($request->has('company_name') && !empty($request->company_name)) {
                $message_parts[] = "Company: " . $request->company_name;
            }
            
            if ($request->has('address') && !empty($request->address)) {
                $message_parts[] = "Address: " . $request->address;
            }
            
            if (!empty($message_parts)) {
                $message_parts[] = "" . $subject . $request->message;
                $msg->message = implode("\n", $message_parts);
            } else {
                $msg->message = $subject . $request->message;
            }
        }

        $msg->save();
        flash(localize('Your message has been sent'))->success();
        return back();
    }
}
