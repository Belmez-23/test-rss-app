<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class FeedFilter extends AbstractFilter
{
    public const PUB_AT = 'pub_at';

    protected function getCallbacks(): array
    {
        return [
            self::PUB_AT => [$this, 'pubAt'],
        ];
    }

    public function pubAt(Builder $builder, $value)
    {
        $builder->whereDate('pub_at', $value);
    }
}
