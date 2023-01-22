<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::check())
            return view('editinfo');
        return redirect()->route('login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $input = $request->all();
        Auth::user()->update($input);
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function adminEditUser(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
            return view('dashboard.users.dashboard_user_edit', ['user' => User::find($request->id)]);
        return redirect()->route('index');
    }

    public function adminEditUserForm(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            $validation = $request->validate([
                'email' => 'required|email',
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'phone' => 'required|regex:/^\d{9}$/',
                'sex' => 'required'
            ]);

            $user = User::find($request->id);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->phone = $request->phone;
            $user->sex = $request->sex;
            $user->save();
            return redirect()->route('adminUsers')->with('success', 'Successfully edited user with id '.$request->id);
        }
        return redirect()->route('index');
    }

    public function adminDeleteUser(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            if(User::find($request->id)->reservations()->exists())
                return redirect()->back()->with('error', 'This user has reservations');
            User::destroy($request->id);
            return redirect()->back()->with('success', 'Successfully deleted user with id '.$request->id);
        }
        return redirect()->route('index');
    }
}
