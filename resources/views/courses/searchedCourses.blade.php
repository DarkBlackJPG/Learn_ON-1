@if(count($searchCourses) >= 1)
    @foreach ($searchCourses as $course)
        <div style="position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
            <course >
                <div id="video_" style="float: left;">{!! Html::image('img/courses/'.$course->thumbnail,null,['style'=>'width:300px; height:200px;left:2%;padding-top:1%; position:relative;']) !!}</div>
                <div style="align: left;" >
                    <div class="maintitl{{ $course->id }}" id="imev"><b> <a class="link" href="{{url('courses', $course->id) }}">{{$course->title}}</a></b></div>
                    <div class="mainopis{{ $course->id }}" id="opisv">{{$course->body}}</div>
                    <div id="datumv">Published {{$course->published_at->diffForHumans()}}</div>
                    <div id="opisv">by {{\App\User::find($course->user_id)->username}}</div>
                    <div id="categoryv"><i>Category: @foreach($course->tags as $tag)<a class="btn btn-link" id="tag_button" style=" font-size: 21pt;bottom: 0px;font-family: 'Exo'; text-decoration: none;" href="{{url('/tags/')}}/{{$tag->name}}"><b>{{$tag->name}}</b></a> @endforeach </i>
                        @if(\Auth::User()->level==1) <a href="courses/{{$course->id}}/edit">{!! Html::image('img/edit.png',null,['style'=>'height:30px; position: absolute; left: 900px; top:6px; width:30px']) !!}<div style="position: absolute; color: red; top: 0px;left:940px ">EDIT</div> </a></div> @endif
                </div>
            </course>
            <br>
        </div>
        <script>
            $(document).ready(function() {
                $(".mainopis{{ $course->id }}").dotdotdot();
                $(".maintitl{{ $course->id }}").dotdotdot();
            });
        </script>
    @endforeach
@else
    <div style="margin-left:37%;position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
        <h3 id="search_error1"> Whoops! </h3>
        <h4 id="search_error2">No courses found</h4>
    </div>
@endif
<script>
</script>
