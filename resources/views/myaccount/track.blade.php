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
			          <a href="{{url('/myaccount')}}"> {{auth()->user()->name}}</a></li>
                <li><span class="dot">/</span>
                  <a href="">Track Order</a>
			        </ul>
                        </div>
                    </div>
	     </div>

          <div class="row top25 inboxMain" >
             <div class="row text-center alert alert-info">
             <div class="col-md-4"><h3>Order No:  {{$records[0]->id}}</h3> </div>
             <div class="col-md-4"><h3>Total: {{$records[0]->total}}</h3> </div>
             <div class="col-md-4"><h3> Status: <mark>{{$records[0]->status}}</mark></h3></div>
            </div>

               @if($records[0]->status=="pending")
               @include('myaccount.steps.pending')

               @elseif($records[0]->status=="dispatched")
                @include('myaccount.steps.dispatched')


                 @elseif($records[0]->status=="processed")
                @include('myaccount.steps.processed')


                 @elseif($records[0]->status=="shipped")
                @include('myaccount.steps.shipped')

                @elseif($records[0]->status=="delivered")
                @include('myaccount.steps.delivered')

                @elseif($records[0]->status=="cancelled")

              <h1 align="center">your order cancelled by admin</h1>

               @endif

              </div>



        </div>
    </div>
  </div>
</div>
@endsection
