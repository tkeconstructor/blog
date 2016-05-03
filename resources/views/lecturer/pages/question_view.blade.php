<!DOCTYPE html>
<html lang="en">
    <head>
        @include('lecturer.includes.head')
    </head>
    <body>

        <div class="container" style="padding-top: 40px">
            <p><b>Câu hỏi: </b> Chọn một hoặc nhiều đáp án</p>
            <p> <b>{{$question->questiontext}}</b></p>
            <form>
                    
                @foreach ($question->answers->shuffle() as $answer)
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="chkMulti[]" value="{{$answer->answer}}">
                        {{$answer->answer}}
                    </label>
                    </div>
                @endforeach
                        
                    
            </form>
        </div>

    
    </body>
</html>

