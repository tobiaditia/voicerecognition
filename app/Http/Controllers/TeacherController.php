<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role_id != 1) {
                return redirect('/');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $data['teachers'] = User::where('role_id',2)->paginate(10);
        return view('teacher.index',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return redirect('teacher')->withErrors($validator)->withInput();

        $user = new User();
        $user->role_id = 2;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('teacher')->with('success','Berhasil Tambah data');
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
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('teacher')->with('success','Berhasil Edit data');
    }

    public function destroy($id)
    {
        $data = User::find($id);

        if ($data->delete()) {
            return redirect('teacher')->with('success','Berhasil Hapus data');
        } else {
            return redirect('teacher')->with('success','Gagal Hapus data');
        }
    }
}
