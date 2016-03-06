@if(count($searchUsers) >=1)
@foreach ($searchUsers as $user)
    <div style="display:flex;margin:auto " >
        <user style="margin: auto">
            <div style="float: left;margin-left:20px;margin-top:10px;">
                <object data="img/users/{{$user->profile}}" type="image/png" style="border-radius: 50%; object-fit: cover; width:200px; height:200px;">
                    <img src="img/avatar.png" style="width:150px; height:150px;"/>
                </object> </div>
            <div id="object_float" ><br>
                <div id="imev"><b> <a href="{{url('users', $user->id) }}" class="link">{{$user->username}}</a></b></div>
                <div id="opisv">{{$user->email}}</div>
                <div id="datumv">Created {{$user->created_at->diffForHumans()}}</div>
                <div id="categoryv"><i>Level:</i><i id="tag_button" style=" font-size: 21pt;bottom: 0px;font-family: 'Exo'; text-decoration: none;" ><b>@if($user->level == '1'){{'Administrator'}}@else {{'User'}} @endif</b></i></div>
            </div>
        </user>
    </div>
    <br/>
    <br/>
@endforeach
@else
    <div style="margin:auto;text-align: center   " >
        <h3 id="search_error1" style="text-align: center"> Whoops! </h3>
        <h4 id="search_error2">No users found</h4>
    </div>
@endif