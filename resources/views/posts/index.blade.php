@extends('layouts.master')

@section('title' , 'POSTS')

@section('content')
    <form class="form" action="/posts" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form__group">
            <input name="image" type="file">
        </div>

        <div class="form__group">
            <button type="submit" class="btn btn--primary">Upload</button>
        </div>
    </form>

    <div class="gallery">
        @foreach($posts as $post)
            <div class="gallery__container">
                <img src="/storage/{{ $post->path }}" alt="Image Gallery">
            </div>
        @endforeach
    </div>

@endsection
