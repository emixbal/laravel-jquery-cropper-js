@extends('adminlte::page')

@section('title', 'Upload')

@section('content_header')
    <h3>Uploaded List</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Filter
    </button>
@stop

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
        <th>Nama</th>
        <th>Folder Name</th>
        <th>TTL</th>
        <th>Alamat</th>
        <th>NIK</th>
        <th>NIP</th>
        <th>Is foto avail?</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anggotas as $anggota)
        <tr>
            <td><a href="{{ url('/uploaded_detail') }}/{{$anggota->id}}">{{$anggota->nama}}</a></td>
            <td>{{$anggota->folder_name}}</td>
            <td>{{$anggota->pob}}, {{$anggota->dob}}</td>
            <td>{{$anggota->alamat}}</td>
            <td>{{$anggota->nik}}</td>
            <td>{{$anggota->nip}}</td>
            <td>{{($anggota->is_photo_avail)?"ada":"tidak ada"}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<ul class="pagination">
  <li class="page-item"><a class="page-link" href="{{$url}}&page={{$page-1}}">Previous</a></li>
  <li class="page-item"><a class="page-link" href="{{$url}}&page={{$page+1}}">Next</a></li>
</ul> 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/uploaded_list_filter">
        @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" placeholder="Enter nama">
            </div>
            
            <div class="form-group">
                <label for="folder_name">Folder Name</label>
                <input type="text" class="form-control" id="folder_name" aria-describedby="folder_name" name="folder_name" placeholder="Enter nama">
            </div>

            <label for="is_foto_avail">Sudah Ada Fotonya?</label>
            
            <div class="form-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_foto_avail" id="is_foto_avail" value="" checked>
                <label class="form-check-label" for="is_foto_avail">
                  Semua
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_foto_avail" id="is_foto_avail0" value=0>
                <label class="form-check-label" for="is_foto_avail0">
                  Belum Ada
                </label>
              </div>
              
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_foto_avail" id="is_foto_avail1" value=1>
                <label class="form-check-label" for="is_foto_avail1">
                  Ada
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css" />
@stop

@pushOnce('js')
    <script src="{{ asset('js/upload/index.js')}}"></script>
@endPushOnce
