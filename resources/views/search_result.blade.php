@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <form method="POST" class="input-group mb-3" action="{{ route('search') }}">
                    @method('GET')
                    @csrf
                    <input class="form-control rounded-left" type="text" id="search" name="search" placeholder="Search" value="{{ $answer['search'] }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12 pt-3">
                <h3>Поиск в категориях:</h3>
                <ul class="m-0">
                    @forelse ($answer['categories'] as $category)
                        <li class="list-group-item border rounded-0">
                            <a class="pointer text-black-50" href="{{ route('forum.post.show', $category->id) }}">
                                <h4 class="font-weight-bold">{{ $category->title }}</h4>
                                <span>{{ $category->description }}</span>
                            </a>
                        </li>
                    @empty
                        <span class="text-danger pl-3">Поиск не дал результата</span>
                    @endforelse
                </ul>
            </div>
            <div class="col-12 pt-3">
                <h3>Поиск в темах:</h3>
                <ul class="m-0">
                    @forelse ($answer['posts'] as $post)
                        <li class="list-group-item border rounded-0">
                            <a class="pointer text-black-50" href="{{ route('forum.post.show', $post->id) }}">
                                <h4 class="font-weight-bold">{{ $post->title }}</h4>
                                <span>Автор: {{ $post->user->name }}</span>
                            </a>
                        </li>
                        @empty
                            <span class="text-danger pl-3">Поиск не дал результата</span>
                    @endforelse
                </ul>
                <div class="col-12 d-flex pt-4 pl-0">
                    <span>{{ $answer['posts'] }}<span>
                    <a class="btn btn-dark mt-3" href="/">Вернуться на главную</a>
                </div>
            </div>
        </div>
    </div>

@endsection
