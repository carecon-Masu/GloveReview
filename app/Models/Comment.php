<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'user_id',
        'manufacturer',
        'event',
        'dominant_hand',
        'model',
        'available',
        'sale',
        'similar_products',
        'store',
        'recommends',
        'free_review',
    ];

    // コメントとユーザーのリレーションを定義
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
