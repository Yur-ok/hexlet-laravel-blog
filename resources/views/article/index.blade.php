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
        <h5><a href="{{ route('articles.destroy', $article) }}"
              data-confirm="Вы уверены?"
              data-method="delete" class="fa fa-remove"
              rel="nofollow">
                Delete
            </a>
        </h6>
    @endforeach
    <hr>
    {{ $articles->links() }}
@endsection
