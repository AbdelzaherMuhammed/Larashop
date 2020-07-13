@foreach($records as $record)
    <div class="col-xs-6 col-sm-4">
        <div class="itemBox">
            <div class="prod"><img src="{{asset('/images/' .$record->product_image)}}"
                                   height="300px" width="300px" alt=""/></div>
            <label>{{$record->product_name}}</label>
            <span class="hidden-xs">Code : {{$record->product_code}}</span>
            <br>
            <span class="hidden-xs">Information : {{$record->product_info}}</span>
            <div class="addcart">
                <div class="price">RS {{$record->product_price}}</div>
                <div class="cartIco hidden-xs"><a href="/"></a></div>
            </div>
        </div>
    </div>
@endforeach
