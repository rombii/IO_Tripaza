<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SupportController;
use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $newest = Trip::orderBy('id', 'DESC')->where('begin_date', '>', Carbon::now())->limit(3)->get();
    $mostBooked = Trip::withCount('reservations')->orderBy('reservations_count', 'desc')->where('begin_date', '>', Carbon::now())->limit(3)->get();
    $mostFavourite = Trip::withCount('favourites')->orderBy('favourites_count', 'desc')->where('begin_date', '>', Carbon::now())->limit(3)->get();
    $dealTrip = Trip::all()->limit(1)->get();
    return view('index', ['newest' => $newest, 'booked' => $mostBooked, 'favourite' => $mostFavourite, 'deal' => $dealTrip]);
})->name('index');


Route::get('/dashboard', function () {
    if(Auth::user()->isAdmin())
    return view('dashboard.dashboard');
    abort(403);
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/trips', function () {
    if(Auth::user()->isAdmin())
        return view('dashboard.trips.dashboard_trips', ['trips' => Trip::all()]);
    abort(403);
})->middleware(['auth'])->name('adminTrips');

Route::get('/dashboard/reservations', function () {
    if(Auth::user()->isAdmin())
        return view('dashboard.reserv.dashboard_reserv', ['reservations' => Reservation::all()]);
    abort(403);
})->middleware(['auth'])->name('adminReserv');

Route::get('/dashboard/users', function () {
    if(Auth::user()->isAdmin())
        return view('dashboard.users.dashboard_users', ['users' => User::all()]);
    abort(403);
})->middleware(['auth'])->name('adminUsers');

Route::get('/support', function () {
    if(Auth::check())
        return view('support', ['trips' => Reservation::all()->where('user_id', '=', Auth::user()->id)]);
    else
        return view('support', ['trips' => null]);
})->name('support');

Route::controller(SupportController::class)->group(function (){
    Route::post('/support/mail', 'sendSupportMail')->name('supportMail');

});

Route::controller(UserController::class)->group(function (){
    Route::get('/edit', 'edit') -> name('edit');
    Route::post('/edit', 'update') -> name('update');

    Route::get('/dashboard/users/edit', 'adminEditUser')->name('adminUsersEdit');
    Route::post('/dashboard/users/edited', 'adminEditUserForm')->name('adminUsersEditForm');
    Route::post('/dashboard/users/delete', 'adminDeleteUser')->name('adminUsersDelete');
});

Route::controller(ReservationController::class)->group(function (){
    Route::get('/history', 'show') -> name('history');
    Route::get('/booking/new', 'bookTrip') -> name('bookTrip');
    Route::get('/booking/edit', 'editTrip') -> name('editTrip');
    Route::get('/history/show', 'show');
    Route::post('/history/show', 'store') -> name('book');
    Route::post('/history/delete', 'destroy') -> name('remRes');
    Route::post('/history/update', 'update') -> name('updateTrip');


    Route::get('/dashboard/reservations/edit', 'adminEditReserv')->name('adminReservsEdit');
    Route::post('/dashboard/reservations/delete', 'adminDeleteReserv')->name('adminReservsDelete');
    Route::get('/dashboard/reservations/new', 'adminAddReserv')->name('adminReservsNew');
    Route::post('/dashboard/reservations/add', 'adminAddReservForm')->name('adminReservsNewForm');
    Route::post('/dashboard/reservations/edited', 'adminEditReservForm')->name('adminReservsEditForm');
});

Route::controller(FavouriteController::class)->group(function (){
    Route::get('/favourites', 'show') -> name('favourites');
});

Route::controller(TripController::class)->group(function (){
    Route::get('/lastminute', 'show_lm')->name('lastminute');
    Route::get('/lastminute/filter', 'show_lm_f')->name('lastminute_filter');
    Route::get('/summer', 'show_summ')->name('summer');
    Route::get('/summer/filter', 'show_summ_f')->name('summer_filter');
    Route::get('/winter', 'show_win')->name('winter');
    Route::get('/winter/filter', 'show_win_f')->name('winter_filter');
    Route::get('/all', 'show_all')->name('all');
    Route::get('/all/filter', 'show_all_f')->name('all_filter');
    Route::post('/all/add', 'addToFavourites')->name('addTF');
    Route::post('/all/rem', 'removeFavourites')->name('remTF');

    Route::get('/dashboard/trips/edit', 'adminEditTrip')->name('adminTripsEdit');
    Route::post('/dashboard/trips/delete', 'adminDeleteTrip')->name('adminTripsDelete');
    Route::get('/dashboard/trips/new', 'adminAddTrip')->name('adminTripsNew');
    Route::post('/dashboard/trips/add', 'adminAddTripForm')->name('adminTripsNewForm');
    Route::post('/dashboard/trips/edited', 'adminEditTripForm')->name('adminTripsEditForm');
});

Route::get('/userpage', function () {
    if(Auth::check())
        return view('userpage');
    return redirect('/login');
})->name('userpage');


require __DIR__.'/auth.php';
