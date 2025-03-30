<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request) {
        $page = $request->query('page', 1);
        $date = $request->query('date');

        $feeds = Feed::latest();

        if ($date) {
            $feeds->whereDate('pub_at', $date);
        }

        $feeds = $feeds->paginate(10, ['*'], 'page', $page);

        return view('feed', ['feeds' => $feeds]);
    }
}
