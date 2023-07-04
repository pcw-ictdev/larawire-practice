<?php

namespace App\Models;

use App\Models\PostDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'post_detail_id', 'body'];

    public function postDetail()
    {
        return $this->belongsTo(PostDetail::class, 'post_detail_id')->withDefault();
    }
}
