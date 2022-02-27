@extends('layouts.app')
@section('content')
    <div class="container-fluid w-100">
        <div class="row">
            <div class="col-md-3 px-0 h-100">
                <div class="border-end border-top shadow-sm border-primary bg-white p-2 vh-85" data-bs-spy="scroll">
                    <div class="input-group mb-3">
                        <autocomplete
                         ref="autocomplete"
                         :source="{{json_encode($users->except($current_id))}}"
                         input-class="form-control bg-white"
                         :results-display="autoCompleteFormattedDisplay"
                         placeholder="Search user"
                         @selected="selectFormattedData"
                         >
                        </autocomplete>
                      </div>
                      <hr>
                      @if (!empty($related_users))
                      <ul class="list-unstyled">
                        @foreach ($related_users as $user)
                           <li>
                               <div class="border-bottom shadow-sm border-info p-3 cursor-pointer div-list-user" @mouseover="UsermouseOver(true,this)" @mouseout="UsermouseOver(false,this)" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="click to chat">
                                    <a href="{{url('chat-rooms').'/'.base64_encode($user->id)}}" class="text-decoration-none d-inline-block text-dark text-bold">
                                        <i class="fa-solid fa-circle-user fa-2x"></i> &nbsp; <b> {{$user->name}}</b>
                                    </a>
                                    <span class="user-list-actions rounded-pill px-2 bg-white shadow-sm float-end">
                                        <i class="fa-solid fa-ellipsis fa-2x text-secondary pt-1 pb-0"></i>
                                    </span>
                                </div>
                            </li> 
                        @endforeach
                    </ul>
                      @else
                        <h4 class="py-4 text-center bg-light text-danger">Empty related users.</h4>
                      @endif
                    
                </div>
            </div>
            <div class="col-md-7 px-0 h-100 border rounded">
                <div id="message-section">
                    @if ($room_code!=null)
                    <sendprivatemessage-component 
                        v-bind:room-code="{{json_encode($room_code)}}" 
                        v-bind:user-code={{json_encode($user_code)}} 
                        v-bind:current-id="{{json_encode($current_id)}}" 
                        v-bind:histories="{{json_encode($histories)}}" 
                        v-bind:user-name="{{json_encode($user_name)}}">
                    </sendprivatemessage-component>
                    @else
                    <h4 class="py-5 text-center">
                        There has no any users' conversations!
                    </h4>
                    @endif
                    
                </div>
                
            </div>
            <div class="col-md-2 px-0 h-100">
                <div class="border-end border-top shadow-sm border-success p-2" data-bs-spy="scroll">
                    <div class="user-hightlight text-center py-3 shadow-sm bg-light">
                        <i class="fa-solid fa-circle-user fa-3x text-success"></i> <br>
                        <b>{{$user_name}}</b> <br>
                        <b><a href="mailto:{{$user_email}}" class="text-decoration-none"><i>{{$user_email}}</i></a></b>
                    </div>
                    <div class="bg-white media-files-section py-3">
                        <h4 class="text-center border-bottom border-primary">Media and Files</h4>
                        <div class="py-3">
                            <h5 class="text-center"><i>There has no any files yet!</i></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection