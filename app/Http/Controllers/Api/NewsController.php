<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Traits\Uploader;

class NewsController extends Controller
{
    use Uploader;

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $take = $request->input('take', 10);

        $news = News::paginate($take, ['*'], 'page', $page);

        return response()->json($news);
    }
    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $news = new News();
        $news->user_id = $request->user()->id; // set the authenticated user's ID as the news creator
        $news->title = $validatedData['title'];
        $news->body = $validatedData['body'];
        
        if ($request->hasFile('image')) {
            $images = $this->uploader($request->file('image'),'news');
            $news->image_path = $this->uploaded_image($images);
        }
        
        $news->save();
        
        // event(new NewsCreated($news)); // fire the NewsCreated event
        
        return response()->json([
            'message' => 'News created successfully.',
            'news' => $news,
        ], 201);
    }
    
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $news = new News();
        $news->title = $validatedData['title'];
        $news->body = $validatedData['body'];
        
        if ($request->hasFile('image')) {
            $images = $this->uploader($request->file('image'),'news');
            $news->image_path = $this->uploaded_image($images);
        }
        
        $news->save();
        
        // event(new NewsCreated($news)); // fire the NewsCreated event
        
        return response()->json([
            'message' => 'News created successfully.',
            'news' => $news,
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $news = News::findOrFail($id);
        
        if (!$request->user()->is_admin || $request->user()->id !== $news->user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $news->delete();

        return response()->json(['message' => 'News deleted successfully'], 200);
    }

}
