<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check())
        {
            if(Auth::user()->reservations()->where('trip_id', '=', $request->trip_id)->exists()) {
                return view('history', ['reservations' =>  Auth::user()->reservations]);
            }

            $validate = $request->validate([
                'seats' => 'required|gte:1|lte:'.Trip::find($request->trip_id)->participants_number_left,
            ]);

            $reservation = new Reservation;
            $reservation->user_id = $request->user_id;
            $reservation->trip_id = $request->trip_id;
            $reservation->number_of_seats = $request->seats;
            $reservation->price_person = Trip::findOrFail($request->trip_id)->calcPrice($request->trip_id);
            $reservation->timestamps = false;
            $reservation->save();
            $trip = Trip::find($request->trip_id);
            $trip->participants_number_left = $trip->participants_number_left - $request->seats;
            $trip->timestamps = false;
            $trip->save();
            MailController::payment();
            return view('history', ['reservations' =>  Auth::user()->reservations]);
        }
        return redirect()->route('login');
    }

    public function bookTrip(Request $request)
    {
        if(Auth::check())
        {
            $trip = Trip::findOrFail($request->input('trip_id'));
            if($request->has('deal'))
            {
                return view('booking', ['trip' => $trip, 'deal' => 1]);
            }
            return view('booking', ['trip' => $trip, 'deal' => 0]);
        }
        return redirect()->route('login');
    }

    public function editTrip(Request $request)
    {
        if(Auth::check())
        {

            $trip = Trip::findOrFail($request->input('trip_id'));
            return view('booking', ['trip' => $trip, 'deal' => 0]);
        }
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Auth::check())
            return view('history', ["reservations" => Auth::user()->reservations]);
        return redirect()->route('login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::check())
        {
            $reservation = Auth::user()->reservations()->where('trip_id', '=', $request->trip_id)->first();

            MailController::edit(Trip::find($request->trip_id));

            $validate = $request->validate([
                'seats' => ['required', 'gte:1', 'lte:'.Trip::find($request->trip_id)->participants_number_left+$reservation->number_of_seats],
            ]);

            $trip = Trip::find($request->trip_id);
            $trip->participants_number_left = $trip->participants_number_left + $reservation->number_of_seats - $request->seats;
            $trip->timestamps = false;
            $trip->save();

            $reservation->number_of_seats = $request->seats;
            $reservation->timestamps = false;
            $reservation->save();


            return view('history', ["reservations" => Auth::user()->reservations]);
        }
        return redirect()->route('login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::check())
        {
            MailController::delete(Trip::find($request->trip_id));
            $trip = Trip::find($request->trip_id);
            $trip->participants_number_left = $trip->participants_number_left + Reservation::find($request->id)->number_of_seats;
            $trip->timestamps = false;
            $trip->save();
            Reservation::destroy($request->id);
            return redirect(route('history'));
        }
        return redirect()->route('login');
    }


    public function adminAddReserv() {
        if(Auth::check() && Auth::user()->isAdmin())
            return view('dashboard.reserv.dashboard_reserv_new', ['users' => User::all(), 'trips' => Trip::all()]);
        return redirect()->route('login');
    }

    public function adminAddReservForm(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            if(User::find($request->user)->reservations()->where('trip_id', '=', $request->trip)->exists()) {
                return redirect()->route('adminReserv')->with('error', 'That reservation exists try to edit it instead!');
            }
            $validate = $request->validate([
                'seats' => 'required|gte:1|lte:'.Trip::find($request->trip)->participants_number_left,
                'price' => 'required|gte:1|regex:/^\d{1,8}(\.\d{1,2})?$/',
            ]);
            $reservation = new Reservation;
            $reservation->user_id = $request->user;
            $reservation->trip_id = $request->trip;
            $reservation->number_of_seats = $request->seats;
            $reservation->price_person = $request->price;
            $reservation->timestamps = false;
            $reservation->save();

            $trip = Trip::find($request->trip);
            $trip->participants_number_left = $trip->participants_number_left - $request->seats;
            $trip->timestamps = false;
            $trip->save();

            return redirect()->route('adminReserv')->with('success', 'Successfully added new reservation');
        }
        return redirect()->route('login');
    }

    public function adminEditReserv(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
            return view('dashboard.reserv.dashboard_reserv_edit', [
                'reservation' => Reservation::find($request->id),
                'user' => User::find(Reservation::find($request->id)->user_id),
                'trip' => Trip::find(Reservation::find($request->id)->trip_id)]);
        return redirect()->route('login');
    }

    public function adminEditReservForm(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            $reservation = Reservation::find($request->id);
            $validate = $request->validate([
                'seats' => 'required|gte:1|lte:'.Trip::find($reservation->trip_id)->participants_number_left,
                'price' => 'required|gte:1|regex:/^\d{1,8}(\.\d{1,2})?$/',
            ]);

            $trip = Trip::find($reservation->trip_id);
            $trip->participants_number_left = $trip->participants_number_left + $reservation->number_of_seats - $request->seats;
            $trip->timestamps = false;
            $trip->save();

            $reservation->number_of_seats = $request->seats;
            $reservation->price_person = $request->price;
            $reservation->timestamps = false;
            $reservation->save();


            return redirect()->route('adminReserv')->with('success', 'Successfully reservation with id'.$request->id);
        }
        return redirect()->route('login');
    }

    public function adminDeleteReserv(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            Reservation::destroy($request->id);
            return redirect()->back()->with('success', 'Successfully deleted reservation with id '.$request->id);
        }
        return redirect()->route('login');
    }

}
