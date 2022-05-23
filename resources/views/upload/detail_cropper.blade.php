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
    <div class="rectangle">
      <div id="place_image"></div>
    </div>
    <button class="btn btn-primary" id="crop">
      crop
    </button>
    <button class="btn btn-primary" id="minus">
      <<
    </button>

    <button class="btn btn-primary" id="plus">
      >>
    </button>

    <div class="form-check mt-2">
      <input class="form-check-input" type="checkbox" id="is_no_photo" name="is_no_photo" value=1>
      <label class="form-check-label">Belum ada foto?</label>
    </div> 
    
    <hr />
      <input type="text" id="file_name" value="{{ $file_name }}" hidden> 
      <div class="form-group">
          <label>Unit Kerja</label>
          <input type="text" class="form-control" id="folder_name" value="{{ session('folder_name') }}">
      </div>

      <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" id="nama" value="{{ old('nama') }}">
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" id="pob" value="{{ old('pob') }}">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="text" class="datepicker form-control" id="dob" value="{{ old('dob') }}">
          </div>
        </div>
      </div>

      <div class="form-group">
          <label>Alamat</label>
          <textarea class="form-control" id="alamat" value="{{ old('alamat') }}"></textarea>
      </div>
      
      <div class="form-group">
          <label>NIK</label>
          <input type="text" class="form-control" id="nik" value="{{ old('nik') }}">
      </div>

      <div class="form-group">
          <label>NIP</label>
          <input type="text" class="form-control" id="nip" value="{{ old('nip') }}">
      </div>
      
      <div class="form-group">
          <button class="btn btn-primary" id="simpan">Simpan</button>
      </div>
  </div>
</div>

@stop

@section('css')
  <style>
    .rectangle {
      height: 300px;
      width: 300px;
      background-color: #000;
      text-align: center;
      padding-top: 20px;
      margin-bottom: 10px;
    }

  </style>
  <link  href="{{ asset('vendor/jscropper/dist/cropper.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="/css/cropper_custom.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
@stop

@pushOnce('js')
  <script src="{{ asset('vendor/jquery/jquery.js')}}"></script>
  <script src="{{ asset('vendor/jscropper/dist/cropper.js')}}"></script>
  <script src="{{ asset('vendor/jscropper/dist/jquery-cropper.js')}}"></script>
  <script src="{{ asset('js/upload/cropper_custom.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
    $('.datepicker').datepicker();
  </script>
@endPushOnce