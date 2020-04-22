@php
    /** @var \App\Models\ForumPost  $item */
    /** @var \Illuminate\Support\Collection $categoryList */
@endphp
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input name="title" value="{{ old('title', $item->title) }}"
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
                    <label for="category_id">Категория</label>
                    <select name="category_id"
                            id="category_id"
                            class="form-control"
                            placeholder="Выберете категорию"
                            required>
                        @foreach($categoryList as $categoryOption)
                            <option value="{{ $categoryOption->id }}"
                                    @if($categoryOption->id == $item->category_id) selected @endif>
                                {{ $categoryOption->title_for_combobox}}
                            </option>
                        @endforeach
                    </select>
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
                    <label for="is_published" class="form-check-label">Опубликовано</label>
                </div>
            </div>
{{--                        <div class="tab-pane" id="adddata" role="tab-panel">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="slug">Иденитифакор</label>--}}
{{--                                <input name="slug" value="{{ $item->slug }}"--}}
{{--                                       id="slug"--}}
{{--                                       type="text"--}}
{{--                                       class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="excerpt">Выдержка</label>--}}
{{--                                <textarea name="excerpt" value="{{ $item->excerpt }}"--}}
{{--                                       id="excerpt"--}}
{{--                                       rows="3"--}}
{{--                                       class="form-control">{{ old('excerpt', $item->excerpt) }}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
        </div>
    </div>
</div>
