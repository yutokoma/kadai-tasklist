@extends('layouts.app')

@section('content')

    <h1>id = {{ $Task->id }} のメッセージ詳細ページ</h1>

    <p>{{ $Task->content }}</p>
    {!! link_to_route('tasks.edit', 'このメッセージを編集', ['id' => $Task->id]) !!}

    {!! Form::model($Task, ['route' => ['tasks.destroy', $Task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除') !!}
    {!! Form::close() !!}

@endsection