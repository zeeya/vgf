<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Return_request;
use App\Models\Adress_shipping;
use App\Models\Adress_billing;
use App\Models\User;
use App\Models\Package_designation;
use App\Models\Return_type;
use \Milon\Barcode\DNS1D;

use Session;
class DynamicPDFController extends Controller
{
    function index()
    {
        $return_request = Return_request::where('id', collect(request()->segments())->last())->get();
        $adress_shipping = Adress_shipping::where('user_id', $return_request[0]->user_id)->get();       
        $package_designation = Package_designation::where('id', $return_request[0]->package_designation_id )->get();
        $return_type = Return_type::where('id', $return_request[0]->return_type_id  )->get();
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $code = substr($return_request[0]->n_kvps, -4).''.str_replace('-', '', date('d-m-Y', strtotime($return_request[0]->created_at))).''.$return_request[0]->id;
        $barcode = $d->getBarcodeHTML($code, 'C128');
        //  $customer_data = $this->get_customer_data();
        // return view('imprimer', 
        //     array(
        //         'return_request', $return_request[0],
        //         'adress_shipping', $adress_shipping,
        //         'adress_billing', $adress_billing,
        //         'package_designation', $package_designation,
        //         'return_type', $return_type,
        //     )
        // );
        
        return view('imprimer', ['return_request' => $return_request[0],'adress_shipping' => $adress_shipping[0],'package_designation' => $package_designation[0],'return_type' => $return_type[0],'code'=>$code,'barcode'=>$barcode]);

        
    }

    // function get_customer_data()
    // {
    //  $customer_data = DB::table('tbl_customer')
    //      ->limit(10)
    //      ->get();
    //  return $customer_data;
    // }

    function pdf($id)
    {


        $return_request = Return_request::where('id', $id)->get();
        $adress_shipping = Adress_shipping::where('user_id', $return_request[0]->user_id)->get();       
        $package_designation = Package_designation::where('id', $return_request[0]->package_designation_id )->get();
        $return_type = Return_type::where('id', $return_request[0]->return_type_id  )->get();
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $code = substr($return_request[0]->n_kvps, -4).''.str_replace('-', '', date('d-m-Y', strtotime($return_request[0]->created_at))).''.$return_request[0]->id;
        $barcode = $d->getBarcodeHTML($code, 'C128');

        $pdf_doc = PDF::loadView('exportpdf', ['return_request' => $return_request[0],'adress_shipping' => $adress_shipping[0],'package_designation' => $package_designation[0],'return_type' => $return_type[0],'code'=>$code,'barcode'=>$barcode]);
        return $pdf_doc->download('demande_de_retour_'.$id.'.pdf');
    }

    // function convert_customer_data_to_html()
    // {

        //  $customer_data = $this->get_customer_data();
        //      $output = '
        //      <h3 align="center">Customer Data</h3>
        //      <table width="100%" style="border-collapse: collapse; border: 0px;">
        //       <tr>
        //     <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
        //     <th style="border: 1px solid; padding:12px;" width="30%">Address</th>
        //     <th style="border: 1px solid; padding:12px;" width="15%">City</th>
        //     <th style="border: 1px solid; padding:12px;" width="15%">Postal Code</th>
        //     <th style="border: 1px solid; padding:12px;" width="20%">Country</th>
        //    </tr>
        //      ';  
        //      foreach($customer_data as $customer)
        //      {
        //       $output .= '
        //       <tr>
        //        <td style="border: 1px solid; padding:12px;">'.$customer->CustomerName.'</td>
        //        <td style="border: 1px solid; padding:12px;">'.$customer->Address.'</td>
        //        <td style="border: 1px solid; padding:12px;">'.$customer->City.'</td>
        //        <td style="border: 1px solid; padding:12px;">'.$customer->PostalCode.'</td>
        //        <td style="border: 1px solid; padding:12px;">'.$customer->Country.'</td>
        //       </tr>
        //       ';
        //      }
        //      $output .= '</table>';
        // return '<h3>teeeezst</h3>';
    // }
}