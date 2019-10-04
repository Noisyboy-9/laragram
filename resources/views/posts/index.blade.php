@extends('layouts.master')

@section('title' , 'POSTS')

@section('content')
    <file-uploader field="image" ></file-uploader>



    <div class="gallery">
        @foreach($posts as $post)
            <div class="gallery__container">
                <img src="/storage/{{ $post->path }}" class="gallery__image" alt="Gallery Image">
            </div>
        @endforeach
    </div>

@endsection
