@extends('layouts.master')

@section('title' , 'POSTS')

@section('content')
    <div class="form__container">
        <form class="form" action="/posts" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="image" class="form__upload--label">
                +
                <input name="image" class="u-hidden" id="image" type="file">
            </label>

            <button type="submit" class="btn btn--primary">Upload</button>
        </form>
    </div>


    <div class="gallery">
        @foreach($posts as $post)
            <div class="gallery__container">
                <img src="/storage/{{ $post->path }}" class="gallery__image" alt="Gallery Image">
            </div>
        @endforeach
    </div>

@endsection
