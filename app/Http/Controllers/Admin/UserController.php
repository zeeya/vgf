<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User $model
     * @return \Illuminate\View\View
     */

    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        flash('L\'utilisateur a été ajoutée avec succès !')->success();
        return \Redirect::route('admin.edit.user', array($user->id));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with('user', $user);
    }

    public function update($id,StoreUserRequest $request)
    {

        $user = User::findOrFail($id);
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->update();
        flash('L\'utilisateur a été mise à jour avec succès!')->success();
        return \Redirect::route('admin.edit.user', array($user->id));
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
        $users = User::select([
            'users.id',
            'users.firstname',
            'users.lastname',
            'users.email',
        ]);

        return Datatables::of($users)
            ->filter(function ($query) use ($request) {


                if ($request->has('firstname') && !empty($request->firstname)) {
                    $query->where('users.firstname', 'like', "%{$request->get('firstname')}%");
                }
                if ($request->has('lastname') && !empty($request->lastname)) {
                    $query->where('users.lastname', 'like', "%{$request->get('lastname')}%");
                }

                if ($request->has('email') && !empty($request->email)) {
                    $query->where('users.email', 'like', "%{$request->get('email')}%");
                }


            })
            ->addColumn('action', function ($users) {
                return '
                        <a  href="' . route('admin.edit.user', ['id' => $users->id]) . '" class="edit btn btn-success btn-sm">Modifier</a> 
                        <a href="javascript:void(0)" onclick="deleteUser(' . $users->id . ');" class="delete btn btn-danger btn-sm">Supprimer</a>
				';
            })

            ->rawColumns(['action' ])
            ->setRowId(function($users) {
                return 'userDtRow' . $users->id;
            })
            ->make(true);



//
//            $data = User::latest()->get();
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
//                    return $actionBtn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
        }
    }

}
