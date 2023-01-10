<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->Name = $request->name;
        $comment->Comment = $request->comment;
        $comment->FilmId = $request->film_id;
        $comment->UserId = Auth::user()->id;
        $comment->save();
        session()->flash('success', 'Comment Added Successfully');
        return redirect('/films/'.$request->slug);
    }
}
