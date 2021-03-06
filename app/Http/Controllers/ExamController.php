<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Exam;
use App\Models\ExamMultipleChoiceItem;
use App\Models\ExamQuestion;
use App\Models\ExamUser;
use App\Models\ExamUserDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $data['exams'] = Exam::get();
        }else{
            $data['exams'] = Exam::where('users_id',Auth::user()->id)->get();
        }
        return view('exam.index',$data);
    }

    public function add()
    {
        $data['classes'] = Classs::get();
        return view('exam.add',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) return redirect('exam/add')->withErrors($validator)->withInput();
        DB::beginTransaction();
        try {
            $exam = new Exam();
            $exam->class_id = $request->class_id;
            $exam->users_id = Auth::user()->id;
            $exam->name = $request->name;
            $exam->name = $request->name;
            $exam->type = $request->type;
            $exam->active = 1;
            $exam->save();

            foreach ($request->question as $q) {
                $examQuestion = new ExamQuestion();
                $examQuestion->exam_id = $exam->id;
                $examQuestion->question = $q['question'];
                $examQuestion->save();

                if ($request->type == 'multiple_choice') {
                    foreach ($q['items'] as $item) {
                        $examMultipleChoiceItem = new ExamMultipleChoiceItem();
                        $examMultipleChoiceItem->exam_question_id = $examQuestion->id;
                        $examMultipleChoiceItem->content = $item['content'];
                        $examMultipleChoiceItem->correct_answer = $item['correct'];
                        $examMultipleChoiceItem->save();
                    }
                }
            }

            DB::commit();
            return true;
        }catch (Exception $e) {
            DB::rollback();
            return false;
        }
        return false;
    }

    public function edit($id)
    {
        $data['exams'] = Exam::with('question.multiple_choice')->find($id);
        $data['classes'] = Classs::get();
        // dd($data);
        return view('exam.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // dd($request);
        if ($validator->fails()) return redirect('exam')->withErrors($validator)->withInput();
        DB::beginTransaction();
        try {
            $exam = Exam::find($id);
            $exam->class_id = $request->class_id;
            $exam->users_id = $request->users_id;
            $exam->name = $request->name;
            $exam->name = $request->name;
            $exam->type = $request->type;
            $exam->active = 1;
            $exam->save();

            ExamQuestion::where('exam_id', $id)->delete();

            foreach ($request->question as $q) {
                $examQuestion = new ExamQuestion();
                $examQuestion->exam_id = $exam->id;
                $examQuestion->question = $q['question'];
                $examQuestion->save();

                if ($request->type == 'multiple_choice') {
                    foreach ($q['items'] as $item) {
                        $examMultipleChoiceItem = new ExamMultipleChoiceItem();
                        $examMultipleChoiceItem->exam_question_id = $examQuestion->id;
                        $examMultipleChoiceItem->content = $item['content'];
                        $examMultipleChoiceItem->correct_answer = $item['correct'];
                        $examMultipleChoiceItem->save();
                    }
                }else{

                }
            }

            DB::commit();
            return true;
        }catch (Exception $e) {
            DB::rollback();
            return false;
        }
        return false;
    }

    public function destroy($id)
    {
        $data = Exam::find($id);

        if ($data->delete()) {
            return redirect('exam')->with('success','Berhasil Hapus data');
        } else {
            return redirect('exam')->with('success','Gagal Hapus data');
        }

    }

    public function hasil($id)
    {
        $data['exams'] = Exam::find($id);
        $data['exam_users'] = ExamUser::with('user')->where('exam_id',$id)->get();
        return view('exam.hasil',$data);
    }

    public function hasilUser($id, $exam_user_id)
    {
        $data['exams'] = Exam::find($id);
        $data['exam_users'] = ExamUser::with('user')->find($exam_user_id);
        $data['exam_user_details'] = ExamUserDetail::with('question')->where('exam_user_id',$exam_user_id)->get();
        return view('exam.hasiluser',$data);
    }

    public function examuserdetail(Request $request)
    {
        $exam_user_id = $request->exam_user_id;
    }
}
