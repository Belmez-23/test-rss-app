@extends('layouts.index')
<style>
    body {
        background-color: lavender;
    }

    .feed {
        border: 1px solid #000;
        border-radius: 10px;
        padding: 10px;
        margin: 10px;
        text-align: center;
        background-color: #f7fafc;
        width: 650px;
    }

    .feed img {
        max-width: 100%;
        height: auto;
    }
</style>

@section('content')
    <div class="feed">
        <form action="{{ route('feed.index') }}" method="GET">
            <input type="date" name="date" value="{{ request('date') }}">
            <button type="submit">Фильтровать</button>
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
