<?php

namespace App\Http\Controllers;

use App\Http\Filters\FeedFilter;
use App\Http\Requests\NewsRequest;
use App\Models\Feed;

class NewsController extends Controller
{
    const MAX_ITEMS = 10;

    public function index(NewsRequest $request) {
        $filter = app()->make(FeedFilter::class, ['queryParams' => $request->validated()]);
        $page = $request->query('page', 1);

        $feeds = Feed::getCachedPage($filter, $page, self::MAX_ITEMS);

        return view('feed', ['feeds' => $feeds]);
    }
}
