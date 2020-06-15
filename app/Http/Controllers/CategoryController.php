<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     *
     * @var CategoryRepositoryInterface
     */
    protected $repo;
    /**
     *
     * @param CategoryRepositoryInterface $repo
     */
    public function __construct(CategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function datatable(){
        return $this->repo->datatable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repo->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        return $this->repo->create($request->only(['name']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->repo->find($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Category $category)
    {
        return $this->repo->update($request->only(['name']),$category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return $this->repo->delete($category);
    }
}
