@if(count($searchLectures) >= 1)
    @foreach ($searchLectures as $lecture)
        @if(App\Course::find($lecture->course_id)->done == 1)
            <div style="margin-bottom: 40px">
                <lecture>
                    <div id="pdf_linija1"></div>
                    <div id="pdf_container">
                        {!! Html::image('img/paper.png','ERROR 404',['style'=>'width:70px;margin-left:20px']) !!}
                        <div style="margin-left:10px;display: inline-block">
                            <div id="pdf1"><a href="{{url('library', $lecture->id) }}" class="link"> {{$lecture->lecture_title}} </a></div><br/>

                            <div id="pdf_opis">Course:<a class="link" href="{{url('courses', $lecture->course_id)}}">
                                    {{ App\Course::find($lecture->course_id)->title }}</a>
                                <br>by: {{ App\User::find(App\Course::find($lecture->course_id)->user_id)->username }}
                                <br>{{ $lecture->created_at->diffForHumans() }}</div></div>
                        @if(\Auth::User()->level==1)
                            <a style="display:flex; margin-left: 20px" href="/lectures/{{$lecture->id}}/edit">
                                {!! Html::image('img/edit.png',null,['style'=>'height:1.5em; width:1.5em;position:relative;top:3px']) !!}
                                <div style=" font-size: 1.5em; color: red;  ">
                                    EDIT
                                </div>
                            </a>
                    </div>
                    @endif
                </lecture>
            </div>
        @endif
    @endforeach
@else
    <div style="text-align:center " >
        <h3 id="search_error1"> Whoops! </h3>
        <h4 id="search_error2">No lectures found</h4>
    </div>
@endif
