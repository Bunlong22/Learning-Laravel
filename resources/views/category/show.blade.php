@extends('admin.layout')
@section('content')
    <h1>Category details</h1>
    <p>Title: {{$category->name}}</p>
     <p>Description: {{$category->description}}</p>
    <a class="btn btn-secondary" href="{{route('category.list')}}">Back</a>

       @endsection       