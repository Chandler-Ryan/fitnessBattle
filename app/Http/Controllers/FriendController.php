<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( User $user )
    {
        return view('friends.index',['friends' => $user->friends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( User $user )
    {
        $users = $this->getNotFriends($user);
        return view('friends.create',['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user )
    {
        $validIDs = $this->getNotFriends($user)->pluck('id')->toArray();
        $implodedIDs = implode(',',$validIDs);
        $validated = $request->validate([
            'friend_id' => "in:$implodedIDs",
        ]);
        // dd($validated);
        $user->friends()->attach($validated['friend_id']);
        return redirect('/user/'.$user->id.'/friends/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/user/'.$user->id.'/friends/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/user/'.$user->id.'/friends/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('/user/'.$user->id.'/friends/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user, int $friend)
    {
        if( in_array($friend, $user->friends()->pluck('id')->toArray()) )
        {
            $user->friends()->detach($friend);
        }
        return redirect('/user/'.$user->id.'/friends/');
    }


    private function getNotFriends(User $user)
    {
        $friendAndSelfIDs = $user->friends()->pluck('id')->toArray();
        $friendAndSelfIDs[] = $user->id;
        return User::whereNotIn('id', $friendAndSelfIDs )->get();
    }
}
