<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::with('parent')->paginate());
    }
}
