@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row border-bottom pb-5">
            <div class="col-3 p-5">
                <img
                    src="{{ $user->profile->profileImage() }}" alt="" class="rounded-circle w-100">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline pb-3">
                    <div class="d-flex align-items-center">
                        <h1>{{ $user->username }}</h1>

                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    </div>

                    @can('update',$user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                </div>
                @can('update',$user->profile)
                    <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                @endcan
                <div class="d-flex">
                    <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                    <div class="pr-5"><strong>{{ $followerCount }}</strong> followers</div>
                    <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}
                </div>
            </div>
        </div>
        {{--        end of top part--}}
        <div class="row pt-5" id="profilePosts">
            @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id }}">
                        <img src="{{ (substr($post->image,0,4)=="http") ? $post->image : ('/storage/' . $post->image)  }}"
                             alt="" class="w-100">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
