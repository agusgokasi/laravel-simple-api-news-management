<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\News;
use App\Events\CreateComment;

class CommentController extends Controller
{
    public function store(CommentRequest $request, News $news)
    {
        $data = $request->validated();
        
        CreateComment::dispatch($request->user()->id, $news->id, $data['body']);
        
        return response()->json(['message' => 'Comment created successfully and queued for processing.'], 200);
    }
}
