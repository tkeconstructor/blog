@extends('lecturer.layouts.default')
@section('content')
<div class="container-fluid">
   <h3><a href="{{ asset('lecturer/quiz/'.$quiz->id.'/question') }}"> {{str_limit($quiz->name,30)}}</a></h3>
   <form method="POST" action="{{ url('lecturer/quiz/'.$quiz->id.'/question/create') }}">
      {!! csrf_field() !!}
      <p>Category*</p>
      <select name="category" class="form-control">
         @foreach ($categories as $category)
         <option>{{$category->name}}</option>
         @endforeach
      </select>
      <br>
      <p>Name*</p>
      <input name="name" type="text" class="form-control" placeholder="Name">
      <br>
      <p>Question*</p>
      <textarea name="question" class="form-control" rows="7"></textarea>
      <br>
      <p>Type*</p>
      <select name="type" class="form-control">
         @foreach ($types as $type)
         <option>{{$type->name}}</option>
         @endforeach
      </select>
      <br>
      <hr class="divider" style="border-color: black;">
      <p>Answer*</p>
      <table class='table table-borderless' id="tblMulti">
         <tbody>
            <tr>
               <td>
                  <div class="input-group">
                     <span class="input-group-addon">
                     <input name="chkMulti1"  type="checkbox">
                     </span>
                     <input name="txtMulti1" type="text" class="form-control">
                  </div>
               </td>
            </tr>
            <tr>
               <td>
                  <div class="input-group">
                     <span class="input-group-addon">
                     <input name="chkMulti2"  type="checkbox">
                     </span>
                     <input name="txtMulti2" type="text" class="form-control">
                  </div>
               </td>
            </tr>
            <tr>
               <td>
                  <div class="input-group">
                     <span class="input-group-addon">
                     <input name="chkMulti3" type="checkbox">
                     </span>
                     <input name="txtMulti3" type="text" class="form-control">
                  </div>
               </td>
            </tr>
            <tr>
               <td>
                  <div class="input-group">
                     <span class="input-group-addon">
                     <input name="chkMulti4" type="checkbox">
                     </span>
                     <input name="txtMulti4" type="text" class="form-control">
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
      <table>
                <tbody>
                <tr>

                    <td align="center"><input style="width:25px" type="button" value=" + " onclick="addRow('tblMulti','txtMulti')">
                        <input style="width:25px" type="button" value=" - " onclick="deleteRow('tblMulti')">
                    </td>
                </tr>
            </tbody>
      </table>
      <br>
      <button type="submit">Submit</button>
   </form>
</div>
@stop
@section('script')
   <script src="{{ asset('js/questiontype.js') }}"></script>

@stop