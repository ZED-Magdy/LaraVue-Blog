<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Post;
use App\Repositories\Interfaces\CommentRepositoryInterface;
class CommentController extends Controller
{
    private $repo;

    public function __construct(CommentRepositoryInterface $repo)
    {
        $this->repo = $repo;   
    }
    public function index(Post $post){
        return $this->repo->getPostComments($post);
    }

    public function show(Comment $comment){
        return $this->repo->show($comment);
    }

    public function store(StoreRequest $storeRequest){
        return $this->repo->store($storeRequest->only(['body','post_id']));
    }

    public function update(UpdateRequest $updateRequest, Comment $comment){
        return $this->repo->update($updateRequest->only('body'),$comment);
    }

    public function destroy(Comment $comment){
        return $this->repo->delete($comment);
    }
}
