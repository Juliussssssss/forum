@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Приветсвую в админке</div>
                    <div class="card-body text-center">
                        <a class="btn btn-primary m-2" href="{{ route('forum.admin.categories.index') }}">Редактировать категории</a>
                        <a class="btn btn-primary m-2" href="{{ route('forum.admin.posts.index') }}">Редактировать посты</a>
                        <a class="btn btn-primary m-2" href="{{ route('forum.admin.users.index') }}">Редактировать пользователей</a>
                        <a class="btn btn-dark text-white m-2" href="/">Вернутся на главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
