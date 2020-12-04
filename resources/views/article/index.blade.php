@extends('layouts.app')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h1>Список статей</h1>
    <h3><a href="{{route('articles.create')}}">Create new</a></h3>
    @foreach ($articles as $article)
        <h2><a href="{{ route('articles.show', ['id' => $article->id], false) }}">{{$article->title}}</a></h2>
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
    <hr>
    {{ $articles->links() }}
@endsection
