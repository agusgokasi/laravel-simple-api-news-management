<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\News;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequest $request, News $news)
    {
        $comment = $this->commentRepository->createComment($request->user()->id, $news->id, $request->validated());
        
        return new CommentResource($comment);
    }
}
