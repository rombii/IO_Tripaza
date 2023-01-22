<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Requests\FavouriteTripRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class TripController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */

    public function show_lm()
    {

        $trips = Trip::where('last_minute', '=', 1)->where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0)->paginate(5);
        return view('lastminute', compact('trips'));
    }

    public function show_lm_f(Request $request)
    {

        $city = $request->input('city');
        $country = $request->input('country');
        $from = $request->input('start');
        $to = $request->input('end');
        $type = $request->type;
        $trips = Trip::where('last_minute', '=', 1)->where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0);
        if($city != null)
        $trips = $trips->where('city', 'like', $city);
        if($country != null)
        $trips = $trips->where('country', 'like', $country);
        if($from != null)
        {
            if($request->date('start') <= Carbon::now())
            throw ValidationException::withMessages(['start' => 'Begin date should be after today']);
            $trips = $trips->where('begin_date', '>', $from);
        }
        if($to != null)
        $trips = $trips->where('end_date', '<', $to);



        if($from != null && $to != null)
        {
            if($request->date('start') >= $request->date('end'))
                throw ValidationException::withMessages(['end' => 'Begin date should be before end date!']);
        }

        if(!empty($type))
            $trips = $trips->whereIn('food_option', $type);
        $trips = $trips->paginate(5);
        return view('lastminute', compact('trips'));
    }

    public function show_summ()
    {
        $trips = Trip::where('begin_date', '<', '2022-10-01')->where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0)->paginate(5);
        return view('summer', compact('trips'));
    }

    public function show_summ_f(Request $request)
    {


        $city = $request->input('city');
        $country = $request->input('country');
        $from = $request->input('start');
        $to = $request->input('end');
        $type = $request->type;
        $trips = Trip::where('begin_date', '<', '2022-10-01')->where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0);
        if($city != null)
        $trips = $trips->where('city', 'like', $city);
        if($country != null)
        $trips = $trips->where('country', 'like', $country);
        if($from != null)
        {
            if($request->date('start') <= Carbon::now())
                throw ValidationException::withMessages(['start' => 'Begin date should be after today']);
            $trips = $trips->where('begin_date', '>', $from);
        }
        if($to != null)
        $trips = $trips->where('end_date', '<', $to);



        if($from != null && $to != null)
            if($request->date('start') >= $request->date('end'))
                throw ValidationException::withMessages(['end' => 'Begin date should be before end date!']);
        if(!empty($type))
            $trips = $trips->whereIn('food_option', $type);
        $trips = $trips->paginate(5);
        return view('summer', compact('trips'));
    }

    public function show_win()
    {
        $trips = Trip::where('begin_date', '>', '2022-10-01')->where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0)->paginate(5);
        return view('winter', compact('trips'));
    }

    public function show_win_f(Request $request)
    {


        $city = $request->input('city');
        $country = $request->input('country');
        $from = $request->input('start');
        $to = $request->input('end');
        $type = $request->type;
        $trips = Trip::where('begin_date', '>', '2022-10-01')->where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0);
        if($city != null)
        $trips = $trips->where('city', 'like', $city);
        if($country != null)
        $trips = $trips->where('country', 'like', $country);
        if($from != null)
        {
            if($request->date('start') <= Carbon::now())
                throw ValidationException::withMessages(['start' => 'Begin date should be after today']);
            $trips = $trips->where('begin_date', '>', $from);
        }
        if($to != null)
        $trips = $trips->where('end_date', '<', $to);



        if($from != null && $to != null)
            if($request->date('start') >= $request->date('end'))
                throw ValidationException::withMessages(['end' => 'Begin date should be before end date!']);
        if(!empty($type))
            $trips = $trips->whereIn('food_option', $type);
        $trips = $trips->paginate(5);
        return view('winter', compact('trips'));
    }

    public function show_all()
    {
        $trips = Trip::where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0)->paginate(5);
        return view('all', compact('trips'));
    }

    public function show_all_f(Request $request)
    {
        $city = $request->input('city');
        $country = $request->input('country');
        $from = $request->input('start');
        $to = $request->input('end');
        $type = $request->type;
        $trips = Trip::where('id', '>', 0)->where('begin_date' , '>', Carbon::now())->where('participants_number_left', '>', 0);
        if($city != null)
        $trips = $trips->where('city', 'like', $city);
        if($country != null)
        $trips = $trips->where('country', 'like', $country);
        if($from != null)
        {
            if($request->date('start') <= Carbon::now())
                throw ValidationException::withMessages(['start' => 'Begin date should be after today']);
            $trips = $trips->where('begin_date', '>', $from);
        }
        if($to != null)
        $trips = $trips->where('end_date', '<', $to);


        if($from != null && $to != null)
        {
            if($request->date('start') >= $request->date('end'))
                throw ValidationException::withMessages(['end' => 'Begin date should be before end date!']);
        }
        if(!empty($type))
            $trips = $trips->whereIn('food_option', $type);
        $trips = $trips->paginate(5);
        return view('all', compact('trips'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function addToFavourites(FavouriteTripRequest $request) {
        Auth::user()->favouritesUser()->attach(Trip::find($request->input('trip_id')));
        return redirect()->back();
    }

    public function removeFavourites(FavouriteTripRequest $request) {
        Auth::user()->favouritesUser()->detach(Trip::find($request->input('trip_id')));
        return redirect()->back();
    }

    public function adminAddTrip() {
        if(Auth::check() && Auth::user()->isAdmin())
            return view('dashboard.trips.dashboard_trips_new');
        return redirect()->route('login');
    }

    public function adminAddTripForm(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            $validate = $request->validate([
                'country' => 'required',
                'city' => 'required',
                'begin_date' => 'required',
                'end_date' => 'required',
                'price' => 'required|gte:1|regex:/^\d{1,10}(\.\d{1,2})?$/',
                'type' => 'required',
                'seats' => 'required|gte:1',
                'photo' => 'required|image',
            ]);
            if($request->date('begin_date') <= Carbon::now())
                throw ValidationException::withMessages(['begin_date' => 'Begin date should be after today']);
            if($request->date('begin_date') >= $request->date('end_date'))
                throw ValidationException::withMessages(['begin_date' => 'Begin date should be before end date!']);
            $trip = new Trip;
            $trip->country = $request->country;
            $trip->city = $request->city;
            $trip->begin_date = $request->date('begin_date');
            $trip->end_date = $request->date('end_date');
            $trip->price_person = $request->price;
            $trip->last_minute = $request->boolean('last_minute');
            $trip->food_option = $request->type;
            $trip->participants_number_left = $request->seats;
            $trip->timestamps = false;
            $trip->save();

            $trip_picture = Trip::find(DB::table('trips')->max('id'));

            $path = $request->file('photo')->storeAs('public/img', 'trip'.$trip_picture->id.'.jpg');

            return redirect()->route('adminTrips')->with('success', 'Successfully added trip');;
        }
        return redirect()->route('login');
    }


    public function adminEditTrip(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
            return view('dashboard.trips.dashboard_trips_edit', ['trip' => Trip::find($request->trip_id)]);
        return redirect()->route('login');
    }

    public function adminEditTripForm(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            $validate = $request->validate([
                'country' => 'required',
                'city' => 'required',
                'begin_date' => 'required',
                'end_date' => 'required',
                'price' => 'required|gte:1|regex:/^\d{1,8}(\.\d{1,2})?$/',
                'type' => 'required',
                'seats' => 'required|gte:1',
                'photo' => 'image',
            ]);
            if($request->date('begin_date') <= Carbon::now())
                throw ValidationException::withMessages(['begin_date' => 'Begin date should be after today']);
            if($request->date('begin_date') >= $request->date('end_date'))
                throw ValidationException::withMessages(['begin_date' => 'Begin date should be before end date!']);
            $trip = Trip::find($request->trip_id);
            $trip->country = $request->country;
            $trip->city = $request->city;
            $trip->begin_date = $request->date('begin_date');
            $trip->end_date = $request->date('end_date');
            $trip->price_person = $request->price;
            $trip->last_minute = $request->boolean('last_minute');
            $trip->food_option = $request->type;
            $trip->participants_number_left = $request->seats;
            $trip->timestamps = false;
            $trip->save();

            if($request->hasFile('photo'))
            {
                $path = $request->file('photo')->storeAs('public/img', 'trip'.$request->trip_id.'.jpg');
            }


            return redirect()->route('adminTrips')->with('success', 'Successfully edited trip with id '.$request->trip_id);
        }
        return redirect()->route('login');
    }

    public function adminDeleteTrip(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            if(Trip::find($request->trip_id)->reservations()->exists())
                return redirect()->back()->with('error', 'This trip has reservations');
            Trip::destroy($request->trip_id);
            return redirect()->back()->with('success', 'Successfully deleted trip with id '.$request->trip_id);
        }
        return redirect()->route('login');
    }


    // public function show($id) {
    //     //
    // }
}
