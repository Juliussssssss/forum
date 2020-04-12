<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>Список всех постов</p>
        </div>
        <div class="col-md-12">
            <ul class="list-group list-group-flush">
                 @forelse ($posts as $item)
                    <li class="list-group-item border">
                        <a class="pointer text-black-50" href="{{ route('forum.post.show', $item->id) }}">
                            <h4 class="font-weight-bold">{{ $item->title }}</h4>
                            <span class="d-block">Автор: {{ $item->user->name }}</span>
                        </a>
                    </li>
                @empty
                    <p>К сожалению больше постов нет(</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>
