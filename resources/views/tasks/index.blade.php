@extends('layouts.app')

@section('content')
<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-sm-offset-2 col-sm-8 col-ig-offset-3 col-ig-6">
@if (Auth::check())
<h1>タスク一覧</h1>

    @if (count($tasks) > 0)
        <ul>
            @foreach ($tasks as $task)
                <li>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!} : {{ $task->status }}>{{ $task->content }}</li>
            @endforeach
        </ul>
    @endif
    {!! link_to_route('tasks.create', '新規タスクの投稿') !!}
</div>

@else
<div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Tasklist</h1>
            {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endif
@endsection