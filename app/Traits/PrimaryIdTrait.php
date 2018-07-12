<?php

namespace App\Traits;

trait PrimaryIdTrait
{
    public static function findById(int $id): ?self
    {
        return self::query()->withoutGlobalScopes()->where('id', $id)->first();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
