<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\News;

class CommentRepository
{
    /**
     * Create a new comment.
     *
     * @param Request $request
     * @param Comment $news
     * @return Comment
     */
    public function createComment($user, $news, $data) : Comment
    {
        $comment = new Comment();
        $comment->user_id = $user;
        $comment->news_id = $news;
        $comment->body = $data['body'];
        $comment->save();
        
        return $comment;
    }
}
