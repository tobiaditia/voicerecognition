<?php

namespace App\Http\Controllers;

use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TheoryController extends Controller
{
    public function index()
    {
        $data['theorys'] = Theory::paginate(10);
        return view('theory.index',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return redirect('theory')->withErrors($validator)->withInput();

        $user = new Theory();
        $user->role_id = 2;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('theory')->with('success','Berhasil Tambah data');
    }

    public function edit($id)
    {
        $data = Theory::find($id);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $user = Theory::find($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

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
