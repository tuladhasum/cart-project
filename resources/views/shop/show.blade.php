@extends('layouts.app')
@section('title', $product->name)

@section('content')

    <div class="container">
        @if($product)
            <div class="card mb-3" >
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{$product->placeholderImage()}}" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title">{{$product->name}}</h1>
                            <h3>{{$product->presentPrice()}}</h3>
                            <h6 class="card-subtitle">{{$product->details}}</h6>
                            <p class="card-text">{!! $product->description !!}</p>
                            <p class="card-text"> <small class="text-muted">Last updated {{$product->createAgo()}}</small></p>
                            <form action="{{route('cart.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="name" value="{{$product->name}}">
                                <input type="hidden" name="price" value="{{$product->price}}">
                                <input type="hidden" name="details" value="{{$product->details}}">
                                <input type="hidden" name="image" value="{{$product->placeholderImage()}}">
                                <input type="hidden" name="slug" value="{{$product->slug}}">


                                <button type="submit" class="btn btn-primary">Add to Cart</button>

                            </form>
                            <hr>
                            <a href="{{route('shop.index')}}" class="btn btn-danger">Back to Shop</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('partial.might-like')
    </div>

@endsection
