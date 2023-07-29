@extends('admin.layout')
@section('content')
@if (count($categories) > 0)
<div>
    <h1>Category</h1>
    <a href="{{url ('category/create')}}" >
    <button class="btn btn-success">Cretae New</button></a>
    <br></br>
</div>

    <table class="table table-bordered">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>
                    {!! $category->id !!}
                </td>
                <td>
                    {!! $category->name !!}
                </td>
                <td>
                    {!! $category->description !!}
                </td>
                <td><a class="btn btn-primary" href="{!! url('category/' . $category->id . '/edit') !!}">Edit</a></td>
                <td>
                {!! Form::open(array('url'=>'/category/'. $category->id, 'method'=>'DELETE')) !!}
{!! csrf_field() !!}
{!! method_field('DELETE') !!}
<button class="btn btn-danger delete">Delete</button>
{!! Form::close() !!}
                </td>
                        
            </tr>	
            @endforeach
        </tbody> @if(Session::has('category_delete'))
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="if(confirm('Are you sure to delete this book?') === false) event.preventDefault()">></button>
                <strong>Deleted!</strong> {!! session('category_delete') !!}
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