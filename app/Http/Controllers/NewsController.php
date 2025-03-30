<?php

namespace App\Http\Controllers;

use App\Http\Filters\FeedFilter;
use App\Http\Requests\NewsRequest;
use App\Models\Feed;

class NewsController extends Controller
{
    public function index(NewsRequest $request) {
        $data = $request->validated();
        $filter = app()->make(FeedFilter::class, ['queryParams' => $data]);
        $page = $request->query('page', 1);

        $feeds = Feed::filter($filter)->latest();

        $feeds = $feeds->paginate(10, ['*'], 'page', $page);

        return view('feed', ['feeds' => $feeds]);
    }
}
