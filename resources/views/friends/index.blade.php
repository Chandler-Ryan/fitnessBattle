@extends('layouts.layout')

@section('title', 'Friends List')

@section('header')
    Friends List 
@endsection

@section('content')
<a href="/user/{{auth()->user()->id}}/friends/create" class="btn btn-outline-primary float-right my-4">Add New Friends</a>
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
        @forelse ($friends as $friend)
            <tr>
                <td><a href="/user/{{auth()->user()->id}}/friends/{{$friend->id}}">{{$friend->id}}</a></td>
                <td>{{$friend->name}}</td>
                <td>{{$friend->email}}</td>
                <td style="text-align:right;">
                    <form action="/user/{{auth()->user()->id}}/friends/{{$friend->id}}" style="display:inline;" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-outline-danger" type="submit">Unfriend!</button>
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