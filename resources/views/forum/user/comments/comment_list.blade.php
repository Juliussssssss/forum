<div class="container">
    <div class="row">
        @forelse ($comments as $comment)
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-2 col-sm-3 border-right pr-0">
                            <ul class="m-0">
                                <li class="p-3 border-bottom">{{ $comment->user->name }}</li>
                                <li class="text-center"><img class="img-fluid" src="{{ asset('/storage/'.$comment->user->image) }}" alt=""></li>
                            </ul>
                        </div>
                        <div class="col-10 col-sm-9 pl-0">
                            <ul class="d-flex align-items-start flex-column bd-highlight mb-3 h-100 w-100">
                                <li class="w-100 list-group-item mb-auto bd-highlight border-0">
                                    @if ($comment->post_id_answer)
                                        @if (!empty($comment->commentAnswer->comment))
                                            <span class="list-group-item bg-light m-2 border" id="answerPost" value="{{ $comment->post_id_answer }}">{{ $comment->commentAnswer->comment }}</span>
                                        @else
                                            <span class="list-group-item bg-light m-2 border" id="answerPost" value="{{ $comment->post_id_answer }}">Сообщение удалено</span>
                                        @endif
                                    @endif
                                    <span id="commentContent">{{ $comment->comment }}</span>
                                </li>
                                <li id="commentContent" class="w-100 list-group-item bd-highlight border-0 text-center">
                                    <span class="pl-3 px-1 small d-block d-md-inline">Опубликовано: {{ $comment->created_at }}</span>
                                    @if ($comment->created_at != $comment->updated_at)
                                        <span class="px-1 pl-3 small">Отредактировано: {{ $comment->updated_at }}</span>
                                    @endif
                                </li>
                                <li class="w-100 list-group-item p-1 bd-highlight border-0">
                                    <div id="inLi" class="row justify-content-center">
                                        <div class="col-6 col-sm-4 text-center">
                                            <button class="answer btn btn-light btn-sm border" name="answer" value="{{ $comment->id }}">Ответить</button>
                                        </div>
                                        @if (Auth::user() && $comment->user->name == Auth::user()->name || Auth::user()->is_admin == 1)
                                            <div class="col-6 col-sm-4 text-center">
                                                <form method="POST" action="{{ route('forum.comment.destroy', $comment->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="delete btn btn-light btn-sm border">Удалить</button>
                                                </form>
                                            </div>
                                            <div class="col-6 col-sm-4 text-center pt-sm-0 pt-2">
                                                <button class="edit btn btn-light btn-sm border" value="{{ $comment->id }}">Редактировать</button>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="p-2"></div>
            </div>
            @empty
                <div class="col-12">
                    Ты можешь первым оставить коментарий )
                </div>
        @endforelse
    </div>
</div>
<script src="{{ asset('/js/answer.js') }}"></script>
@include('forum.user.comments.add_comment')

