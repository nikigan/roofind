@extends('layouts.app')

@section('title')@lang('Список проектов')@endsection

@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-12 text-right">
                <a class="btn btn-primary"
                   href="{{ route('projects.create') }}">@lang('Создать новый проект')</a>
            </div>
        </div>
        <div class="row my-3">
            @if($projects->isEmpty())
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="p-5 bg-white">
                            @lang("Список проектов пуст!")
                        </div>
                    </div>
                </div>
            @else
                <div class="card-deck w-100">
                    @foreach($projects as $project)
                        <div class="col-lg-4">
                            <div class="card project-card shadow-sm">
                                <img src="{{ $project->first_image }}">
                                <div class="p-3">
                                <h3>{{ $project->title }}</h3>
                                <p>{{ $project->excerpt }}</p>
                                </div>
                                <a class="btn btn-primary" href="{{ route('projects.edit', '$project') }}">Изменить</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
