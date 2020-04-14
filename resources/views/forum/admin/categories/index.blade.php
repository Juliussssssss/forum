@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        @include('forum.admin.result_message')
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
                                    <span>{{ $category->title }}</span>
                                </div>
                                <div class="col-4 col-sm-4" @if(in_array($category->parent_id, [0, 1])) style="color:#ccc" @endif>
                                    <span>{{ $category->parentCategory['title'] }}</span>
                                </div>
                                <div class="col-1 d-flex justify-content-around pt-md-0 pt-2">
                                    <div>
                                        <a href="{{ route('forum.admin.categories.edit', $category->id) }}">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                version="1.1" id="Capa_1"
                                                x="0px"  y="0px"
                                                width="17px" height="25px"
                                                viewBox="0 0 485.219 485.22"
                                                style="enable-background:new 0 0 485.219 485.22;"
                                                xml:space="preserve">
                                            <g>
                                                <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z"/>
                                            </g>
                                            </svg>
                                        </a>
                                    </div>
                                    <div>
                                        <form class="ml-2" method="POST" action="{{ route('forum.admin.categories.destroy', $category->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger m-0 px-1 py-0">x</button>
                                        </form>
                                    </div>
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
