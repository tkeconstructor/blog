<?php

namespace App\Http\Controllers\Lecturer;

use DB;
use Carbon\Carbon;
use App\Quiz;
use App\Question;
use App\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Helpers\QuestionTypeHelper;
use App\Helpers\AnswerMultichoiceHelper;
use App\Helpers\AnswerSinglechoiceHelper;




class QuizController extends Controller
{

    public function index()
    {
        $user_id = \Auth::user()->id;
        $quizs = Quiz::where('user_id',$user_id)->orderBy('id', 'DESC')->get();
        return view('lecturer.pages.quiz_list',['quizs'=>$quizs]);
    }

    public function view($id){
        $question = Question::find($id);

        return view('lecturer.pages.question_view',['question'=>$question]);

        
    }



    public function create()
    {
    	
        return view('lecturer.pages.quiz_create');
    }



    public function store(Request $request)
    {
        $data = $request->all();
        $timeopen = '';
        $timeclose = '';
        $enroll = false;
        $shuffle = false;
        $auto_activate = false;

        if(array_key_exists('autoopen', $data))
            $auto_activate = true;
        if(array_key_exists('enroll', $data))
            $enroll = true;
        if(array_key_exists('shuffle', $data))
            $shuffle = true;

            $timeopen = Carbon::createFromFormat('m/d/Y g:i A', trim($data['timeopen']),new \DateTimeZone($data['timezone']));
            $timeopen->setTimeZone(new \DateTimeZone('UTC'));
            $timeopen = $timeopen->timestamp;

            $timeclose = Carbon::createFromFormat('m/d/Y g:i A', trim($data['timeclose']),new \DateTimeZone($data['timezone']));
            $timeclose->setTimeZone(new \DateTimeZone('UTC'));
            $timeclose = $timeclose->timestamp;
       
        if(Quiz::create([
            'user_id' => \Auth::user()->id,
            'last_modified' => \Auth::user()->id,
            'name' => $data['name'],
            'intro' => $data['intro'],
            'auto_activate' => $auto_activate,
            'timeopen' => $timeopen,
            'timeclose' => $timeclose,
            'timelimit' => $data['timelimit'],
            'questions' => '',
            'activate' => false,
            'score' => $data['score'],
            'code' => $data['code'],
            'shuffle'=> $shuffle,
            'enroll' =>$enroll,
        ])) return redirect('/lecturer/quiz');


    	return response([
            'error' => [
                'code' => 'SQL ERROR',
                'description' => 'There are some errors in creating database.'
            ]
        ], 401);
    }

    public function active(Request $request,$id)
    {
        $quiz = Quiz::find($id);
        $activate =  $quiz->activate;
        $result = array();

        $result['error'] = true;

        if($activate == true){
            $quiz->activate = false;
            $result['error'] = false;
            $result['activated'] = false;
        }else{
            $quiz->activate = true;
            $result['error'] = false;
            $result['activated'] = true;
        }

        $quiz->save();

        return response()->json($result);
    }

    public function question($id){
        $quiz = Quiz::find($id);

        $questions = array();
        $questionids = $quiz->questions;
        $questionids = explode(',',$questionids);
        foreach ($questionids as $key => $questionid) {
            if(Question::find($questionid)!=null)
                $questions[] = Question::find($questionid);
        }

        $questions = collect($questions);
        return view('lecturer.pages.quiz_question',['questions'=>$questions,'quiz'=>$quiz]);
    }



    public function add_question($id){
        $quiz = Quiz::find($id);

        $added_questions = array();
        $added_questions = explode(',',$quiz->questions);

        $questions = Question::paginate(15);
        return view('lecturer.pages.quiz_question_add',['questions'=>$questions,'quiz'=>$quiz,'added_questions'=>$added_questions]);
    }



    public function add_question_store($id,$qsid){
        $quiz = Quiz::find($id);

        $result = array();
        $result['error'] = true;

        $questions = array();
        $added_questions = array();
        
        $added_questions = explode(',',$quiz->questions);
        $questions = $added_questions;

        if( in_array($qsid,$added_questions)){
            $questions = array_diff($added_questions,array($qsid));
            $result['error'] = false;
            $result['added'] = false;
        }else{
            $questions[] = $qsid;
            $result['error'] = false;
            $result['added'] = true;
        }

        $questions = implode(',',$questions);
        $quiz->questions = $questions;
        $quiz->save();
        return response()->json($result);
    }



    public function create_question($id){
        $quiz = Quiz::find($id);
        $categories = DB::table('question_category')->select('name')->get();
        $types = DB::table('question_type')->select('name')->get();

        return view('lecturer.pages.quiz_question_create',['quiz'=>$quiz,'categories' => $categories,'types'=> $types]);
    }




    public function store_question(Request $request,$id){
        $quiz = Quiz::find($id);

        $questionAnswer = $request->all();

        $question = array();

        $question['name'] = $questionAnswer['name'];
        $question['questiontext'] = $questionAnswer['question'];
        $question['type_id'] = DB::table('question_type')->where('name',$questionAnswer['type'])->value('id');
        $question['category_id'] = DB::table('question_category')->where('name',$questionAnswer['category'])->value('id');
        $question['user_id'] = \Auth::user()->id;
        $question['last_modified'] = \Auth::user()->id;

        $qt = Question::create($question);
        $answer = array();

        $answer['question_id'] = $qt->id;
        $answer['type'] = $questionAnswer['type'];
        $answer['subAnswer'] = $questionAnswer;

        if($this->storeAnswer($answer)){
            $questions = array();
            $questions = explode(',',$quiz->questions);
            $questions[] = $qt->id;

            $questions = implode(',',$questions);
            $quiz->questions = $questions;
            $quiz->save();

            return redirect('/lecturer/quiz/'.$id.'/question/add');
        }
        else {
            $qt->delete();
            return response([
            'error' => [
                'code' => 'SQL ERROR',
                'description' => 'There are some errors in creating database.'
            ]
            ], 401);
        }   
    }

    // store answer
    public function storeAnswer($answer)
    {
        $type = $answer['type'];

        if(strtolower($type) == strtolower('multichoice'))
        {
            $multi = new AnswerMultichoiceHelper();
            if($multi->storeAnswer($answer))
                return true;
            return false;
        }

        if(strtolower($type) == strtolower('singlechoice'))
        {
            $single = new AnswerSinglechoiceHelper();
            if($single->storeAnswer($answer))
                return true;
            return false;
        }
        return false;
    }

}
