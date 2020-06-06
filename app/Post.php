<?php

namespace App;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    use Likeable, Imageable;
    /**
     *
     * @var array
     */
    protected $fillable = ['user_id','title','body','slug'];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo('App\User');
    }
    
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Category(){
        return $this->belongsTo('App\Category');
    }
    public function getSearchResult(): SearchResult
     {
        $url = route('posts.show', $this->id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
         );
     }
}
