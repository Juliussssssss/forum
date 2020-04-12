@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12"><h3>Редактирование пользователей</h3></div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex flex-wrap justify-content-center">
                        @foreach ($users as $user)
                            <div class="card m-3" style="width: 18rem;">
                                <a href="{{ route('forum.admin.users.edit', $user->id) }}">
                                    <img class="user-image border-bottom" src="{{ asset('/storage/'.$user->image) }}">
                                </a>
                                <div class="card-body">
                                    <a class="text-dark" href="{{ route('forum.admin.users.edit', $user->id) }}">
                                        <p class="card-title">Имя: {{ $user->name }}</p>
                                        <p class="card-text">Почта: {{ $user->email }}</p>
                                        <p class="card-text">Создан: {{ $user->created_at }}</p>
                                        <p class="card-text">Подтвержден:
                                            @if(empty($user->email_verified_at))
                                                Нет
                                            @else
                                                Да
                                            @endif
                                       </p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 pt-1">
            <div class="row justify-content-around d-flex">
                <div class="my-2 mx-1"><a class="btn btn-success" href="{{ route('forum.admin.users.create') }}">Создать</a></div>
                <div class="my-2 mx-1"><a class="btn btn-dark" href="{{ route('forum.admin.index') }}">Вернутся назад</a></div>
                @if ($users->total() > $users->count())
                    <div class="my-2 mx-1">{{ $users->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
