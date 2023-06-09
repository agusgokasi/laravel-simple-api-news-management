<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\News;

class NewsLog extends Model
{
    use HasFactory;

    const NEWS_CREATED = 'create';
    const NEWS_UPDATED = 'update';
    const NEWS_DELETED = 'delete';

    protected $table = 'news_logs';

    protected $fillable = [
        'user_id', 'news_id', 'action',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
