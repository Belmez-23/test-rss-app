@extends('layouts.index')
<style>
    body {
        background-color: #e9e9e9;
        font-family: "RobotoFlex",Arial,sans-serif;
        font-size: 16px;
    }

    .feed {
        border-bottom: 1px solid #000;
        padding: 10px;
        margin: 0px auto;
        text-align: center;
        background-color: #ffffff;
        width: 650px;
        border-collapse: collapse;
    }

    .feed img {
        max-width: 100%;
        height: auto;
    }

    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
    }

    .page-link {
        position: relative;
        display: block;
        color: #0d6efd;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #dee2e6;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
</style>

@section('content')
    <div class="feed">
        <h2>РИА Новости</h2>
    </div>
    <div class="feed">
        <form action="{{ route('feed.index') }}" method="GET">
            <input type="date" name="pub_at" value="{{ request('date', now()->format('Y-m-d')) }}">
            <button type="submit">Поиск</button>
        </form>
    </div>

    <div class="container">
    @foreach($feeds as $feed)
        <div class="feed">
            {{ (new DateTime($feed->pub_at))->format('d.m.Y в H:i: ') }}<a href="{{ $feed->url }}" target="_blank">
                {{ $feed->title }}
                @if($feed->image)
                    <br><img src="{{ $feed->image }}" class="img-fluid" alt="{{ $feed->title }}">
                @endif
            </a>
        </div>
    @endforeach

    </div>
    {{ $feeds->links() }}
@endsection
