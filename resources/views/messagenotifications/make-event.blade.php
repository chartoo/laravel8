@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="{{url('send-make-event')}}" method="post">
                    @csrf
                    <label for="Enter Message">Enter Title </label>
                    <input type="text" name="title" id="" class="form-control"><br>
                    <label for="message">Enter Your Message</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control mb-2"></textarea>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success px-3">Send >> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection