

<div id="desnimeni">
    <div id="avatar">{!! Html::image('img/users/'.\Auth::user()->profile,'Error 404') !!}</div>
    <div style="width:100%;text-align:center" ><b class="link" style="color:red; font-family:Intro_Bold; text-decoration: underline;  font-size:1.5em;">{{\Auth::user()->username}}</b></div>
    <div style="text-align:justify; padding-left:20px;margin-top:15px;margin-bottom:15px;">
        <div class="links" >
            <div id="account">{!! Html::image('img/acount.png','alt',['style'=>'width:18px;']) !!}</div>
            <div id="ac"><a href="{{URL('account')}}" class="link">Account</a></div>
        </div>
        @if(\Auth::User()->level==1)
            <div class="links">
                <div id="user">{!! Html::image('img/users.png','alt',['style'=>'width:18px;']) !!}</div>
                <div id="users"><a href="{{URL('users')}}" class="link">All Accounts</a></div>
            </div>
        @endif
        <div class="links">
            <div id="lb">{!! Html::image('img/library.png','alt',['style'=>'width:25px;']) !!}</div>
            <div id="library"><a href="{{URL('library')}}" class="link">Library</a></div>
        </div>
        @if(\Auth::User()->level==1)
            <div class="links">
                <div id="plus">{!! Html::image('img/add.png','alt',['style'=>'width:18px;']) !!}</div>
                <div id="users"><a href="{{URL('courses/create')}}" class="link">Add new course</a></div>
            </div>
            @if(\Auth::user()->courses()->exists())
                <div class="links">
                    <div id="mc">{!! Html::image('img/mycourses.png','alt',['style'=>'width:25px;']) !!}</div>
                    <div id="my_courses"><a href="{{URL('/mycourses')}}" class="link">My courses</a></div>
                </div>
            @endif
        @endif
        <div class="links" >
            <div id="hr">{!! Html::image('img/history.svg','alt',['style'=>'width:18px;']) !!}</div>
            <div id="logout"><a class="link"  href="{{ url('auth/logout') }}">Log out</a></div>
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
<script type="text/javascript">
$(document).ready(function(){
    var height = $('#gornjalinija').height();
        $('#desnimeni').height( $(window).height() - height )
        $(window).resize(function(){$('#slideshow').height( $(window).height() - height )
        $('#desnimeni').height( $(window).height() - height )});
        
        });
</script>
<script type="text/javascript">
   $(document).ready(function(){
       var width = $('#desnimeni').width()+20;
       $('#content_wrapper').width($(window).width() - width);
       if($(window).width()<=800)
       {
           $('#content_wrapper').width($(window).width() - 20);
       }
       $('#content_wrapper').height($(window).height()-80);
       $(window).resize(function(){
        $('#content_wrapper').height($(window).height()-80);
        $('#content_wrapper').width($(window).width() - width);});

    });
</script>

