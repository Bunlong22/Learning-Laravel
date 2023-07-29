@extends('admin.layout')
@section('content')
@if (count($products) > 0)
<div>
    <h1>Product List</h1>
    <a href="{{url ('product/create')}}" >
    <button class="btn btn-success">Cretae New</button></a>
    <br></br>
</div>
                           
<table class="table table-bordered">
                <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
            </thead>
            <tbody>
 @foreach ($products as $product)
 <tr>
 <td>
         <div>{{ $product->id }}</div>
     </td>
     <td>
         <div>{{ $product->name }}</div>
     </td>
     <td>
         <div>{{ $product->description }}</div>
     </td>
     <td>
         <div class="text-center">{{ Html::image('/img/products/'.$product->image, $product->name, array('width'=>'150', 'height'=> '100')) }}</div>
     </td>
     <td>
         <div class="text-center">${{ $product->price }}</div>
     </td>

     <td><a class="btn btn-primary" href="{{ url('product/' . $product->id . '/edit') }}">Edit</a></td>

     <td>
         {{ Form::open(array('url'=>'product/'. $product->id, 'method'=>'DELETE')) }}
         {{ csrf_field() }}
         {{ method_field('DELETE') }}
         <button class="btn btn-danger delete">Delete</button>
         {{ Form::close() }}
     </td>
 </tr>
 @endforeach
                            </tbody> @if(Session::has('product_delete'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Delete!</strong> {!! session('product_delete') !!}
                </div>
                @endif
    </table>
@endif
@endsection
<script>
    $(".delete").click(function() {
        var form = $(this).closest('form');
        $('<div></div>').appendTo('body')
            .html('<div><h6> Are you sure ?</h6></div>')
            .dialog({
                modal: true,
                title: 'Delete message',
                zIndex: 10000,
                autoOpen: true,
                width: 'auto',
                resizable: false,
                buttons: {
                    Yes: function() {
                        $(this).dialog('close');
                        form.submit();
                    },
                    No: function() {
                        $(this).dialog("close");
                        return false;
                    }
                },
                close: function(event, ui) {
                    $(this).remove();
                }
            });
        return false;
    });
</script>