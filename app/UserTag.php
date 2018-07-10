<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'tag_id'  => 'required'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','tag_id',
    ];
}
