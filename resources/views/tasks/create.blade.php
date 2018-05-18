@extends("layouts.app")

@section("content")

<!--ここにコンテンツを書く-->
    <h1>タスク新規作成ページ</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
            {!! Form::model($task, ["route" => "tasks.store"]) !!}
                
                <div class="form-group">
                    {!! Form::label("content", "タスク:") !!}
                    {!! Form::text("content", null, ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("status", "状態:") !!}
                    {!! Form::text("status", null, ["class" => "form-control"]) !!}
                </div>
                
                {!! Form::submit("登録", ["class" => "btn btn-warning"]) !!}
                
            {!! Form::close() !!}
        </div>
    </div>
@endsection