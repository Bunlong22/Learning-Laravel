@extends('admin.layout')
@section('content')
    <h1>Product details</h1>
    <p>Title: {{$product->name}}</p>
     <p>Description: {{$product->description}}</p>
     <p>Price: {{$product->price}}</p>
     <div>{{ Html::image('/img/products/'.$product->image, $product->name, array('width'=>'100%', 'height'=> 'auto')) }}</div> </br>
     <a class="btn btn-secondary" href="{{url('/product')}}">Back</a>

       @endsection       