@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 mb-2">
                <h3>Список категорий</h3>
            </div>
            <div class="col-12">
                <ul class="list-group list-group-flush">
                    @forelse ($answer['categories'] as $category)
                        <li class="list-group-item border">
                            <a class="pointer text-black-50" href="{{ route('forum.categories.id', $category->id) }}">
                                <h4 class="d-block font-weight-bold ">{{ $category->title }}</h4>
                                <span class="d-block">{{ $category->description }}</span>
                            </a>
                        </li>
                        @empty
                            <h5 class="pl-3 text-danger">К сожалению больше категорий нет(</h5>
                    @endforelse
                </ul>
            </div>
            @if (!empty($answer['posts']))
            <div class="col-12 mt-4 mb-2">
                <h3>Список тем</h3>
            </div>
            <div class="col-12">
                <ul class="list-group list-group-flush">
                    @forelse ($answer['posts'] as $post)
                        <li class="list-group-item border">
                            <a class="pointer text-black-50" href="{{ route('forum.post.show', $post->id) }}">
                                <h4 class="d-block font-weight-bold ">{{ $post->title }}</h4>
                                <span class="d-block">{{ $post->description }}</span>
                            </a>
                        </li>
                        @empty
                            <h5 class="pl-3 text-danger">Тем нету</h5>
                    @endforelse
                </ul>
            </div>
            @endif
        </div>
    </div>
    @if (!empty($posts))
        @include('forum.user.posts.post_list')
    @endif
    @if ($id>1)
        <div class="container mb-5">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('forum.post.create', $id) }}" class="mt-3 btn btn-success text-white">Добавить тему</a>
                </div>
            </div>
        </div>
    @endif
@endsection
