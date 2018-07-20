<?php

namespace App;

use App\Traits\PrimaryIdTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Tag extends Model
{
    use PrimaryIdTrait;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * タグが存在すればselectしてinstanceを返す
     * 存在していなければinsertしてinstanceを返す
     *
     * @param string $name
     * @return Tag
     */
    public static function findOrCreateByName(string $name): self
    {
        $tag = self::findByName($name);
        if ($tag instanceof Tag) {
            return $tag;
        }
        $tag = (new Tag)->fill(['name' => $name]);
        if (!$tag->save()) {
            throw new \RuntimeException(('failed to save tag'));
        }
        return $tag;
    }

    public static function findByName(string $name): ?self
    {
        return self::query()->where('name', $name)->first();
    }

    public function getName(): string
    {
        return $this->name ?? '';
    }
}
