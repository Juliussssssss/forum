@php
    /** @var  \App\Models\ForumPost $item */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body justify-content-between d-flex">
                <button class="btn btn-primary" type="submit">Сохранить</button>
                <a class="btn btn-dark text-white" href="{{ route('forum.admin.posts.index') }}">Назад</a>
            </div>
        </div>
    </div>
</div>
@if($item->exists)
    <div class="block mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <us class="list-unstyled">
                            <li>ID: {{ $item->id }}</li>
                        </us>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Создано</label>
                            <input type="text" value="{{ $item->created_at }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="title">Изменено</label>
                            <input type="text" value="{{ $item->updated_at }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="title">Опубликовано</label>
                            <input type="text" value="{{ $item->published_at }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<?php
