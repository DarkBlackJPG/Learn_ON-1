@if(count($searchCourses) >= 1)
    @foreach ($searchCourses as $course)
         <div class="course_wrapper" >
            <course >
                <div id="thumbnail">
                    {!! Html::image('img/courses/'.$course->thumbnail,null) !!}
                </div>
                <div id="course_info" >
                    <div class="maintitl{{ $course->id }}" id="imev">
                        <b> <a class="link" href="{{url('courses', $course->id) }}">{{$course->title}}</a></b></div>
                    <div class="mainopis{{ $course->id }}" id="opisv">{{$course->body}}</div>
                    <div id="datumv">Published {{$course->published_at->diffForHumans()}}</div>
                    <div id="opisv">by {{\App\User::find($course->user_id)->username}}</div>
                    <div id="categoryv">
                        <i>
                            Category: @foreach($course->tags as $tag)
                                <a class="btn btn-link" id="tag_button" href="{{url('/tags/')}}/{{$tag->name}}">
                                    <b>{{$tag->name}}</b></a>
                            @endforeach
                        </i>
                        @if(\Auth::User()->level==1)
                            <br/>
                            <a href="courses/{{$course->id}}/edit" id="edit_button">
                                {!! Html::image('img/edit.png',null) !!}<div>EDIT</div></a>


                    </div>
                    @else
                </div>
                @endif

            </course>
        </div>
        <br>
        </div>
        <script>
            $(document).ready(function() {
                $(".mainopis{{ $course->id }}").dotdotdot();
                $(".maintitl{{ $course->id }}").dotdotdot();
            });
        </script>
        <div style="height: 5px; background-color:#EBEBEB; width: 100%"></div>
    @endforeach
@else
    <div style="margin-left:37%;position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
        <h3 id="search_error1"> Whoops! </h3>
        <h4 id="search_error2">No courses found</h4>
    </div>
@endif
<script>
</script>
