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
                                       value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Смена почты</label>
                                <input id="email"
                                       name="email"
                                       type="text"
                                       class="form-control"
                                       value="{{ $user->email }}">
                                <label class="small">(При смене почты требуется заново ее подтвердить)</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                    <label class="custom-file-label" id="image" for="form-control-file">Выберете фото</label>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/customInput.js') }}"></script>
@endsection
