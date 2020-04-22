@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                @include('forum.admin.result_message')
                <div class="card">
                    <div class="card-header">
                        @if ($item->exists)
                            Редактирование пользователя
                        @else
                            Создание пользователя
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($item->exists)
                            <form method="POST" action="{{ route('forum.admin.users.update', $item->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                        @else
                            <form method="POST" action="{{ route('forum.admin.users.store') }}" enctype="multipart/form-data">
                                @method('POST')
                        @endif
                            @csrf
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input class="form-control"
                                           type="text"
                                           name="name"
                                           id="name"
                                           value="{{ $item->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Почта</label>
                                    <input class="form-control"
                                           type="text"
                                           name="email"
                                           id="email"
                                           value="{{ $item->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input class="form-control"
                                           type="text"
                                           name="password"
                                           id="password"
                                           placeholder="Новый пароль">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                        <label class="custom-file-label" id="image" for="form-control-file">Выберете фото</label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input name="email_verified_at"
                                           type="hidden"
                                           value="0">
                                    <input name="email_verified_at"
                                           id="email_verified_at"
                                           type="checkbox"
                                           value="1"
                                           class="form-check-input"
                                           value="{{ $item->email_verified_at }}"
                                           @if ($item->email_verified_at)
                                           checked="checked"
                                        @endif>
                                    <label for="email_verified_at" class="form-check-label">Прошел проверку почты</label>
                                </div>
                                <div class="form-check">
                                    <input name="is_admin"
                                           type="hidden"
                                           value="0">
                                    <input name="is_admin"
                                           type="checkbox"
                                           id="is_admin"
                                           value="1"
                                           class="form-check-input"
                                           value="{{ $item->is_admin }}"
                                           @if ($item->is_admin)
                                           checked="checked"
                                        @endif><label for="is_admin" class="form-check-label">Является админом</label>
                                </div>
                            <button class="btn btn-success mt-3" type="submit">Сохранить</button>
                                <a class="mt-3 btn btn-dark text-white" href="{{ route('forum.admin.users.index') }}">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/customInput.js') }}"></script>
@endsection
