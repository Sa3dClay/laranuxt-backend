<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    public function store(PostCreateRequest $req, Topic $topic) {
        $post = new Post;
        $post->body = $req->body;
        $post->user()->associate($req->user());

        $topic->posts()->save($post);
        return new PostResource($post);
    }
}
