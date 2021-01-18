<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class ProfileController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User $model
     * @return \Illuminate\View\View
     */


    public function edit()
    {
        $user = auth()->guard('admin')->user();

        return view('admin.auth.edit')->with('user', $user);
    }

    public function update(Request $request)
    {

        $user = auth()->guard('admin')->user();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->update();
        flash('Le profile a été mise à jour avec succès!')->success();
        return \Redirect::route('admin.edit.profile');
    }





}
