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
                <td><a class="btn btn-primary" href="{!! url('category/' . $category->id . '/edit') !!}">Edit</a></td>
                <td>
                    {!! Form::open(array('url'=>'category/'. $category->id, 'method'=>'DELETE')) !!}
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}
                    <button class="btn btn-danger">Delete</button>
                    {!! Form::close() !!}
                </td>
            </tr>	
            @endforeach
        </tbody>
    </table>
@endif
@endsection