<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    /**
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    /**
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function datatable()
    {
        
    }

}