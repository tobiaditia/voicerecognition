<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TheoryController extends Controller
{
    public function index()
    {
        $data['theorys'] = Theory::paginate(10);
        return view('theory.index',$data);
    }

    public function add()
    {
        $data['classes'] = Classs::get();
        return view('theory.add',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'class_id' => 'required',
        ]);

        if ($validator->fails()) return redirect('theory')->withErrors($validator)->withInput();

        $data = new Theory();
        $data->name = $request->name;
        $data->content = $request->content;
        $data->class_id = $request->class_id;
        $data->users_id = Auth::user()->id;
        $data->save();

        return redirect('theory')->with('success','Berhasil Tambah data');
    }

    public function edit($id)
    {
        $data['theory'] = Theory::find($id);
        $data['classes'] = Classs::get();

        return view('theory.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'class_id' => 'required',
        ]);

        if ($validator->fails()) return redirect('theory')->withErrors($validator)->withInput();

        $data = Theory::find($id);
        $data->name = $request->name;
        $data->content = $request->content;
        $data->class_id = $request->class_id;
        $data->save();

        return redirect('theory')->with('success','Berhasil Edit data');
    }

    public function destroy($id)
    {
        $data = Theory::find($id);

        if ($data->delete()) {
            return redirect('theory')->with('success','Berhasil Hapus data');
        } else {
            return redirect('theory')->with('success','Gagal Hapus data');
        }
    }
}
