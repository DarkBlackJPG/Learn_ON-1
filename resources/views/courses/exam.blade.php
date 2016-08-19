@extends('app')

@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija"></div>
    <div id="learn"><a href="/main">LEARN_ON</a></div>
    <div><a href="{{URL('chat')}}">{!! Html::image('img/chat.svg','alt',['style'=>'width:45px; position:absolute; left:250px;top:10px; ']) !!}</a></div>
    <div id="podvucena"></div>
    <div style="width:80%; left:18.7%; text-align:center; position:absolute;">
        <section style="font-size:2em; font-family: Exo_Bold"> - TEST - </section>
    </div>

    <!-- Levi meni -->

    <div id="desnimeni">
        <div id="avatar">{!! Html::image('img/courses/'.$course->thumbnail,'Error 404') !!}</div>
        <div id="titl" style="width:100%;text-align:center" ><b title="{{$course->title}}" style="color:red; font-family:Intro_Bold; text-decoration: underline;  font-size:1.5em;">{{$course->title}}</b></div>
        <div style="position:relative; top: -30px">
            @foreach($course->lectures()->oldest('created_at')->get() as $lecturec)
                <div style="position:relative;">
                    <div id="account">{!! Html::image('img/paper.png','alt',['style'=>'width:50px; height:70px; left:20px;top:45px;  position:relative;']) !!}</div>
                    <div style="width:205px; font-family:Intro_Bold; left:33%; position:relative; font-size:130%; padding-bottom: -4%;"><a href="{{URL('lectures/'.$lecturec->id)}}" class="link">{{ $lecturec->lecture_title }}</a></div>
                </div>
            @endforeach
            <div style="position:relative;">
                <div id="account">{!! Html::image('img/test.png','alt',['style'=>'width:70px; height:70px; left:12%;top:45px;  position:relative;']) !!}</div>
                <div style="font-family:Intro_Bold; left:35%; position:relative; font-size:150%; padding-bottom: -4%;"><a href="{{URL('exam/'.$course->id)}}" class="link">Test</a></div>
            </div>
        </div>
        <div id="linija"></div>
        <div id="static">
            <div >
                <div class="block" id="about_img">{!! Html::image('img/about.png','alt',['style'=>' width:25px; ']) !!}</div>
                <div class="block" id="about"><a href="{{URL('about')}}" class="link">About us</a></div>
            </div>
            <div>
                <div class="block" id="contact_img">{!! Html::image('img/contact.png','alt',['style'=>'width:25px;']) !!}</div>
                <div class="block" id="contact"><a href="{{URL('contact')}}" class="link">Contacts</a></div>
            </div>
            <div >
                <div class="block" id="help_img">{!! Html::image('img/help.png','alt',['style'=>' width:25px;']) !!}</div>
                <div class="block" id="help"><a class="link" href="help">Help</a></div>
            </div>
            <div >
                <div class="block" id="t&c_img">{!! Html::image('img/t&c.svg','alt',['style'=>'width:25px']) !!}</div>
                <div class="block" id="t&c"><a href="{{URL('terms&conditions')}}" class="link">T & C</a></div>
            </div>
        </div>
    </div>

    <!-- End -->
<div id="content_wrapper">
    <div id="polje4" style="overflow-x:hidden ">
        @foreach($questions as $question)
            <div style="position:relative; height: 390px">
                {!! Form::open(['id'=>'myForm']) !!}
                {!! Form::hidden('id',$question->id) !!}

                <div id="pitanje" style="border-bottom: none; font-size: 25px">{{ $question->question }}</div> <div style="color:silver;left:385px; top:325px; font-size: 20px">-{{ $question->correct1 +$question->correct2 +$question->correct3 +$question->correct4 +$question->correct5 }} correct answers!</div>
                <div id="pitanje_linija"></div>

                <div id="prvi">1.</div>
                <div id="prvi_odgovor">{{ $question->answer1 }}</div>
                <div id="prvi_odgovor_linija"></div>
                {!! Form::checkbox('correct1',1,null,['style'=>'position:relative; left:450px; top:-25px']) !!}

                <div id="drugi">2.</div>
                <div id="drugi_odgovor">{{ $question->answer2 }}</div>
                <div id="drugi_odgovor_linija"></div>
                {!! Form::checkbox('correct2',1,null,['style'=>'position:relative; left:450px; top:-55px']) !!}

                <div id="treci">3.</div>
                <div id="treci_odgovor">{{ $question->answer3 }}</div>
                <div id="treci_odgovor_linija"></div>
                {!! Form::checkbox('correct3',1,null,['style'=>'position:relative; left:450px; top:-85px']) !!}

                <div id="cetvrti">4.</div>
                <div id="cetvrti_odgovor">{{ $question->answer4 }}</div>
                <div id="cetvrti_odgovor_linija"></div>
                {!! Form::checkbox('correct4',1,null,['style'=>'position:relative; left:450px; top:-115px']) !!}

                <div id="peti">5.</div>
                <div id="peti_odgovor">{{ $question->answer5 }}</div>
                <div id="peti_odgovor_linija"></div>
                {!! Form::checkbox('correct5',1,null,['style'=>'position:relative; left:450px; top:-148px']) !!}
                 <div style="width:100%;height: auto;text-align: center">
                    <button id="button" type="submit" class="addqu" style="cursor: pointer;  width:60%;">{!! Html::image('img/save.png','Error404',['class'=>'addqu','style'=>'width:100%; height:100%;']) !!}</button>
                </div>
                {!! Form::close() !!}
                <div id="kraj_odgovora_linija" ></div>

            </div>
            <br>
            <br>
        @endforeach
    </div>
    </div>
    </body>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $("#titl").dotdotdot();
        });
    </script>
    <script>

        $( 'form' ).submit(function( event ) {
            event.preventDefault();

            var $form = $( this ),
                    id = $form.find("input[name='id']").val(),
                    correct1 = $form.find( "input[name='correct1']" ).is(':checked'),
                    correct2 = $form.find( "input[name='correct2']" ).is(':checked'),
                    correct3 = $form.find( "input[name='correct3']" ).is(':checked'),
                    correct4 = $form.find( "input[name='correct4']" ).is(':checked'),
                    correct5 = $form.find( "input[name='correct5']" ).is(':checked');

            $.post( '/save', { id: id, guess1: correct1, guess2: correct2, guess3: correct3, guess4: correct4, guess5: correct5 },
                    $(this).find(':submit').attr('disabled','disabled'),
                    $(this).find(':submit').attr('class',''),
                    $(this).find(':submit').attr('style','background: transparent; box-shadow:none; border:none; text-shadow:none; color:transparent; disabled: disabled;width:60%')
            );
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var height = $('#gornjalinija').height();
            $('#desnimeni').height( $(window).height() - height )
            $(window).resize(function(){$('#slideshow').height( $(window).height() - height )
                $('#desnimeni').height( $(window).height() - height )});

        });
    </script>
    <script>swal("WARNING!", "Please do not leave this page until you finish the test. You will not be able to get back on this page, once you leave you finished the course!", "warning")</script>
@stop
