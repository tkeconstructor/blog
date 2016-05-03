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
   #menu-toggle{
      margin-top: 20px;
      margin-bottom: 10px;
      float: right;
   }
   </style>
   
@stop
@section('content')





<div class="container-fluid">
                 <div class="row head-link">
                     <ol class="breadcrumb">
                         <li><a href="#"><i class="fa fa-home"></i></a></li>
                         <li>Danh sách bài đánh giá</li>
                     </ol>
                  <div class="row">
                     <div class="col-lg-6">
                         <h3>Danh sách bài đánh giá</h3>
                     </div>
                     <div class="col-lg-6">
                         <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                     </div>
                  </div>
                 </div><!--/.row-->
                  <div class="row">
                    <div>
                        <table id="quizlist" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th width="20%">Name</th>
                                    <th width="10%">Timeopen</th>
                                    <th width="10%">Timeclose</th>
                                    <th width="3%">Timelimit</th>
                                    <th width="5%">Code</th>
                                    <th width="4%">Score</th>
                                    <th width="4%">Enroll</th>
                                    <th width="4%">Shuffle</th>
                                    <th width="10%">Creator</th>
                                    <th width="10%">Last modified</th>
                                    <th width="5%">Auto activate</th>
                                    <th width="5%">Active</th>
                                    <th width="5%"></th>
                                    <th width="5%"></th>
                                    <th width="5%"></th>
                                 </tr>
                              </thead>
                           
                           <tbody>

                             @foreach ($quizs as $quiz)
                              <tr>
                                 <td>{{str_limit($quiz->name,20)}}</td>

                                 @if ($quiz->timeopen != 0)
                                    <td>{{date("d-m-Y h:i:s A",$quiz->timeopen)}}</td>
                                    <td>{{date("d-m-Y h:i:s A",$quiz->timeclose)}}</td>
                                 @else
                                     <td>Null</td>
                                    <td>Null</td>
                                 @endif

                                 
                                 <td><p>{{$quiz->timelimit}} mn</p></td>
                                 <td>{{$quiz->code}}</td>
                                 <td>{{$quiz->score}}</td>
                                 @if ($quiz->enroll == true)
                                    <td>true</td>
                                 @else
                                     <td>false</td>
                                 @endif

                                 @if ($quiz->shuffle == true)
                                    <td>true</td>
                                 @else
                                    <td>false</td>
                                 @endif

                                 <td>{{$quiz->user->username}}</td>
                                 <td>{{$quiz->lastmodified->username}}</td>

                                 @if ($quiz->auto_activate == true)
                                    <td><button type="button" class="btn btn-success quiz-activate" url="{{asset('lecturer/quiz/'.$quiz->id.'/activate')}}">true</button></td>
                                 @else
                                     <td><button type="button" class="btn btn-warning quiz-activate" url="{{asset('lecturer/quiz/'.$quiz->id.'/activate')}}">false</button></td>
                                 @endif

                                 @if ($quiz->activate == true)
                                    <td><button type="button" class="btn btn-success quiz-activate" url="{{asset('lecturer/quiz/'.$quiz->id.'/activate')}}">activated</button></td>
                                 @else
                                     <td><button type="button" class="btn btn-warning quiz-activate" url="{{asset('lecturer/quiz/'.$quiz->id.'/activate')}}">activate</button></td>
                                 @endif
                                 


                                 <td><a href="#" class="todo-action">student</a></td>
                                 <td><a href="{{asset('lecturer/quiz/'.$quiz->id.'/question')}}" class="todo-action">question</a></td>
                                 <td>
                                    <div>
                                       <a target="_blank" href="{{ asset('lecturer/quiz/'.$quiz->id) }}" class="todo-action"><i class="fa fa-search"></i></a>
                                       <a href="#" class="todo-action"><i class="fa fa-edit"></i></a>
                                       <a href="#" class="todo-action"><i class="fa fa-trash-o"></i></a>
                                       <a href="#" class="todo-action"><i class="fa fa-download"></i></a>
                                    </div>
                                 </td>
                              </tr>
                             @endforeach
                              
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
@stop



@section('script')
   <script type="text/javascript">
      $(document).ready(function() {
         $('#quizlist').DataTable();

         $("#menu-toggle").click(function(e) {
           e.preventDefault();
           $("#wrapper").toggleClass("toggled");
       });
      } );
   </script>
   <script type="text/javascript" src="{{ asset('js/quiz-list.js') }}"></script>

@stop