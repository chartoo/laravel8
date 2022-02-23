@extends('messagenotifications.layout')
@section('content')
<body>
    <div id="app" class="container App">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Your messages is in here!</h3>
                <ul class="flash_msg">
                    <li class="msg s_info" v-for="(message, index) in messages">
                        <span><i class="fas fa-info"></i></span>
                        <div class="text">
                            <div class="title">@{{ message.title }}</div>
                            <div class="content">@{{ message.body }}</div>
                            <div class="time">@{{message.time}}</div>
                        </div>
                        <span class="alink" v-on:click="showAlert"><i class="fas fa-times"></i></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <form action="{{url('send-make-event')}}" ref="form" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="Enter Message">Enter Title </label>
                        <input type="text" name="title" id="" class="form-control" v-model="store.title">
                    </div>
                    <div class="mb-3">
                        <label for="message">Enter Your Message</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control mb-2" v-model="store.body"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success px-3" v-on:click="submit">Send >> </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection