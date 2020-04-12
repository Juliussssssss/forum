@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        @include('forum.user.result_message')
        <div class="row">
            <div class="col-12"><h3>Все ваши темы</h3></div>
            @if (empty($posts->total()))
                <h4 class="text-danger pl-5">У вас нету тем</h4>
            @else
                <div class="col-12">
                    <div class="row bg-primary text-white p-3 rounded-sm">
                        <div class="col-6 col-sm-2">
                            <span>Катеогрия</span>
                        </div>
                        <div class="col-6 col-sm-3">
                            <span>Опубликована</span>
                        </div>
                        <div class="col-11 col-sm-6">
                            <span>Заголовок</span>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row bg-light p-2 rounded-sm border-info border">
                        @foreach($posts as $post)
                            <div class="col-12 py-2" @if(!$post->is_published) style="background-color: #ccc" @endif>
                                <div class="row">
                                    <div class="col-6 col-sm-2">{{ $post->category->title }}</div>
                                    <div class="col-6 col-sm-3">
                                        @if (empty($post->published_at))
                                            Не опубликован
                                        @else
                                            Опубликован
                                        @endif
                                    </div>
                                    <div class="col-11 col-sm-6">
                                        <a href="{{ route('forum.post.edit', $post->id) }}">{{ $post->title }}</a>
                                    </div>
                                    <div class="col-1">
                                        <form class="ml-2" method="POST" action="{{ route('forum.post.destroy', $post->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger m-0 px-1 py-0">x</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                </div>
                </div>
                <div class="col-12 pt-1">
                    <div class="row justify-content-around d-flex">
                        <div class="my-2 mx-1"><a class="btn btn-dark" href="{{ route('user.index') }}">Вернутся назад</a></div>
                        @if ($posts->total() > $posts->count())
                            <div class="my-2 mx-1">{{ $posts->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
@endsection
