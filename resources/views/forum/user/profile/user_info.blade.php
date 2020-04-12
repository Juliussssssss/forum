@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        @include('forum.user.profile.result_message')
        <div class="row">
            <div class="col-12">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('На ваш адрес электронной почты была отправлена ​​новая ссылка для подтверждения.') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-dark text-success">Информация вользователя</div>
                    <div class="card-body">
                        <div class="row py-4">
                            <div class="col-12 col-md-4 col-lg-6 text-center">
                                <img class="img-fluid rounded-sm" src="{{ asset('/storage/'.$user->image) }}" alt="">
                            </div>
                            <div class=" col-12 col-md-8 col-lg-6 align-items-center d-flex">
                                <div>
                                    <div class="d-flex py-4">
                                        <h3>Никнейм:</h3>
                                        <h4 class="pl-3">{{ $user->name }}</h4>
                                    </div>
                                    <div class="d-flex pt-4 flex-wrap">
                                        <h3>Действующая почта:</h3>
                                        <h4 class="pl-3">{{ $user->email }}</h4>
                                    </div>
                                    <div class="d-flex">
                                        @if (empty($user->email_verified_at))
                                            <form class="pb-4" method="POST" action="http://forum/email/resend">
                                                @csrf
                                                <button type="submit" class="w-100 rounded-sm border-danger border d-block text-center text-danger">Почта не подтверждена, нажмите сюда для подтверждения</button>
                                            </form>
                                        @else
                                            <div class="pb-4"><span class="rounded-sm d-block border border-success text-center text-success">Почта подтверждена</span></div>
                                        @endif
                                    </div>
                                    <div class="d-flex py-4">
                                        <h3>На сайте с:</h3>
                                        <h4 class="pl-3">{{ $user->created_at }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 justify-content-around d-flex pt-3">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-success">Сменить пароль</a>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-success">Сменить данные</a>
                                <a href="{{ route('forum.post.index') }}" class="btn btn-outline-success">Мои темы</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
