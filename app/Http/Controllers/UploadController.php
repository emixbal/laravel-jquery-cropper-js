<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;

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
        $file_name = "";
        $folder_name = $request->input('folder_name');
        $nama   = $request->input('nama');
        $alamat = $request->input('alamat');
        $pob = $request->input('pob');
        $dob = $request->input('dob');
        $nik = $request->input('nik');
        $nip = $request->input('nip')??"";

        $dob = explode("/", $dob);
        $dob = $dob[2]."-".$dob[0]."-".$dob[1];

        $image_base64 = $request->input('image_base64');
        if($image_base64!=""){
            $file_name = $request->input('file_name');
            $base_to_php = explode(',', $image_base64);
            $data = base64_decode($base_to_php[1]);
    
            $path_sudah = session('path')."/sudah";
            $path_ok = session('path')."/ok";
    
            if(is_dir($path_sudah)==FALSE){
                mkdir($path_sudah);
            }
    
            if(is_dir($path_ok)==FALSE){
                mkdir($path_ok);
            }
    
            // here you can detect if type is png or jpg if you want
            $filepath = $path_ok."/".$file_name; // or image.jpg
    
            // Save the image in a defined path
            if(!file_put_contents($filepath, $data)){
                echo "error";
                return;
            }
    
            copy(session('path')."/".$file_name, $path_sudah."/".$file_name);
            unlink(session('path')."/".$file_name);
        }

        $payload = [$nama, $pob, $dob, $alamat, $nik, $nip, session('path'), $folder_name, $file_name];
        try {
            $results = DB::insert(
                "insert into anggota (nama, pob, dob, alamat, nik, nip, path, folder_name, file_name) values (?,?,?,?,?,?,?,?,?)", $payload
            );
        } catch(Exception $e) {
            print_r($e);
        }
    }
}
