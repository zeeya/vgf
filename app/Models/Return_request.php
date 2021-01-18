<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Input;

class Return_request extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    protected $table = 'return_request';
    protected $fillable = [
        'user_id',
        'n_kvps',
        'package_designation_id',
        'return_type_id',
        'weight_kg',
    ];
    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];

}
