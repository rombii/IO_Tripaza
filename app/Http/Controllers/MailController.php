<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Trip;
use Mail;
use App\Mail\PaymentMail;
use App\Mail\EditMail;
use App\Mail\DeleteMail;
use App\Mail\SupportMail;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
    public static function payment()
    {
        if(Auth::check())
        {
            $mailData = [
                'title' => 'Only one step left to go on your dream trip!',
            ];

            Mail::to(Auth::user()->email)->send(new PaymentMail($mailData));
        }
        return redirect()->route('login');
    }

    public static function edit(Trip $trip)
    {
        if(Auth::check())
        {
            $mailData = [
                'title' => 'Successfully edited your reservtion to '.$trip->city.'!',
            ];

            Mail::to(Auth::user()->email)->send(new EditMail($mailData));
        }
        return redirect()->route('login');
    }

    public static function delete(Trip $trip)
    {
        if(Auth::check())
        {
            $mailData = [
                'title' => 'Information about reservation cancel!',
                'trip_city' => $trip->city,
            ];

            Mail::to(Auth::user()->email)->send(new DeleteMail($mailData));
        }
        return redirect()->route('login');
    }

    public static function support(Request $request)
    {
        $mailData = [
            'type' => $request->type,
            'mail' => $request->mail,
            'trip' => $request->trip,
            'text' => $request->message,
        ];
        Mail::to('tripazacompany@gmail.com')->send(new SupportMail($mailData));
        return redirect()->route('index');
    }
}
