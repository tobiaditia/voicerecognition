<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TheoryController extends Controller
{
    public function index()
    {
        $class_id = Auth::user()->class_id;
        $data = Theory::where('class_id',$class_id)->get();
        return $data;
    }
}
