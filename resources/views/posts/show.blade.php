@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row no-gutters">
            <div class="col-6 ">
                <img src="{{ (substr($post->image,0,4)=="http") ? $post->image : ('/storage/' . $post->image)  }}"
                     alt="" class="w-100">
            </div>
            <div class="col-4 bg-white border border-left-0 px-3">
                <div>
                    <div class="d-flex align-items-center pt-3">
                        <div class="pr-3">
                            <img src="{{ $post->user->profile->profileImage() }}"
                                 style="max-width: 40px;"
                                 class="w-100 rounded-circle">
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold">
                                <a class="text-dark" href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a>
                            </div>
                            <div>
                                <follow-button user-id="{{ $post->user->id }}"
                                               follows="{{ $post->follows }}"></follow-button>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="bg-white">
                        <like-button :post="{{$post->id}}"></like-button>
                    </div>
                    <p><span class="font-weight-bold">
                            <a class="text-dark" href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a>
                        </span>
                        {{ $post->caption }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
