<div id="desnimeni">
    <div id="avatar">{!! Html::image('img/users/'.\Auth::user()->profile,'Error 404',['style'=>'border-radius: 50%; object-fit: cover; width:75px; height:75px; left:30%; top:20px;  position:relative;']) !!}</div>
    <div style="text-align: center;  width: 100%; margin-top:25px; margin-bottom:-30px"><b class="link" style="color:red; font-family:Intro_Bold; text-decoration: underline;  font-size:26pt; margin-left:-15%;">{{\Auth::user()->username}}</b></div>
    <div style="position:relative;">
        <div style="position:relative;">
            <div id="account">{!! Html::image('img/acount.png','alt',['style'=>'width:18px; height:18px; left:17%;top:45px;  position:relative;']) !!}</div>
            <div id="ac"><a href="{{URL('account')}}" class="link">Account</a></div>
        </div>
        @if(\Auth::User()->level==1)
            <div style="position:relative;">
                <div id="user">{!! Html::image('img/users.png','alt',['style'=>'width:18px; height:18px; left:17%;top:45px;  position:relative;']) !!}</div>
                <div id="users"><a href="{{URL('users')}}" class="link">All Accounts</a></div>
            </div>
        @endif
        <div style="position:relative;">
            <div id="lb">{!! Html::image('img/library.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
            <div id="library"><a href="{{URL('library')}}" class="link">Library</a></div>
        </div>
        @if(\Auth::User()->level==1)
            <div style="position:relative;">
                <div id="plus">{!! Html::image('img/add.png','alt',['style'=>'margin-top:-2%; width:18px; height:18px; left:17%;top:45px;  position:relative;']) !!}</div>
                <div id="users"><a href="{{URL('courses/create')}}" class="link">Add new course</a></div>
            </div>
            @if(\Auth::user()->courses()->exists())
                <div style="position:relative;">
                    <div >{!! Html::image('img/mycourses.png','alt',['style'=>'width:25px; left:47px; top:30px; height:25px;  position:relative;']) !!}</div>
                    <div style="font-family:Intro;left:30%;position:relative;font-size:130%;"><a href="{{URL('/mycourses')}}" class="link">My courses</a></div>
                </div>
            @endif
        @endif
        <div style="position:relative;" >
            <div id="hr">{!! Html::image('img/history.svg','alt',['style'=>'width:18px; height:18px; left:17%; top:28px;  position:relative;']) !!}</div>
            <div id="logout"><a class="link"  href="{{ url('auth/logout') }}">Log out</a></div>
        </div>
    </div>
    <div id="linija"></div>
    <div id="static">
        <div style="position:relative; margin-top: -23px">
            <div id="about_img">{!! Html::image('img/about.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
            <div id="about" style="padding-left: 90px; padding-top: 5px"><a href="{{URL('about')}}" class="link">About us</a></div>
        </div>
        <div style="position:relative; margin-top: -13px;">
            <div id="contact_img">{!! Html::image('img/contact.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
            <div id="contact" style="padding-left: 90px; padding-top: 5px"><a href="{{URL('contact')}}" class="link">Contacts</a></div>
        </div>
        <div style="position:relative; margin-top: -13px;">
            <div id="help_img">{!! Html::image('img/help.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
            <div id="help" style="padding-left: 90px; padding-top: 5px"><a class="link" href="help">Help</a></div>
        </div>
        <div style="position:relative; margin-top: -13px;">
            <div id="t&c_img">{!! Html::image('img/t&c.svg','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
            <div id="t&c" style="padding-left: 90px; padding-top: 5px"><a href="{{URL('terms&conditions')}}" class="link">Terms & Conditions</a></div>
        </div>
    </div>
</div>