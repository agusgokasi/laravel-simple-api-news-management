<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Uploader;
use App\Http\Resources\NewsResource;
use App\Models\NewsLog;
use App\Events\NewsLogs;
use App\Http\Requests\NewsRequest;
use App\Repositories\NewsRepository;

class NewsController extends Controller
{
    use Uploader;

    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index(Request $request)
    {
        return NewsResource::collection($this->newsRepository->getPaginatedNews($request));
    }

    public function show($id)
    {
        $news = $this->newsRepository->getDetailNews($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        return new NewsResource($news);
    }
    
    public function store(NewsRequest $request)
    {
        $validatedData = $request->validated();

        $data = [
            'user_id' => $request->user()->id,
            'title' => $validatedData['title'],
            'body' => $validatedData['body']
        ];

        if ($request->hasFile('image')) {
            $images = $this->uploader($request->file('image'), 'news');
            $data['image_path'] = $this->uploaded_image($images);
        }

        $news = $this->newsRepository->createNews($data);
        
        NewsLogs::dispatch($news->id, $request->user()->id, NewsLog::NEWS_CREATED);
        
        return new NewsResource($news);
    }
    
    public function update(NewsRequest $request, $id)
    {
        $validatedData = $request->validated();
        $news = $this->newsRepository->updateNews($id, $validatedData);

        if (empty($news)) {
            return response()->json([
                'message' => 'News not found',
            ], 404);
        }
        
        NewsLogs::dispatch($news->id, $request->user()->id, NewsLog::NEWS_UPDATED);
        
        return new NewsResource($news);
    }

    public function destroy(Request $request, $id)
    {
        $news = $this->newsRepository->getById($id);
        NewsLogs::dispatch($news->id, $request->user()->id, NewsLog::NEWS_UPDATED);
        $news->delete();

        return response()->json(['message' => 'News deleted successfully'], 200);
    }

}
