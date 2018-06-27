<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'interest_user_id' => 'required'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','interest_user_id',
    ];
}
