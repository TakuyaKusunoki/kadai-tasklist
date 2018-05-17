@extends("layouts.app")

@section("content")

<!--ここにコンテンツを書く-->
    <h1>タスク新規作成ページ</h1>
    
    {!! Form::model($task, ["route" => "tasks.store"]) !!}
        
        {!! Form::label("status", "状態:") !!}
        {!! Form::text("status") !!}
        
        {!! Form::label("content", "タスク:") !!}
        {!! Form::text("content") !!}
        
        {!! Form::submit("登録") !!}
        
    {!! Form::close() !!}
@endsection