<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $data['students'] = User::where('role_id',3)->paginate(10);
        $data['classes'] = Classs::get();
        return view('student.index',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'class_id' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return redirect('student')->withErrors($validator)->withInput();

        $user = new User();
        $user->role_id = 3;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->class_id = $request->class_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('student')->with('success','Berhasil Tambah data');
    }

    public function edit($id)
    {
        $data = User::find($id);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->class_id = $request->class_id;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('student')->with('success','Berhasil Edit data');
    }

    public function destroy($id)
    {
        $data = User::find($id);

        if ($data->delete()) {
            return redirect('student')->with('success','Berhasil Hapus data');
        } else {
            return redirect('student')->with('success','Gagal Hapus data');
        }
    }
}
