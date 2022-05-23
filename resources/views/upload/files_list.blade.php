@extends('adminlte::page')

@section('title', 'Upload')

@section('content_header')
    <h3>List Files</h3>
@stop

@section('content')

@php
echo "folder_name: ".session('folder_name')."<br />";
echo "path: ".session('path')."<br />";
@endphp

<form method="POST" action="/remove_path">
    @csrf
    <div class="form-group">
        <button class="btn btn-primary">Remove path</button>
    </div>
</form>

<hr />

@foreach($files as $file)
    @if ($file != '.' && $file != '..')
        <a href="{{ url('/detail_cropper') }}/{{$file}}">{{$file}}</a>
        <br />
    @endif
@endforeach

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css" />
@stop

@pushOnce('js')
    <script src="{{ asset('js/upload/index.js')}}"></script>
@endPushOnce
