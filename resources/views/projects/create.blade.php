@extends('layouts.app')

@section('content')
<div class="container p-5">
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">@lang('Название')</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="description">@lang('Описание проекта')</label>
            <textarea rows="5" name="description" type="text" class="form-control" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">@lang('Сохранить')</button>
    </form>
</div>
@endsection
