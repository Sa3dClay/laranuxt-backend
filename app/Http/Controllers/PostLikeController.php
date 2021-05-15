<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store(Request $req, Topic $topic, Post $post) {
        $this->authorize('like', $post);

        if ($req->user()->hasLikedPost($post)) {
			return response(null, 409);
		}

        $like = new Like;
        $like->user()->associate($req->user());
        $post->likes()->save($like);

        return response(null, 204);
    }

    public function dislike(Request $req, Topic $topic, Post $post) {
        $this->authorize('dislike', $post);

        if ($req->user()->hasLikedPost($post)) {
			Like::where('likeable_id', $post->id)
                ->where('user_id', $req->user()->id)
                ->delete();

            return response(null, 204);
		}

        return response(null, 409);
    }
}
