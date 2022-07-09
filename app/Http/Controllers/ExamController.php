<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Exam;
use App\Models\ExamMultipleChoiceItem;
use App\Models\ExamQuestion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::get();
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
            $exam->users_id = $request->users_id;
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
                        // $examMultipleChoiceItem = new ExamMultipleChoiceItem();
                        // $examMultipleChoiceItem->exam_question_id = $examQuestion->id;
                        // $examMultipleChoiceItem->content = $item['content'];
                        // $examMultipleChoiceItem->correct_answer = $item['correct'];
                        // $examMultipleChoiceItem->save();
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

    public function destroy($id)
    {
        $data = Exam::find($id);

        if ($data->delete()) {
            return redirect('exam')->with('success','Berhasil Hapus data');
        } else {
            return redirect('exam')->with('success','Gagal Hapus data');
        }

    }
}
