@if (count($tasks) > 0)
<ul class="media-list">
@foreach ($tasks as $task)
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($task->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {{ $task->name }}
            </div>
            <div>
                <p>{!! link_to_route('tasks.show', 'View profile', ['id' => $task->id]) !!}</p>
            </div>
        </div>
    </li>
<! - Omission ->
@endforeach
</ul>
{!! $tasks->render() !!}
@endif