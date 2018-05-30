@extends('layouts.app')

@section('content')

    <h1>id: {{ $Task->id }} のメッセージ編集ページ</h1>

    {!! Form::model($Task, ['route' => ['tasks.update', $Task->id], 'method' => 'put']) !!}

        {!! Form::label('content', 'メッセージ:') !!}
        {!! Form::text('content') !!}

        {!! Form::submit('更新') !!}

    {!! Form::close() !!}

@endsection