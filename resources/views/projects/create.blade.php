@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <form action="{{ route('projects.store') }}" method="POST" id="form">
            @csrf
            <div class="form-group">
                <label for="title">@lang('Название')</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="description">@lang('Описание проекта')</label>
                <textarea rows="5" name="description" type="text" class="form-control" id="description"></textarea>
            </div>
            <div id="drop-area">
                <label for="file" id="file-label">@lang('Загрузить изображения')</label>
{{--                <input type="file" accept="image/*" multiple name="files" id="file">--}}
                <div id="gallery"></div>
            </div>
            <button type="submit" class="btn btn-primary">@lang('Сохранить')</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file');
        const form = document.getElementById('form');
        const files = [];

        form.addEventListener('submit', preventDefaults, false);

        form.addEventListener('submit', function (e) {

            const formData = new FormData(this);

            files.forEach(file => formData.append('files[]', file));

            fetch(this.action,
                {
                    method: 'POST',
                    body: formData,
                    redirect: 'follow'
                }
            ).then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            })
            .catch(error => {

            })
        });

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false)
        });

        function preventDefaults(e) {
            e.preventDefault()
            e.stopPropagation()
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false)
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false)
        });

        function highlight(e) {
            dropArea.classList.add('highlight')
        }

        function unhighlight(e) {
            dropArea.classList.remove('highlight')
        }

        dropArea.addEventListener('drop', handleDrop, false)

        function handleDrop(e) {
            let dt = e.dataTransfer;
            let f = Array.prototype.slice.call(dt.files);

            f.forEach(file => {
                files.push(file);
            });

            f.forEach(f => previewFile(f));
        }

        fileInput.addEventListener('change', function (e) {
            previewFile(e.target.files[0]);
        })

        function previewFile(file) {
            let reader = new FileReader()
            reader.readAsDataURL(file)
            reader.onloadend = function () {
                let img = document.createElement('img');
                img.src = reader.result;
                img.className = 'gallery__image';
                const gallery = document.getElementById('gallery');
                gallery.appendChild(img);
            }
        }
    </script>
@stop

@section('styles')
    <style>
        #drop-area {
            margin: 30px 0;
            background-color: #f7f7f9;
            min-height: 300px;
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #drop-area.highlight {
            background-color: #fcfcfd;
        }

        #file {
            display: none;
        }

        .gallery__image {
            width: 100px;
            height: auto;
            object-fit: cover;
        }
    </style>
@stop
