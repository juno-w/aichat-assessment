<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
    public static function bootHasUUID()
    {
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
