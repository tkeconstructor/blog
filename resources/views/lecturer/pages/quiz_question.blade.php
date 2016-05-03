@extends('lecturer.layouts.default')

@section('stylesheet')
   <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

   <style type="text/css">
   .dataTables_filter{
         float: right;
   }
   .dataTables_paginate{
      float: right;
   }
   </style>
   
@stop

@section('content')
<div class="container-fluid">

   <div class="row head-link">
                     <ol class="breadcrumb">
                         <li><a href="#"><i class="fa fa-home"></i></a></li>
                         <li><a href="#">{{str_limit($quiz->name,30)}}</a></li>
                         <li>Danh sách câu hỏi</li>
                     </ol>
   </div><!--/.row-->
   <div class="row">
      <div>
               <table id="quizlist" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th width="15%">Name</th>
                        <th width="20%">Question</th>
                        <th width="10%">Type</th>
                        <th width="20%">Category</th>
                        <th width="10%">Creator</th>
                        <th width="10%">Last modified</th>
                        <th width="10%"></th>
                        <th width="5%"></th>
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
                        <td>
                           <div>
                              <a target="_blank" href="{{ asset('lecturer/question/'.$question->id.'/view') }}" class="todo-action"><i class="fa fa-search"></i></a>
                              <a href="#" class="todo-action"><i class="fa fa-edit"></i></a>
                              <a href="#" class="todo-action"><i class="fa fa-trash-o"></i></a>
                           </div>
                        </td>
                        <td><a href="#" class="todo-action"><i class="fa fa-arrow-up"></i></a>
                              <a href="#" class="todo-action"><i class="fa fa-arrow-down"></i></a>
                        </td>
                     </tr>
                    @endforeach
                     
                  </tbody>
               </table>
               <div>
                  <a type="button" class="btn btn-success" href="{{asset('lecturer/quiz/'.$quiz->id.'/question/add')}}">Add question</a>
                  <a type="button" class="btn btn-success" href="{{asset('lecturer/quiz/'.$quiz->id.'/question/view')}}">View</a>
               </div>
      </div>
      </div>
</div>
@stop

@section('script')
   <script type="text/javascript">
      $(document).ready(function() {
      $('#quizlist').DataTable();
      } );
   </script>
@stop
