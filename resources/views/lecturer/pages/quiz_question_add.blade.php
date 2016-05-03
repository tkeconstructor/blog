@extends('lecturer.layouts.default')
@section('content')
<div class="container-fluid">
   <div class="row head-link">
                     <ol class="breadcrumb">
                         <li><a href="#"><i class="fa fa-home"></i></a></li>
                         <li><a href="#">{{str_limit($quiz->name,30)}}</a></li>
                         <li><a href="{{ asset('lecturer/quiz/'.$quiz->id.'/question') }}">Danh sách câu hỏi</a></li>
                         <li>Add Question</li>
                     </ol>
   </div><!--/.row-->

   <div class="row">
      <div>
            <table class="table table-bordered">
            <thead>
               <tr>
                  <th width="15%">Name</th>
                  <th width="20%">Question</th>
                  <th width="10%">Type</th>
                  <th width="15%">Category</th>
                  <th width="10%">Creator</th>
                  <th width="10%">Last modified</th>
                  <th width="10%"></th>
                  <th width="10%"></th>
               </tr>
            </thead>
            <tbody>

              @foreach ($questions as $question)
               <tr>
                  <td>{{str_limit($question->name,30)}}</td>
                  <td>{{str_limit($question->questiontext,50)}}</td>
                  <td>{{$question->type->name}}</td>
                  <td>{{$question->category->name}}</td>
                  <td>{{$question->user->username}}</td>
                  <td>{{$question->lastmodified->username}}</td>
                  @if(in_array($question->id,$added_questions))
                     <td><button type="button" class="btn btn-success quiz-add-question" url="{{asset('lecturer/quiz/'.$quiz->id.'/question/add/'.$question->id)}}">added</button></td>
                   @else
                     <td><button type="button" class="btn btn-warning quiz-add-question" url="{{asset('lecturer/quiz/'.$quiz->id.'/question/add/'.$question->id)}}">add</button></td>
                  @endif
                  <td>
                     <div>
                        <a target="_blank" href="{{ asset('lecturer/question/'.$question->id.'/view') }}" class="todo-action"><i class="fa fa-search"></i></a>
                        <a href="#" class="todo-action"><i class="fa fa-edit"></i></a>
                        <a href="#" class="todo-action"><i class="fa fa-trash-o"></i></a>
                     </div>
                  </td>
               </tr>
              @endforeach
               
            </tbody>
         </table>
         <div>
            <a type="button" class="btn btn-success" href="{{asset('lecturer/quiz/'.$quiz->id.'/question/create')}}">Add new question</a>
         </div>
   </div>
      </div>
</div>
{!! $questions->render() !!}
@stop

@section('script')
   
   <script type="text/javascript" src="{{ asset('js/quiz-question-add.js') }}"></script>

@stop