@extends('adminlte::page')

@section('title', 'Upload')

@section('content_header')
    <h3>Detail Anggota</h3>
@stop

@section('content')

<table>
    <tr><th>Unit Kerja</th><td>{{$anggota->folder_name}}</td></tr>
    <tr><th>Nama</th><td>{{$anggota->nama}}</td></tr>
    <tr><th>TTL</th><td>{{$anggota->pob}}, {{$anggota->dob}}</td></tr>
    <tr><th>Alamat</th><td>{{$anggota->alamat}}</td></tr>
    <tr><th>NIK</th><td>{{$anggota->nik}}</td></tr>
    <tr><th>NIP</th><td>{{$anggota->nip}}</td></tr>
    <tr>
        <th class="top">foto</th>
        <td>
            <img id="image" src="{{ route('show_image') }}?p={{ base_path().'/foto_anggota/'.$anggota->path_photo.'/'.$anggota->file_name }}">
        </td>
    </tr>
</table> 

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css" />
    <style>
        th {
            width: 100px;
        }
        .top {
            vertical-align: top;
        }
    </style>
@stop

@pushOnce('js')
    <script src="{{ asset('js/upload/index.js')}}"></script>
@endPushOnce
