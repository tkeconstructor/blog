<?php

namespace App\Http\Controllers\Lecturer;

use DB;
use App\Question;
use App\QuestionAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Config;
use App\Helpers\AnswerMultichoiceHelper;
use App\Helpers\AnswerSinglechoiceHelper;

use App\QuestionCategory;
use App\QuestionType;


class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::paginate(15);
        return view('lecturer.pages.question_list',['questions'=>$questions]);
    }


    public function view($id){
        $question = Question::find($id);

        return view('lecturer.pages.question_view',['question'=>$question]);
    }



    public function create()
    {
    	$categories = QuestionCategory::all();
    	$types = QuestionType::all();

        return view('lecturer.pages.question_create',['categories' => $categories,'types'=> $types]);
    }



    public function store(Request $request)
    {

        $question_info = $request->all();

        $shuffle = false;   
        if(array_key_exists('shuffle', $question_info) && $question_info['shuffle'] == "on")
            $shuffle = true;

    	$question = array();

        $qt = Question::create([
                'name' => $question_info['name'],
                'questiontext' => $question_info['question'],
                'shuffle' => $shuffle,
                'type_id' => QuestionType::where('name',$question_info['type'])->first()->id,
                'category_id' => QuestionCategory::where('name',$question_info['category'])->first()->id,
                
            ]);

    	$answer = array();

        $answer['question_id'] = $qt->id;
        $answer['type'] = $question_info['type'];
        $answer['subAnswer'] = $question_info;

        if($this->storeAnswer($answer)){
            return redirect('/lecturer/question');
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
