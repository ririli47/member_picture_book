<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{

    public static $rules = array(
        'user_id' => 'required',
        'friend_id' => 'required',
        'index' => 'required'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','friend_id', 'index'
    ];
}
