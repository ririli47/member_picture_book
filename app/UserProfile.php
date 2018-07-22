<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'profile' => 'required',
        'avatar_path' => ''
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','profile', 'avatar_path',
    ];

    public function hasAvatar(): bool
    {
        return !empty($this->avatar_path);
    }

    public function getDefaultAvatarUrl(): string
    {
        return sprintf('/img/avatar/default/%d.png', intval($this->user_id)%26);
    }

    public function getAvatarUrl(): string
    {
        if ($this->hasAvatar()) {
            return config('aws.user_image.url').$this->avatar_path;
        }
        return $this->getDefaultAvatarUrl();
    }
}
