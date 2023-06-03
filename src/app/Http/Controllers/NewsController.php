<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function get(Request $request)
    {
        return response()->json([
            'data' => [
                'news' => News::orderBy('added_at', 'desc')->get()
            ]
        ]);
    }
}
