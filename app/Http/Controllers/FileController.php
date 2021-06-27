<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
 public function readFile(){
    $data = Storage::disk('local')->get('results.json'); 
    echo $data;
 }

}