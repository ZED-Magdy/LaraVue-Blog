<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url','type'];
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function Imageable(){
        return $this->morphTo();
    }
}
