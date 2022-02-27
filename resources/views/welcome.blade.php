@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="row">
                        <div class="col-md-6 p-3 text-center">
                            <a href="/newsletters" class="btn btn-primary">
                                <div class="h-100 w-100 text-center p-4 m-2">
                                   <b> Newsletter</b>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 p-3 text-center">
                            <a href="/notify/newsletters" class="btn btn-warning">
                                <div class="h-100 w-100 text-center p-4 m-2">
                                   <b> Notification</b>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-12 text-center">
                            <hr>
                            <h3 class="text-center">Public Broadscating</h3>
                            <hr>
                        </div>
                        <div class="col-md-6 p-3 text-center">
                            <a href="/make-event" class="btn btn-danger">
                                <div class="h-100 w-100 text-center p-4 m-2">
                                   <b> Make Events</b>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 p-3 text-center">
                            <a href="/listen-event" class="btn btn-success" target="_blank">
                                <div class="h-100 w-100 text-center p-4 m-2">
                                   <b> Listen Events</b>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-12 text-center">
                            <hr>
                            <h3 class="text-center">Private Message Chatting</h3>
                            <hr>
                            <a href="/chat-rooms" class="btn btn-secondary" target="_blank">
                                <div class="h-100 w-100 text-center p-4 m-2">
                                   <b> Chat App</b>
                                </div>
                            </a>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
