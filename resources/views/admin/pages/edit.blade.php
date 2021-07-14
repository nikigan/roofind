@extends("adminlte::page")

@section("content")
    {!! Form::model($page ?? '', ['route' => $route]) !!}
    {!! Form::text('title') !!}
    {!! Form::textarea('content') !!}
    {!! Form::close() !!}
@stop
