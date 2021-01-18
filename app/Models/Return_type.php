<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_type extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'return_type';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];
}
