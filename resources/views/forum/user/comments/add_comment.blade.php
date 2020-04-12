<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form name="form" method="POST" action="{{ route('forum.comment.store') }}">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea name="comment"
                                      id="comment"
                                      class="form-control"
                                      rows="10"></textarea>
                        </div>
                        <input type="hidden"
                               name="post_id_answer"
                               id="post_id_answer"
                               value="">
                        <input type="hidden"
                               name="post_id"
                               id="post_id"
                               value="{{ $post->id }}">
                        <button type="submit"
                                class="btn btn-outline-secondary"
                                id="send">
                            Отправить
                        </button>
                        <span hidden="true" id="cancelAnswer">(нажми для отмены ответа)</span>
                        <span hidden="true" id="cancelEditing">(нажми для отмены редактирования)</span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

