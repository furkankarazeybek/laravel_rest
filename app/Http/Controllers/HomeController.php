<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['upload_form','download']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function upload_form() {

        return view('upload_form');

    }

    public function download($fileName) {


        if(!Storage::disk('public')->exists("uploads\\$fileName")){
            return response()->json(['message' => 'File not found!'],404);
        }
        //storage publicten indirme
        return Storage::disk('public')->download("uploads\\$fileName");


        //Direkt public dosyasından indirme
        //return response()->download(public_path("uploads\\$fileName"));

    }
}
