<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
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

    public function update(PostUpdateRequest $req, Topic $topic, Post $post) {
        $this->authorize('update', $post);

        $post->body = $req->get('body', $post->body);
        $post->save();
        
        return new PostResource($post);
    }

    public function destroy(Topic $topic, Post $post) {
        $this->authorize('destroy', $post);

        // delete likes on this post
        Like::where('likeable_id', $post->id)
            ->delete();

        $post->delete();

        return response(null, 204);
    }
}
