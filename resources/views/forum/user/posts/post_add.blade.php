@extends('layouts.default.default')

@section('title', 'Document')

@section('content')

    @php
        /** @var \App\Models\ForumPosts $item */
    @endphp

    <div class="container my-5">
        @php
            /** @var \Illuminate\Support\ViewErrorBag $errors */
        @endphp

        @include('forum.admin.result_message')

        @if($item->exists)
            <form method="POST" action="{{ route('forum.post.update', $item->id) }}">
                @method('PATCH')
                @else
                    <form method="POST" action="{{ route('forum.post.store') }}">
                        @endif
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('forum.user.posts.includes.item_edit_main_col')
                            </div>
                            <div class="col-md-4">
                                @include('forum.user.posts.includes.item_edit_add_col')
                            </div>
                        </div>
                    </form>
    </div>
@endsection
