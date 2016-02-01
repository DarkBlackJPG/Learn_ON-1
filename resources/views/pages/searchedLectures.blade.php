@if(count($searchLectures) >= 1)
    @foreach ($searchLectures as $lecture)
        @if(App\Course::find($lecture->course_id)->done == 1)
        <div style="position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
            <lecture>
                {!! Html::image('img/paper.png','ERROR 404',['style'=>'position:absolute; top:33%; left:3%; width:5.2%;']) !!}
                <div id="pdf1">{{$lecture->lecture_title}}</div>
                <div id="pdf_linija1"></div>
                <div id="pdf_opis">Course:{{ App\Course::find($lecture->course_id)->title }} </br>by:{{ App\User::find(App\Course::find($lecture->course_id)->user_id)->username }}</br>{{ $lecture->created_at }}</div>
            </lecture>
        </div>
        @endif
    @endforeach
@else
    <div style="margin-left:37%;position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
        <h3 id="search_error1"> Whoops! </h3>
        <h4 id="search_error2">No lectures found</h4>
    </div>
@endif