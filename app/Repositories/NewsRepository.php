<?php

namespace App\Repositories;

use App\Models\News;
use App\Traits\Uploader;

class NewsRepository
{
    use Uploader;

    public function getById($id)
    {
        return News::findOrFail($id);
    }

    public function getPaginatedNews($request)
    {
        $page = $request->input('page', 1);
        $take = $request->input('take', 10);

        $news = News::with('user')->orderBy('created_at', 'desc');

        if(!empty($page) && !empty('take')) {
            $news = $news->paginate($take, ['*'], 'page', $page);
        }else {
            $news = $news->get();
        }
        return $news;
    }

    public function getDetailNews($id)
    {
        return News::with('user','comments.user')->find($id);
    }

    public function createNews(array $data): News
    {
        $news = new News();
        $news->user_id = $data['user_id'];
        $news->title = $data['title'];
        $news->body = $data['body'];

        if (isset($data['image_path'])) {
            $news->image_path = $data['image_path'];
        }

        $news->save();

        return $news;
    }

    public function updateNews($id, $validatedData) : News
    {
        $news = News::find($id);

        if (empty($news)) {
            return null;
        }

        $news->title = $validatedData['title'];
        $news->body = $validatedData['body'];

        if (isset($validatedData['image'])) {
            $images = $this->uploader($validatedData['image'],'news');
            $news->image_path = $this->uploaded_image($images);
        }

        $news->save();

        return $news;
    }
}
