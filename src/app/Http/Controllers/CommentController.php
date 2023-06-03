<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function post(Request $request)
    {
        $authorId = $request->user()->id;
        $lessonId = $request->input('lessonId');
        $content = $request->input('text');

        $comment = Comment::create([
            'user_id' => $authorId,
            'lesson_id' => $lessonId,
            'content' => $content,
        ]);

        return response()->json([
            'message' => 'Комментарий успешно опубликован',
            'data' => [
                'comment' => $comment
            ]
        ]); 
    }
}
