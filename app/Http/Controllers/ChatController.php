<?php

namespace App\Http\Controllers;

use App\Enroll;
use App\message;
use App\Notification;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
    var $pusher;
    var $user;
    var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function postNext(Request $request)
    {
        $this->pusher = App::make('pusher');
        $this->user = Auth::user();
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
        $this->friends=Enroll::getFriends(\Auth::user());
        $friend_id=e($request->input('friend_id'));
        $current_friend=User::findOrFail($friend_id);
        $messages=Message::where('from_user_id', '=', $this->user->id)->where('to_user_id','=',$current_friend->id)
            ->orWhere(function($query ) use ($current_friend)
            {
                $query->where('from_user_id', '=', $current_friend->id)
                    ->where('to_user_id', '=', $this->user->id);
            })
            ->get();
        return view::make('next', ['chatChannel' => $this->chatChannel, 'friends' => $this->friends, 'messages' => $messages, 'current_friend' => $current_friend]);
    }

    public function getIndex()
    {

        $this->pusher = App::make('pusher');
        $this->user = Auth::user();
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
        $this->friends=Enroll::getFriends(\Auth::user());
        if(!$this->user)
        {
            return redirect('auth/login');
        }
        if(! $this->friends)
            return redirect('/main');

        if (\Input::get('friend'))
            $current_friend=\Input::get('friend');
        else
            $current_friend=$this->friends[0];

        $messages=Message::where('from_user_id', '=', $this->user->id)->where('to_user_id','=',$current_friend->id)
            ->orWhere(function($query ) use ($current_friend)
            {
                $query->where('from_user_id', '=', $current_friend->id)
                    ->where('to_user_id', '=', $this->user->id);
            })
            ->get();
        return view('chat', ['chatChannel' => $this->chatChannel, 'friends' => $this->friends, 'messages' => $messages, 'current_friend' => $current_friend]);
    }

    public function postMessage(Request $request)
    {
        $this->pusher = App::make('pusher');
        $this->user = Auth::user();
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
        $this->friends=Enroll::getFriends(\Auth::user());
        $message = [
            'text' => e($request->input('chat_text')),
            'avatar' => $this->user->profile,
            'username' => $this->user->username,
            'timestamp' => (time()*1000)
        ];

        $this->pusher->trigger(User::findOrFail(e($request->input('to')))->chat_key, 'new-message', $message);
        $this->pusher->trigger(Auth::user()->chat_key, 'new-message', $message);

        $message= new Message();
        $message->from_user_id=$this->user->id;
        $message->to_user_id=e($request->input('to'));
        $message->message= e($request->input('chat_text'));
        $message->save();

        $notification= new Notification();
        $notification->to=e($request->input('to'));
        $notification->from=$this->user->id;
        $notification->save();
    }

    public function postAuth(Request $request)
    {
        $this->pusher = App::make('pusher');
        $this->user = Auth::user();
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
        $this->friends=Enroll::getFriends(\Auth::user());
        if($this->user)
        {
            $channelName=$request->input('channel_name');
            $this->pusher->socket_auth($channelName);
        }
        else {
            return 401;
        }
    }
}
