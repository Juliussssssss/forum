@php
    /** @var \App\Models\ForumPost  $item */
    /** @var \Illuminate\Support\Collection $categoryList */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                @if($item->created_at)
                    Редактирование
                    @if (!$item->published_at)
                        черновика
                    @endif
                @else
                    Создание
                @endif
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input name="title" value="{{ $item->title }}"
                           id="title"
                           type="text"
                           class="form-control"
                           minlength="3"
                           required>
                </div>
                <div class="form-group">
                    <label class="content_row">Статья</label>
                    <textarea name="content_row"
                              id="content_row"
                              class="form-control"
                              rows="20">{{ old('content_row', $item->content_row) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category_id">Категория: </label>
                    <input value="@if ($item->created_at){{ $item->category_id }}@else{{ $category_id }}@endif"
                           name="category_id"
                           id="category_id"
                           type="hidden"
                           readonly="readonly">
                    @if ($item->exists)
                        <span>{{ $item->category->title }}</span>
                    @else
                        <span>{{ $categoryName->title }}</span>
                    @endif
                </div>
                <div class="form-check">
                    <input name="is_published"
                           type="hidden"
                           value="0">
                    <input name="is_published"
                           type="checkbox"
                           value="1"
                           class="form-check-input"
                           value="{{ $item->is_published }}"
                           @if ($item->is_published)
                           checked="checked"
                           @endif>
                        <label for="is_published" class="form-check-label">Опубликовать</label>
                </div>
            </div>
        </div>
    </div>
</div>
