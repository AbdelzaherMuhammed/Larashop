<table style="width:100%" class="table table-hover table-striped">
    @foreach($records as $record)
        <tr style="height:50px">
            <td style="padding:10px">{{$record->category_name}}</td>
            <td style="padding:10px">{{$record->parent_id}}</td>
            <td><a class="btn btn-sm btn-fill btn-primary" href="{{url(route('categories.edit' , $record->id))}}">
                    <i class="fa fa-edit xs"></i>
                </a></td>
        </tr>
    @endforeach
</table>



