@extends('lecturer.layouts.default')

@section('stylesheet')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>

@stop

@section('content')
        <div class="container-fluid">
                 <div class="row head-link">
                     <ol class="breadcrumb">
                         <li><a href="#"><i class="fa fa-home"></i></a></li>
                         <li>Tạo câu hỏi</li>
                     </ol>
                 </div><!--/.row-->
                  <div class="row">
                    <div>
                  <form method="POST" action="{{ url('lecturer/question/create') }}">
                        {!! csrf_field() !!}
                        <p>Danh mục câu hỏi*</p>
                        <select name="category" class="form-control">
                           @foreach ($categories as $category)
                           <option value="{{$category->name}}">{{$category->name}}</option>
                           @endforeach
                        </select>
                        <br>
                        <p>Tên*</p>
                        <input name="name" type="text" class="form-control" placeholder="Name">
                        <br>
                        <p>Câu hỏi*</p>
                        <textarea name="question" class="form-control" rows="7" id="txtareaQuestion"></textarea>
                        <br>
                        <p>Type*</p>
                        <select  class="form-control" id="drpTemplate" name="type" onchange="ChangeTemplate()">
                           @foreach ($types as $type)
                           <option value="{{$type->name}}">{{$type->name}}</option>
                           @endforeach
                        </select>
                        <br>

                        <input type="checkbox" name="shuffle">Trộn câu trả lời
                        <br>

                        <hr class="divider" style="border-color: black;">
                        <p>Câu trả lời*</p>
                           <table class="table table-borderless">
                              <tbody>
                              @include('lecturer.pages.question_type_multichoice')   
                              @include('lecturer.pages.question_type_singlechoice')
                              @include('lecturer.pages.question_type_shortanswer')      
                              </tbody>
                           </table>
                        <br>
                        <button type="submit">Submit</button>
                     </form>
                     </div>
                     </div>
</div>
@stop

@section('script')
   <script src="{{ asset('js/questiontype.js') }}"></script>

   <script>
     $(document).ready(function() {
        CKEDITOR.replace( 'txtareaQuestion' );
      });

   </script>

@stop