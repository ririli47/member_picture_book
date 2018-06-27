<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'profile' => 'required'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','profile',
    ];
}
