@extends('lecturer.layouts.default')
@section('content')
<div class="container-fluid">
   <form class="form-horizontal" method="POST" action="{{ url('lecturer/quiz/create') }}">
      {!! csrf_field() !!}
      
      <p>Name*</p>
      <input name="name" type="text" class="form-control" placeholder="Name">
      <br>
      <p>Intro*</p>
      <textarea name="intro" class="form-control" rows="5"></textarea>
      <br>
      @include('lecturer.includes.timezone')
      <br>
      <input type="checkbox" name="autoopen" id="autoopen">Tự động mở bài thi
      <br>
      <div>
      
      <br>
         <p>Time open*</p>
            <div class="input-group">
                <div class='input-group date datetimepicker'>
                    <input type='text' class="form-control" name='timeopen'/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
        </div>
        
      <br>
 
         <p>Time close*</p>
            <div class="input-group">
                <div class='input-group date datetimepicker'>
                    <input type='text' class="form-control" name='timeclose'/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
      </div>

      <br>
      <div class="input-group">
         <p>Time limit* (minutes)</p>
         <input type="text" class="form-control" name="timelimit">
      </div>

      <br>
      <div class="input-group">
         <p>Score*</p>
         <input type="text" class="form-control" name='score'>
      </div>
      <br>
      <div class="input-group">
         <p>Code</p>
         <input type="text" class="form-control" name="code">
      </div>
      <br>
      <input type="checkbox" name="enroll">Cho phép ghi danh
      <br>
      <input type="checkbox" name="shuffle">Trộn câu hỏi
      <br>

      <hr class="divider" style="border-color: black;">
      
      
      <button type="submit">Submit</button>
   </form>
</div>
@stop

@section('script')
   <script type="text/javascript">
      

      $(document).ready(function(){
         $(function() {
         $('.datetimepicker').each(function(){
         $(this).datetimepicker();
          });
         });

         $('#autoopen').change(function() {
             // Are any of them checked ?
             if ($('#autoopen:checked').length > 0) {
               $("div.timeauto").show();
                 
             } else {
                 $("div.timeauto").hide();
                }
         });
      })
   </script>
@stop

