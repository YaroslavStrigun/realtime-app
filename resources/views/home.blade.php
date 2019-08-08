@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                        {{--<ajax-component></ajax-component>--}}
                    {{--<prop-component :urldata="{{ json_encode($url_data) }}">--}}

                    {{--</prop-component>--}}
                    {{--<line-chart-component></line-chart-component>--}}
                    {{--<pie-chart-component></pie-chart-component>--}}
                    {{--<random-component></random-component>--}}
                    {{--<socket-component></socket-component>--}}
                    {{--<chat-component></chat-component>--}}
                        <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()->email }}</h4>
                    <private-chat-component :users="{{ \App\User::select('email', 'id')->where('id', '!=', \Illuminate\Support\Facades\Auth::user()->id)->get() }}"
                    :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></private-chat-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
