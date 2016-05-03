@extends('lecturer.layouts.default')

@section('content')
        <div class="container-fluid">
                 <div class="row head-link">
                     <ol class="breadcrumb">
                         <li><a href="#"><i class="fa fa-home"></i></a></li>
                         <li>Question</li>
                     </ol>
                 </div><!--/.row-->
                  <div class="row">
                    <div>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th width="15%">Name</th>
                                 <th width="25%">Question</th>
                                 <th width="10%">Type</th>
                                 <th width="20%">Category</th>
                                 <th width="10%">Creator</th>
                                 <th width="10%">Last modified</th>
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
                        {!! $questions->render() !!}
                    </div>
                </div>
            </div>
@stop