@extends('layouts.app')
@section('title')
    Аккаунт @parent
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>Hello, {{Auth::user()->name }}</h2>
                        <br>
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar}}" style="width: 100px"/>
                            @endif
                        @if(Auth::user()->isAdmin)
                            <p><a href="{{route('admin.index')}}">Панель админа</a></p>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
