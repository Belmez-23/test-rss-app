<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index() {
        return view('welcome');
    }
}
