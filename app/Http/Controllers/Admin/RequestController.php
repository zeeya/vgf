<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package_designation;
use App\Models\Return_request;
use App\Models\Return_type;
use Illuminate\Http\Request;
use DataTables;

class RequestController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User $model
     * @return \Illuminate\View\View
     */

    public function index()
    {
        return view('admin.return_request.index');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        try {
            $return_request = Return_request::findOrFail($id);
            $return_request->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    public function edit($id)
    {
        $return_request = Return_request::findOrFail($id);
        $return_type = Return_type::select('name', 'id')->orderBy('name')->get();
        $designation = Package_designation::select('name', 'id')->orderBy('name')->get();
        return view('admin.return_request.edit')
            ->with('return_types', $return_type)
            ->with('designations', $designation)
            ->with('return_request', $return_request);
    }

    public function update($id,Request $request)
    {

        $return_request = Return_request::findOrFail($id);
        $return_request->return_type_id = $request->input('return_type_id');
        $return_request->package_designation_id = $request->input('package_designation_id');
        $return_request->weight_kg = $request->input('weight_kg');
        $return_request->n_kvps = $request->input('n_kvps');

        $return_request->update();
        flash('La demande a été mise à jour avec succès!')->success();
        return \Redirect::route('admin.edit.request', array($return_request->id));
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
        $return_request = Return_request::join('users', 'return_request.user_id', '=', 'users.id')
            ->join('package_designation', 'return_request.package_designation_id', '=', 'package_designation.id')
            ->join('return_type', 'return_request.return_type_id', '=', 'return_type.id')
            ->select(
                'users.firstname',
                'users.lastname',
                'users.email',
                'package_designation.name as name_designation',
                'return_type.name as name_type',
                'return_request.n_kvps',
                'return_request.weight_kg',
                'return_request.created_at',
                'return_request.id'
            );

        return Datatables::of($return_request)
            ->filter(function ($query) use ($request) {


                if ($request->has('firstname') && !empty($request->firstname)) {
                    $query->where('users.firstname', 'like', "%{$request->get('firstname')}%");
                }
                if ($request->has('lastname') && !empty($request->lastname)) {
                    $query->where('users.lastname', 'like', "%{$request->get('lastname')}%");
                }
//
                if ($request->has('name_designation') && !empty($request->name_designation)) {
                    $query->where('package_designation.name', 'like', "%{$request->get('name_designation')}%");
                }
                if ($request->has('name_type') && !empty($request->name_type)) {
                    $query->where('return_type.name', 'like', "%{$request->get('name_type')}%");
                }
                if ($request->has('n_kvps') && !empty($request->n_kvps)) {
                    $query->where('return_request.n_kvps', 'like', "%{$request->get('n_kvps')}%");
                }
                if ($request->has('weight_kg') && !empty($request->weight_kg)) {
                    $query->where('return_request.weight_kg', 'like', "%{$request->get('weight_kg')}%");
                }


            })
            ->addColumn('created_at', function ($return_request) {
                return $return_request->created_at->format('d/m/Y');
            })
            ->addColumn('action', function ($return_request) {
                return '
                 <a  href="' . route('admin.edit.request', ['id' => $return_request->id]) . '" class="edit btn btn-success btn-sm">Modifier</a> 
                        <a href="javascript:void(0)" onclick="deleteRequest(' . $return_request->id . ');" class="delete btn btn-danger btn-sm">Supprimer</a>
				';
            })

            ->rawColumns(['action' ])
            ->setRowId(function($return_request) {
                return 'requestDtRow' . $return_request->id;
            })
            ->make(true);

        }
    }

}
