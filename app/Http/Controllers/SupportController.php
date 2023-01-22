<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class SupportController extends Controller
{
    public function sendSupportMail(Request $request)
    {
        $validator = $request->validate([
            'mail' => 'required|email',
            'message' => 'required'
        ]);
        MailController::support($request);
        return redirect()->route('index');
    }
}
