<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseMapper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function sendContactForm(ContactFormRequest $request)
    {
        $data = $request->validated();
        $mail = new ContactFormMail($data['subject'],$data['name'],$data['email'],$data['message']);

        Mail::send($mail);
        return ResponseMapper::success("Form successfully send");
    }
}
