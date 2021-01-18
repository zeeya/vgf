<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package_designation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'package_designation';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];
}
