<?php

namespace App;

use App\Traits\PrimaryIdTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserTag extends Model
{
    use PrimaryIdTrait;

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

    public function getUserId(): int
    {
        return intval($this->user_id);
    }

    public function getTagId(): int
    {
        return intval($this->tag_id);
    }

    public function getTag(): Tag
    {
        return Tag::findById($this->getTagId());
    }

    /**
     * @param int $userId
     * @return Collection|self[]
     */
    public static function findByUserId(int $userId): Collection
    {
        return UserTag::query()->where('user_id', $userId)->get();
    }
}
