<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;
use \URL;

class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function index()
    {
        if(session('path')){
            $files = scandir(session('path'));

            $pass = [
                'files'=>$files,
            ];

            return view('upload/files_list', $pass);
        }

        return view('upload/index');
    }

    public function scan(Request $request)
    {
        $folder_name = $request->input('folder_name');
        $path = $request->input('path');

        if(is_dir($path)==FALSE){
            return redirect()->back();
        }

        session(['folder_name' => $folder_name]);
        session(['path' => $path]);

        $files = scandir(session('path'));

        $pass = [
            'files'=>$files,
        ];

        return view('upload/files_list', $pass);
    }

    public function remove_path(Request $request)
    {
        $request->session()->forget(['folder_name', 'path']);
        return redirect()->action([UploadController::class, 'index']);
    }

    public function detail_cropper(Request $request)
    {
        $pass = [
            "file_name"=>$request->file_name
        ];
        return view('upload/detail_cropper', $pass);
    }

    public function show_image(Request $request)
    {     
        $fullpath = $request->query('p');
        return response()->file($fullpath);
    }

    public function anggota_save(Request $request)
    {
        $folder_name = $request->input('folder_name');
        $nama   = $request->input('nama');
        $alamat = $request->input('alamat');
        $pob = $request->input('pob');
        $dob = $request->input('dob');
        $nik = $request->input('nik');
        $nip = $request->input('nip')??"";

        $dob = explode("/", $dob);
        $dob = $dob[2]."-".$dob[0]."-".$dob[1];

        $image_base64 = $request->input('image_base64')??"";
        $file_name = $request->input('file_name');

        $path_sudah = session('path')."/sudah";
        $path_ok = preg_replace('/\s+/', '-', $folder_name);
        $path_ok_full = base_path()."/foto_anggota"."/".$path_ok;
        $is_photo_avail = 0;

        if(is_dir($path_sudah)==FALSE){
            mkdir($path_sudah);
        }

        if(is_dir($path_ok_full)==FALSE){
            mkdir($path_ok_full);
        }

        $path_photo = "";
        if($image_base64!=""){
            $base_to_php = explode(',', $image_base64);
            $data = base64_decode($base_to_php[1]);

            // here you can detect if type is png or jpg if you want
            $filepath = $path_ok_full."/".$file_name; // or image.jpg

            // Save the image in a defined path
            if(!file_put_contents($filepath, $data)){
                echo "error";
                return;
            }
            $is_photo_avail = 1;
            $path_photo = $path_ok;
        }

        copy(session('path')."/".$file_name, $path_sudah."/".$file_name);
        unlink(session('path')."/".$file_name);

        $payload = [$nama, $pob, $dob, $alamat, $nik, $nip, session('path'), $path_photo, $folder_name, $file_name, $is_photo_avail];
        try {
            $results = DB::insert(
                "insert into anggota (nama, pob, dob, alamat, nik, nip, path, path_photo, folder_name, file_name, is_photo_avail) values (?,?,?,?,?,?,?,?,?,?,?)", $payload
            );
        } catch(Exception $e) {
            print_r($e);
        }
    }

    public function uploaded_list(Request $request){
        $filter_is_foto_avail = $request->query('is_foto_avail');
        $filter_nama = ($request->query('nama'))?$request->query('nama'):'';
        $filter_folder_name = ($request->query('folder_name'))?$request->query('folder_name'):'';

        $per_page = ($request->query('per_page'))?$request->query('per_page'):50; //default 50
        $page = ($request->query('page'))?$request->query('page'):1;

        $skip = ($page-1)*$per_page;

        $current_url = URL::current()."?";

        $total_data = DB::table('anggota')->count();
        $total_pages = ceil($total_data / $per_page);

        $query = DB::table('anggota')
        ->skip($skip)->take($per_page);
        
        if($filter_is_foto_avail!=""){
            $query->where('is_photo_avail', $filter_is_foto_avail);
        }

        if($filter_nama!=""){
            $query->where('nama', 'like', $filter_nama);
        }
        
        if($filter_folder_name!=""){
            $query->where('folder_name', 'like', $filter_folder_name);
        }

        $anggota = $query->get();

        $current_url .= "&is_foto_avail=".$filter_is_foto_avail;
        $current_url .= "&nama=".$filter_nama;
        $current_url .= "&folder_name=".$filter_folder_name;

        $pass = [
            "anggotas" => $anggota,
            "url" => $current_url,
            "page" => $page,
            "total_pages" => $total_pages,
        ];
        return view('upload/uploaded_list', $pass);
    }

    public function uploaded_list_filter(Request $request)
    {
        $filter_is_foto_avail = $_POST['is_foto_avail'];
        $filter_nama = ($request->input('nama'))?$request->input('nama'):'';
        $filter_folder_name = ($request->input('folder_name'))?$request->input('folder_name'):'';

        return redirect("/uploaded_list?is_foto_avail=".$filter_is_foto_avail."&nama=".$filter_nama."&folder_name=".$filter_folder_name);
    }

    public function uploaded_detail(Request $request)
    {
        $id = $request->id;

        $anggota = DB::table('anggota')
        ->where('id', $id)
        ->first();

        $pass = [
            "id"=>$id,
            "anggota"=>$anggota,
        ];

        return view('upload/uploaded_detail', $pass);

    }
}
