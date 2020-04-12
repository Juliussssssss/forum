@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            @include('forum.admin.result_message')
            <div class="col-12"><h3>Редактирование постов</h3></div>
            <div class="col-12">
                @foreach($posts as $post)
                    <div class="row text-white p-3 rounded-sm bg-info mx-1" @if($post->id % 2 == 0) style="background-color: #343a40!important;" @endif>
                        <div class="col-1">
                            <strong>{{ $post->id }}</strong>
                        </div>
                        <div class="col-9 col-sm-10">
                            <a class="text-white" href="{{ route('forum.admin.posts.edit', $post->id) }}">
                                <strong>Заголовок: </strong>
                                {{ $post->title }}
                            </a>
                        </div>
                        <div class="col-1 col-sm-1 p-0">
                            <a href="{{ route('forum.admin.posts.edit', $post->id) }}"></a>
                            <form class="ml-2" method="POST" action="{{ route('forum.admin.users.destroy', $post->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger m-0 px-1 py-0">x</button>
                            </form>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="row">
                                <div class="col-3">
                                    <strong>Автор: </strong>
                                    {{ $post->user->name }}
                                </div>
                                <div class="col-4">
                                    <strong>Категория: </strong>
                                    {{ $post->category->title }}
                                </div>
                                <div class="col-5">
                                    <strong>Опубликована: </strong>
                                    {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : ''}}
                                </div>
                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
            </div>
            <div class="col-12 pt-1">
                <div class="row justify-content-around d-flex">
                    <div class="my-2 mx-1"><a class="btn btn-success" href="{{ route('forum.admin.posts.create') }}">Создать</a></div>
                    <div class="my-2 mx-1"><a class="btn btn-dark" href="{{ route('forum.admin.index') }}">Вернутся назад</a></div>
                    @if ($posts->total() > $posts->count())
                        <div class="my-2 mx-1">{{ $posts->links() }}</div>
                    @endif
                </div>
            </div>
    </div>
@endsection
