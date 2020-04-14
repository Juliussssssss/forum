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
                            <strong>Заголовок: </strong>
                            {{ $post->title }}
                        </div>
                        <div class="col-1 col-sm-1 p-0 d-flex">
                            <div>
                                <a href="{{ route('forum.admin.posts.edit', $post->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1"
                                         x="0px" y="0px"
                                         width="17px" height="25px"
                                         viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;"
                                         xml:space="preserve">
                                        <g>
                                            <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z"/>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <form class="ml-2" method="POST" action="{{ route('forum.admin.users.destroy', $post->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger m-0 px-1 py-0">x</button>
                                </form>
                            </div>
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
