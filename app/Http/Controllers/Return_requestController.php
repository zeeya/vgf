<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Models\Return_request;
use App\Models\Adress_shipping;
use App\Models\User;
use App\Models\Package_designation;
use App\Models\Return_type;
use Auth;
use App\Mail\OrderReturned;
use Illuminate\Support\Facades\Mail;
use DataTables;

class Return_requestController extends Controller
{

    /**
     * Create a new return request.
     *
     * @param  array  $data
     * @return \App\Models\Return_request
     */
    protected function create(Request $request)
    {

        $validated = $request->validate([
            'weight_kg' => ['required', 'numeric', 'min:6'],
            'n_kvps' => ['required', 'string', 'min:4'],
            'package_designation_id' => ['required', 'numeric'],
            'return_type_id' => ['required', 'string'],
            'name_adress_shipping' => ['required', 'string'],
            'adress_adress_shipping' => ['required', 'string'],
            'postcode_adress_shipping' => ['required', 'string'],
            'city_adress_shipping' => ['required', 'string'],
            'phone_adress_shipping' => ['required', 'string'],
        ]);
        Adress_shipping::updateOrCreate([
            'user_id'   => Auth::user()->id,
        ],[
            'name' => $request->name_adress_shipping,
            'adress' => $request->adress_adress_shipping,
            'postcode' => $request->postcode_adress_shipping,
            'city' => $request->city_adress_shipping,
            'phone' => $request->phone_adress_shipping,
        ]);
        $Return_request = Return_request::create([
            'user_id' => Auth::user()->id,
            'n_kvps' => $request->n_kvps,
            'package_designation_id' => $request->package_designation_id,
            'return_type_id' => $request->return_type_id,
            'weight_kg' => $request->weight_kg,
        ]); 

        Mail::to($request->user())->send(new OrderReturned(Return_request::find($Return_request->id)));
        return redirect()->route('imprimer', ['id' => $Return_request->id]);
    }
    public function view()
    {
        $package_designations = Package_designation::all();
        $return_types = Return_type::all();
        $adress_shipping = Adress_shipping::where('user_id', Auth::user()->id)->get();
        $adress_shipping = !$adress_shipping->isEmpty() ? $adress_shipping[0] : '';
        return view('Return_request', ['package_designations' => $package_designations,'return_types' => $return_types,'adress_shipping' => $adress_shipping]);
    }
    
    public function list()
    {
        // $return_requests = Return_request::where('user_id', Auth::user()->id)->get();
        // foreach ($return_requests as $key => $return_request) {
        //     $package_designation = Package_designation::where('id',$return_request->package_designation_id)->get();
        //     $return_requests[$key]->package_designation = $package_designation[0]->name;
        //     $return_type = Return_type::where('id',$return_request->return_type_id)->get();
        //     $return_requests[$key]->return_type = $return_type[0]->name;
        // }
        // return view('listReturn_request', ['return_requests' => $return_requests]);
        return view('listReturn_request');
    }

    public function fetch(Request $request)
    {

        if ($request->ajax()) {
        $return_request = Return_request::join('users', 'return_request.user_id', '=', 'users.id')
            ->join('package_designation', 'return_request.package_designation_id', '=', 'package_designation.id')
            ->join('return_type', 'return_request.return_type_id', '=', 'return_type.id')
            ->select(
                'package_designation.name as name_designation',
                'return_type.name as name_type',
                'return_request.n_kvps',
                'return_request.weight_kg',
                'return_request.created_at',
                'return_request.id as compteur'
            )->where('return_request.user_id', Auth::user()->id);
           

            return Datatables::of($return_request)
                ->filter(function ($query) use ($request) {
                    if ($request->has('compteur') && !empty($request->compteur)) {
                        $query->where('return_request.id', 'like', "%{$request->get('compteur')}%");
                    }
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
                            <a href="javascript:void(0)" onclick="deleteRequest(' . $return_request->compteur . ');" class="delete btn btn-danger btn-sm">Supprimer</a>
                    ';
                })
                ->addColumn('action', function ($return_request) {
            
                })
                ->rawColumns(['action' ])
                ->setRowId(function($return_request) {
                    return 'requestDtRow' . $return_request->id;
                })
                ->make(true);
            }
    }

    public function edit_view($id)
    {
        $return_request = Return_request::where('id', $id)->get();
        $package_designations = Package_designation::all();
        $return_types = Return_type::all();
        $adress_shipping = Adress_shipping::where('user_id', Auth::user()->id)->get();
        $adress_shipping = !$adress_shipping->isEmpty() ? $adress_shipping[0] : '';
        return view('editReturn_request', ['package_designations' => $package_designations,'return_types' => $return_types,'adress_shipping' => $adress_shipping,'Return_request' => $return_request[0]]);
    }
    public function edit(Request $request,$id)
    {
        $validated = $request->validate([
            'weight_kg' => ['required', 'numeric', 'min:6'],
            'n_kvps' => ['required', 'string', 'min:4'],
            'package_designation_id' => ['required', 'numeric'],
            'return_type_id' => ['required', 'string'],
            'name_adress_shipping' => ['required', 'string'],
            'adress_adress_shipping' => ['required', 'string'],
            'postcode_adress_shipping' => ['required', 'string'],
            'city_adress_shipping' => ['required', 'string'],
            'phone_adress_shipping' => ['required', 'string'],
        ]);
        $Adress_shipping = Adress_shipping::updateOrCreate([
            'user_id'   => Auth::user()->id,
        ],[
            'name' => $request->name_adress_shipping,
            'adress' => $request->adress_adress_shipping,
            'postcode' => $request->postcode_adress_shipping,
            'city' => $request->city_adress_shipping,
            'phone' => $request->phone_adress_shipping,
        ]);
        $Return_request = Return_request::updateOrCreate([
            'id'   => $id,
        ],[
            'n_kvps' => $request->n_kvps,
            'package_designation_id' => $request->package_designation_id,
            'return_type_id' => $request->return_type_id,
            'weight_kg' => $request->weight_kg,
        ]); 
        return redirect()->route('listReturn_request')->with('status','Modifié avec succès');
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
    
}





