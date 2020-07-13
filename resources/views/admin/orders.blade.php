@extends('admin.layout.app')
@section('content')
    <script>
        $(document).ready(function(){
            <?php for($i=1;$i<15;$i++){?>
            $('#order_status<?php echo $i;?>').change(function(){
                var order_id<?php echo $i;?> = $('#order_id<?php echo $i;?>').val();
                var order_status<?php echo $i;?> = $('#order_status<?php echo $i;?>').val();


                $.ajax({
                    type: 'get',
                    data: 'order_id=' + order_id<?php echo $i;?> + '&order_status=' + order_status<?php echo $i;?>,
                    url: '<?php echo url('admin/order-status-update');?>',
                    success: function(response){
                        console.log(response);
                        $('#successMsg<?php echo $i;?>').html(response);
                    }
                });
            });
            <?php }?>
        });
    </script>
    <div class="content">


        <div class="card">
            <div class="header text-center">
                <h4 class="title">Orders</h4>
            </div>
            <div class="row row_head">
                <div class="col-md-2 col-xs-2 col-sm-2">    Order ID</div>
                <div class="col-md-2 col-xs-2 col-sm-2">    Date</div>
                <div class="col-md-2 col-xs-2 col-sm-2">    User(Id)</div>
                <div class="col-md-2 col-xs-2 col-sm-2">    Order Total</div>
                <div class="col-md-2 col-xs-2 col-sm-2">    status</div>
                <div class="col-md-2 col-xs-2 col-sm-2">    Details</div>
            </div>
            <?php $countOrder =1;?>
            @foreach($records as $record)

                <div class="row row_body">

                    <div class="col-md-2 col-xs-2 col-sm-2">#{{$record->id}}</div>
                    <div class="col-md-2 col-xs-2 col-sm-2">
                        {{date('d M Y', strtotime($record->created_at))}}<br>
                        {{date('H:i A', strtotime($record->created_at))}}

                    </div>

                    <div class="col-md-2 col-xs-2 col-sm-2">{{$record->username}}(#{{$record->userId}})</div>


                    <div class="col-md-2 col-xs-2 col-sm-2">  {{$record->total}}</div>

                    <div class="col-md-2 col-xs-2 col-sm-2">

                        <input type="hidden" id="order_id<?php echo $countOrder;?>" value="{{$record->id}}"/>
                        <select class="form-control" id="order_status<?php echo $countOrder;?>">
                            <option value="pending"
                                    <?php if($record->status=='pending'){?> selected="selected"<?php }?>>pending</option>

                            <option value="dispatched"
                                    <?php if($record->status=='dispatched'){?> selected="selected"<?php }?>>dispatched</option>

                            <option value="processed"
                                    <?php if($record->status=='processed'){?> selected="selected"<?php }?>>processed</option>

                            <option value="shipping"
                                    <?php if($record->status=='shipping'){?> selected="selected"<?php }?>>shipping</option>

                            <option value="cancelled"
                                    <?php if($record->status=='cancelled'){?> selected="selected"<?php }?>>cancelled</option>

                            <option value="delivered"
                                    <?php if($record->status=='delivered'){?> selected="selected"<?php }?>>delivered</option>
                        </select>
                        <div align="center" id="successMsg<?php echo $countOrder;?>"></div>
                    </div>

                    <div class="col-md-2 col-xs-2 col-sm-2">
                        <a href=""><span class="pe-7s-download" style="font-size:40px"></span></a>
                    </div>

                </div>
                <?php $countOrder++;?>
            @endforeach

        </div>
    </div>

@endsection
