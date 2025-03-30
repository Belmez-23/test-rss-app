<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{

    /** @use HasFactory<\Database\Factories\FeedFactory> */
    use HasFactory;
    use Filterable;

    public $timestamps = false;
    protected $guarded = [];
}
