<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        // $class_id = Auth::user()->class_id;
        // $data = Exam::where('class_id',$class_id)->get();
        $data = Exam::where(['active'=>1])->get();
        return $data;
    }

    public function show($id)
    {
        // $class_id = Auth::user()->class_id;
        // $data = Exam::where('class_id',$class_id)->get();
        $data = Exam::find($id);
        return $data;
    }
}
