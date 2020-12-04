@extends('layouts.app')

@section('content')
    <h1>{{$article->title}}</h1>
    <div>{{$article->body}}</div>
    <h5><a href="{{route('articles.edit', $article)}}">Редактировать статью</a></h5>
@endsection
