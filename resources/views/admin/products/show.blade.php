<table style="width:100%" class="table table-hover table-striped" >

    @foreach($records as $record)
        <tr style="height:50px">
            <td style="padding: 10px">{{$record->product_name}}</td>
            <td style="padding: 10px">{{$record->product_code}}</td>
            <td style="padding: 10px">{{$record->category->category_name}}</td>
            <td style="padding: 10px">{{$record->product_price}}</td>


            <td><a class="btn btn-sm btn-fill btn-primary" href="{{url(route('products.edit' , $record->id))}}">
                    <i class="fa fa-edit xs"></i>
            </a></td>
        </tr>
    @endforeach
</table>



