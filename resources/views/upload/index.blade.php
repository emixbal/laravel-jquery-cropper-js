@extends('adminlte::page')

@section('title', 'Upload')

@section('content_header')
    <h3>Scan Folder</h3>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="/upload">
            @csrf
            
            <div class="form-group">
                <label>Folder Name</label>
                <input type="text" class="form-control" name="folder_name" value="{{ old('folder_name') }}">
            </div>
            
            <div class="form-group">
                <label>Dir Path</label>
                <input type="text" class="form-control" name="path" value="{{ old('path') }}">
            </div>
            
            <div class="form-group">
                <button class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css" />
@stop

@pushOnce('js')
    <script src="{{ asset('js/upload/index.js')}}"></script>
@endPushOnce
