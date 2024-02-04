@extends('administrator.template')
@section('title', 'Profile')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-md-flex align-items-center">
                            <div class="text-center text-sm-left ">
                                <div class="avatar avatar-image" style="width: 150px; height:150px">
                                    <img src="@if($user->image) {{ asset('administrator/storage/'.$user->image) }} @else {{ asset('administrator/assets/img/profiles/thumb-1.jpg') }} @endif" alt="{{ $user->first_name }}" style="object-fit: cover; object-position: center;">
                                </div>
                            </div>
                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                <h2 class="m-b-5">{{ $user->first_name .' '. $user->last_name }}</h2>
                                <p class="text-dark m-b-20">{{ $user->roles->name }}</p>
                                <a href="{{ route('profile.edit', $user->id) }}"><button class="btn btn-primary btn-tone m-r-5">Edit</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="d-md-block d-none border-left col-1"></div>
                            <div class="col">
                                <ul class="list-unstyled m-t-10">
                                    <li class="row">
                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                            <span>Email: </span>
                                        </p>
                                        <p class="col font-weight-semibold">{{ auth()->user()->email }}</p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                            <span>No. HP: </span>
                                        </p>
                                        <p class="col font-weight-semibold">{{ $user->phone }}</p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Alamat: </span>
                                        </p>
                                        <p class="col font-weight-semibold">{{ $user->address }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
