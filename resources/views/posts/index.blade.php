@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pb-5 d-flex flex-wrap justify-content-center">
                @foreach($allUsers as $user)
                    <a href="/profile/{{ $user->id }}">
                        <img src="{{ $user->profile->profileImage() }}"
                             style="max-width: 45px;"
                             class="w-100 rounded-circle mr-2 mb-2">
                    </a>

                @endforeach
            </div>
        </div>
        @foreach($posts as $post)
            <div class="row">
                <div class="col-6 offset-3">
                    <div>
                        <div
                            class="d-flex align-items-center justify-content-between border border-bottom-0 p-2 bg-white">
                            <div class="d-flex">
                                <div class="pr-3">
                                    <img src="{{ $post->user->profile->profileImage() }}"
                                         style="max-width: 30px;"
                                         class="w-100 rounded-circle">
                                </div>
                                <div class="font-weight-bold">
                                    <a class="text-dark"
                                       href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a>
                                </div>
                                <div class="font-weight-lighter pl-2">
                                    {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 offset-3">
                    <a href="/p/{{ $post->id }}">
                        <img src="{{ (substr($post->image,0,4)=="http") ? $post->image : ('/storage/' . $post->image) }}" alt=""
                                                       class="w-100"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="bg-white border border-bottom-0 p-2">
                        <like-button :post="{{$post->id}}"></like-button>
                    </div>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-6 offset-3">
                    <div>
                        <p class="bg-white border border-top-0 p-2"><span class="font-weight-bold">
                            <a class="text-dark" href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a>
                        </span>
                            {{ $post->caption }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
