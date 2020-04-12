@extends('layouts.default.default')

@section('title', 'Document')

@section('content')
    <div class="container my-5">
        @include('forum.admin.result_message')
        @if($item->exists)
            <form method="POST" action="{{ route('forum.admin.categories.update', $item->id) }}">
                @method('PATCH')
        @else
            <form method="POST" action="{{ route('forum.admin.categories.store') }}">
        @endif
            @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('forum.admin.categories.includes.item_edit_main_col')
                    </div>
                    <div class="col-md-4">
                        @include('forum.admin.categories.includes.item_edit_add_col')
                    </div>
                </div>
            </form>
        </div>
@endsection
