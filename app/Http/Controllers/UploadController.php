<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
