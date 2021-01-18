<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Return_request;
use App\Models\User;
use Auth;
use App\Models\Package_designation;
use App\Models\Return_type;

class OrderReturned extends Mailable
{
    use Queueable, SerializesModels;
    public $return_request;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Return_request $return_request)
    {
        $this->return_request = $return_request;
        $this->user = Auth::user();


        $package_designation = Package_designation::where('id',$this->return_request->package_designation_id)->get();
        $this->return_request->package_designation = $package_designation[0]->name;
        $return_type = Return_type::where('id',$this->return_request->return_type_id)->get();
        $this->return_request->return_type = $return_type[0]->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.Return_mail');
        
    }
}
