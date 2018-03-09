@extends('layouts.app')

@section('content')

<h1>タスク新規作成ページ</h1>

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {!! Form::model($task, ['route' => 'tasks.store']) !!}
    
    　　{!! Form::label('status', 'ステータス:') !!}
        {!! Form::text('status') !!}


        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content') !!}

        {!! Form::submit('追加') !!}

    {!! Form::close() !!}


@endsection