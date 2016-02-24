@if(count($searchLectures) >= 1)
    @foreach ($searchLectures as $lecture)
        @if(App\Course::find($lecture->course_id)->done == 1)
        <div style="margin-bottom:100px;">
            <lecture>
              <div id="pdf_linija1"></div>
              <div id="pdf_container">
                {!! Html::image('img/paper.png','ERROR 404',['style'=>'width:70px;margin-left:20px']) !!}
                <div style="margin-left:10px;">
                <div id="pdf1">{{$lecture->lecture_title}}</div>

                <div id="pdf_opis">Course:{{ App\Course::find($lecture->course_id)->title }} </br>by:{{ App\User::find(App\Course::find($lecture->course_id)->user_id)->username }}</br>{{ $lecture->created_at }}</div>
            </lecture>
        </div>
      </div>
      </div>
        @endif
    @endforeach
@else
    <div style="text-align:center " >
        <h3 id="search_error1"> Whoops! </h3>
        <h4 id="search_error2">No lectures found</h4>
    </div>
@endif
