<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url'];
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function Imageable(){
        return $this->morphTo();
    }
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo('App\User');
    }
}
