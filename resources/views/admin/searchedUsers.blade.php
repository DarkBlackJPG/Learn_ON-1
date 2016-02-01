@if(count($searchUsers) >=1)
@foreach ($searchUsers as $user)
    <div style="position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
        <user >
            <div style="float: left;"><object data="img/users/{{$user->profile}}" type="image/png" style="border-radius: 50%; object-fit: cover; width:200px; height:200px;left:2%;padding-top:1%; position:relative;">
                    <img src="img/avatar.png" style="width:200px; height:200px;left:2%;padding-top:1%; position:relative;"/>
                </object> </div>
            <div style="align: left;" ><br>
                <div id="imev"><b> <a href="{{url('users', $user->id) }}" class="link">{{$user->username}}</a></b></div>
                <div id="opisv">{{$user->email}}</div>
                <div id="datumv">Created {{$user->created_at->diffForHumans()}}</div>
                <div id="categoryv"><i>Level:</i><i id="tag_button" style=" font-size: 21pt;bottom: 0px;font-family: 'Exo'; text-decoration: none;" ><b>@if($user->level == '1'){{'Administrator'}}@else {{'User'}} @endif</b></i></div>
            </div>
        </user>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
@endforeach
@else
    <div style="margin-left:37%;position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
        <h3 id="search_error1"> Whoops! </h3>
        <h4 id="search_error2">No users found</h4>
    </div>
@endif