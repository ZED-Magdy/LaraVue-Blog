<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchResource;
use App\Post;
use Illuminate\Http\Request;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(){
        $searchResults = (new Search())
        ->registerModel(Post::class, function(ModelSearchAspect $modelSearchAspect) {
            $modelSearchAspect
               ->addSearchableAttribute('title')
               ->addSearchableAttribute('body')
               ->with(['Images','User' => fn($q) => $q->with('Images')]);
               
        })
        ->search(request()->query('query'));
        return SearchResource::collection($searchResults)->response();
    }
}
