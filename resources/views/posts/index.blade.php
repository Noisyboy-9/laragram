@extends('layouts.app')

@section('title' , 'POSTS')

@section('content')
    <posts-page uploadTitle="image" :posts="{{ $posts }}"></posts-page>
@endsection
