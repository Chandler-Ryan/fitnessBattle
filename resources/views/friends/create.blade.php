@extends('layouts.layout')

@section('title', 'Add Friend')

@section('header')
    Add Friend 
@endsection

@section('content')
<a href="/user/{{auth()->user()->id}}/friends" class="btn btn-outline-primary float-right my-4">Friends List</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr>
                <td><a href="/user/{{auth()->user()->id}}/friends/{{$user->id}}">{{$user->id}}</a></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td style="text-align: right;">
                    <form action="/user/{{auth()->user()->id}}/friends" style="display:inline;" method="POST">
                        @csrf
                        <input type="hidden" name="friend_id" value="{{$user->id}}">
                        <button class="btn btn-outline-success" type="submit">Add</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan='4'class="text-center">There are no friends at this time.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection