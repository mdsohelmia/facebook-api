<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(['data.attributes.body' => 'required']);
        $post = $request->user()->posts()->create($data['data']['attributes']);

        return new PostResource($post);
    }
}
