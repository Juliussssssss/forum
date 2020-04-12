@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center p-4 p-sm-0">
            <div class="col-12"><h3>Редактирование категорий</h3></div>
            <div class="col-12">
                <div class="row bg-primary text-white p-3 rounded-sm">
                    <div class="col-1 col-sm-3">
                        <span>#</span>
                    </div>
                    <div class="col-4">
                        <span>Катеогрия</span>
                    </div>
                    <div class="col-4">
                        <span>Родитель</span>
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row bg-light p-2 rounded-sm border-info border">
                    <div class="col-12">
                        @foreach ($categories as $category)
                            <div class="row py-2 border-bottom">
                                <div class="col-1 col-sm-3">
                                    <span>{{ $category->id }}</span>
                                </div>
                                <div class="col-5 col-sm-4">
                                    <a href="{{ route('forum.admin.categories.edit', $category->id) }}">{{ $category->title }}</a>
                                </div>
                                <div class="col-4 col-sm-4" @if(in_array($category->parent_id, [0, 1])) style="color:#ccc" @endif>
                                    <span>{{ $category->parentCategory['title'] }}</span>
                                </div>
                                <div class="col-1 d-flex justify-content-around pt-md-0 pt-2">
                                    <form class="ml-2" method="POST" action="{{ route('forum.admin.categories.destroy', $category->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger m-0 px-1 py-0">x</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 pt-1">
                        <div class="row justify-content-around d-flex">
                            <div class="my-2 mx-1"><a class="btn btn-success" href="{{ route('forum.admin.categories.create') }}">Создать</a></div>
                            <div class="my-2 mx-1"><a class="btn btn-dark" href="{{ route('forum.admin.index') }}">Вернутся назад</a></div>
                            @if ($categories->total() > $categories->count())
                                <div class="my-2 mx-1">{{ $categories->links() }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
