@extends('adminlte::page')

@section('title', 'Crop File')

@section('content')

<div class="row">
  <div class="col-sm-8">
    <div>
      <img id="image" src="{{ route('show_image') }}?p={{ Session::get('path')}}/{{$file_name}}">
    </div>
  </div>

  <div class="col-sm-4">
    <div id="place_image">
    </div>
    <button class="btn btn-primary" id="crop">
      crop
    </button>
    <button class="btn btn-primary" id="plus">
      +
    </button>
    <button class="btn btn-primary" id="minus">
      -
    </button>
    <hr />
    <form method="POST" action="/upload">
      @csrf
      <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="neme" value="{{ old('neme') }}">
      </div>
      
      <div class="form-group">
          <label>NIK</label>
          <input type="text" class="form-control" name="nik" value="{{ old('nik') }}">
      </div>

      <div class="form-group">
          <label>NIP</label>
          <input type="text" class="form-control" name="nip" value="{{ old('nip') }}">
      </div>

      <div class="form-group">
          <label>Alamat</label>
          <textarea class="form-control" name="alamat" value="{{ old('alamat') }}"></textarea>
      </div>
      
      <div class="form-group">
          <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

@stop

@section('css')
  <link  href="{{ asset('vendor/jscropper/dist/cropper.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="/css/cropper_custom.css" />
@stop

@pushOnce('js')
  <script src="{{ asset('vendor/jquery/jquery.js')}}"></script>
  <script src="{{ asset('vendor/jscropper/dist/cropper.js')}}"></script>
  <script src="{{ asset('vendor/jscropper/dist/jquery-cropper.js')}}"></script>
  <script src="{{ asset('js/upload/cropper_custom.js')}}"></script>
@endPushOnce