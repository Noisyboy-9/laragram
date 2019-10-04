@extends('layouts.master')

@section('title' , 'POSTS')

@section('content')
    <form class="form" action="/posts" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form__group">
            <input type="file">
        </div>

        <div class="form__group">
            <button type="submit" class="btn btn--primary">Upload</button>
        </div>
    </form>
@endsection
