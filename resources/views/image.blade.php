@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="width: 200px; height: 200px;">
            <img src="/{{ $image->path }}" alt="" style="object-fit: contain" class="w-100 h-100">
        </div>
    </div>
    <form action="{{ route('todo.image.update', ['image_id' => $image->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input class="d-none" type="file" name="image" placeholder="Choose image" onchange="form.submit()" id="image">

        <svg onmouseover="" style="cursor: pointer;" onclick="document.getElementById('image').click()"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
            <path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path>
        </svg>
    </form>


    <form action="{{ route('todo.image.delete', ['image_id' => $image->id]) }}" method="post">
        @method('DELETE')
        @csrf
        <svg onmouseover="" style="cursor: pointer;" onclick="document.getElementById('delete-image').click()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
            <path d="M11 1.75V3h2.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75ZM4.496 6.675l.66 6.6a.25.25 0 0 0 .249.225h5.19a.25.25 0 0 0 .249-.225l.66-6.6a.75.75 0 0 1 1.492.149l-.66 6.6A1.748 1.748 0 0 1 10.595 15h-5.19a1.75 1.75 0 0 1-1.741-1.575l-.66-6.6a.75.75 0 1 1 1.492-.15ZM6.5 1.75V3h3V1.75a.25.25 0 0 0-.25-.25h-2.5a.25.25 0 0 0-.25.25Z"></path>
        </svg>
        <button type="submit" class="d-none" id="delete-image"></button>
    </form>


@endsection
