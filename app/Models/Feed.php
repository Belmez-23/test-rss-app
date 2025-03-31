<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Feed extends Model
{
    const CACHE_TTL = 60;

    /** @use HasFactory<\Database\Factories\FeedFactory> */
    use HasFactory;
    use Filterable;

    public $timestamps = false;
    protected $guarded = [];

    public static function getCachedPage($filter, int $page, int $perPage)
    {
        $key = md5(json_encode($filter) . $page . $perPage);
        $result = Cache::get($key, false);

        if (!$result) {
            $feeds = self::filter($filter)->latest();

            $result = $feeds->paginate($perPage, ['*'], 'page', $page);
            Cache::put($key, $result, self::CACHE_TTL);
        }

        return $result;

    }
}
