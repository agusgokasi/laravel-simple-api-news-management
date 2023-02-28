<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\NewsLog;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'user_id', 'title', 'body', 'image_path',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function news_logs()
    {
        return $this->hasMany(NewsLog::class);
    }
}
