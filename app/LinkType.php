<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkType extends Model
{
    protected $guarded = [];

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
