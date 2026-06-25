<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['name', 'slug', 'thumbnail', 'description', 'order'];

    public function photos()
    {
        return $this->hasMany(AssetPhoto::class);
    }
}
