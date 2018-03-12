@extends('layouts.app')

@section('content')
<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-sm-offset-2 col-sm-8 col-ig-offset-3 col-ig-6">

<h1>id = {{ $task->id }} のタスク詳細ページ</h1>
    
    <p>タスク：　{{ $task->content }}</p>
    <p>ステータス：　{{ $task->status }}</p>
    {!! link_to_route('tasks.edit', 'このタスク編集', ['id' => $task->id]) !!}
    
    {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除') !!}
    {!! Form::close() !!}
</div>

@endsection
