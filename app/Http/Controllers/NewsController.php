<?php

namespace App\Http\Controllers;

use App\Http\Filters\FeedFilter;
use App\Http\Requests\NewsRequest;
use App\Models\Feed;
use Illuminate\Support\Facades\Artisan;

class NewsController extends Controller
{
    const MAX_ITEMS = 10;

    public function index(NewsRequest $request) {
        // Запускаем команду app:import-feeds
        Artisan::call('app:import-feeds');

        $filter = app()->make(FeedFilter::class, ['queryParams' => $request->validated()]);
        $page = $request->query('page', 1);

        $feeds = Feed::getCachedPage($filter, $page, self::MAX_ITEMS);

        $feeds->appends($request->validated());

        return view('feed', ['feeds' => $feeds]);
    }
}
