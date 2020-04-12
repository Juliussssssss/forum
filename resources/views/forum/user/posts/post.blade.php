@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                @if (empty($post))
                    <p>Упс, ошибка, мы не нашли такого поста в бд(</p>
                @else
                    <div class="card">
                        <div class="row">
                            <div class="col-4 border-right pr-0">
                                <ul class="d-flex align-items-start flex-column bd-highlight mb-3 h-100 w-100">
                                    <li class="w-100 p-3 border-bottom mb-auto bd-highlight">Автор: {{ $post->user->name }}</li>
                                    <li class="w-100 mb-auto text-center"><img class="img-fluid" src="{{ asset('/storage/'.$post->user->image) }}" alt=""></li>
                                    <li class="w-100 p-3 border-top bd-highlight">Опубликовано {{ $post->published_at }}</li>
                                    @if ($post->published_at != $post->updated_at)
                                        <li class="w-100 p-3 border-top bd-highlight">Отредактировано {{ $post->updated_at }}<li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-8 pl-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ $post->title }}</li>
                                    <li class="list-group-item">{{ $post->content_row }}</li>
                                    <li class="list-group-item">
                                        <a href="{{ route('forum.categories.id', $post->category_id) }}">
                                            {{ $post->category->title }}
                                        </a>
                                    </li>
                                    @if (Auth::user() && $post->user->name == Auth::user()->name)
                                        <li class="list-group-item justify-content-around d-flex">
                                            <form method="POST" action="{{ route('forum.post.destroy', $post->id) }}">
                                                @method("DELETE")
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm">Удалить</button>
                                            </form>
                                            <a class="btn btn-light btn-sm" href="{{ route('forum.post.edit', $post->id) }}">Редактировать</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('forum.user.comments.comment_list')
@endsection
