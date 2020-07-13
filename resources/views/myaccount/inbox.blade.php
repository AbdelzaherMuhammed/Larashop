@extends('front.master')

@section('content')

    <div class="greyBg">
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="{{url('/')}}">Home </a></li>
                                <li><span class="dot">/</span>
                                    <a href="{{url('/home')}}"> {{auth()->user()->name}}</a></li>
                                <li><span class="dot">/</span>
                                    <a href="">inbox</a>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row top25 inboxMain">

                    <div class="col-md-12 inboxRow">
                        <div class="prod"><h2 align="left">Inbox</h2></div>
                        <hr>
                        <div class="col-md-3">
                            <input type="checkbox">
                        </div>

                        <div class="col-md-3">
                            <b>SENDER</b>
                        </div>

                        <div class="col-md-3">
                            <b>SUBJECT</b>
                        </div>

                        <div class="col-md-3">
                            <b>UPDATED</b>
                        </div>
                    </div>

                    @foreach($records as $record)
                        <input type="hidden" value="{{$record->id}}" id="mId{{$record->id}}">
                        <a href="#" data-toggle="collapse"
                           data-target="#d{{$record->id}}">

                            @if($record->status=="0")
                                <div class="col-md-12 inboxRow"
                                     style="background:#ccc; font-weight:bold;
                                    border:1px solid #efefef" id="msg{{$record->id}}">
                                    @else
                                        <div class="col-md-12 inboxRow">
                                            @endif

                                            <div class="col-md-3">
                                                <input type="checkbox">
                                            </div>

                                            <div class="col-md-3">
                                                <p>Admin</p>
                                            </div>

                                            <div class="col-md-3">
                                                <p>{{$record->subject}}</p>
                                            </div>

                                            <div class="col-md-3">
                                                <p>{{$record->updated_at }}</p>
                                            </div>

                                        </div>

                        </a>

                        <div class="collapse container" id="d{{$record->id}}">

                            <div class="inner_msg">
                                <p>{{$record->message}}<p>
                            </div>
                        </div>
                        @endforeach
                        </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>

                $(document).ready(function () {
                    @foreach($records as $record)
                    $('#msg{{$record->id}}').click(function () {

                        var mId = $('#mId{{$record->id}}').val();
                        // alert(mId);
                        $.ajax({
                            type : 'get',
                            url : '{{url('/update/inbox')}}',
                            data :'msgId='+mId,
                            success:function (response) {
                                console.log(response);
                            }

                        })
                    })
            @endforeach
            })
        </script>
    @endpush
@endsection
