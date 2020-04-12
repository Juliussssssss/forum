@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        @include('forum.user.profile.result_message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('user.update', $user->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Введите новое имя</label>
                                <input id="name"
                                       name="name"
                                       type="text"
                                       class="form-control"
                                       placeholder="{{ $user->name }}">
                                <label class="small">(От 5 до 20 символов)</label>
                            </div>
                            <div class="form-group">
                                <label for="email">Смена почты</label>
                                <input id="email"
                                       name="email"
                                       type="text"
                                       class="form-control"
                                       placeholder="{{ $user->email }}">
                                <label class="small">(При смене почты требуется заново ее подтвердить)</label>
                            </div>
                            <div class="form-group">
                                <label for="FormControlFile1">Новое фото</label>
                                <input type="file" id="image" name="image" class="form-control-file">
                            </div>
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
