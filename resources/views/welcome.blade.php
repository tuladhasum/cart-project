@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="jumbotron">
            <h1 class="display-4">Welcome to Tetrade Store</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention
                to featured content or information.</p>
            <hr class="my-4">
            <a class="btn btn-primary btn-lg" href="{{route('shop.index')}}" role="button">Enter Shop</a>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-3">
                    <div class="card mb-5">
                        <img class="card-img-top img-thumbnail rounded"
                             src="{{$product->placeholderImage()}}"
                             alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <h6 class="card-subtitle">{{$product->details}}</h6>
                            <p class="card-text">
                                <small class="text-muted">Last updated {{$product->createAgo()}}</small>
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{route('shop.show', ['slug'=> $product->slug])}}" class="btn btn-sm btn-primary">Details</a>
                            |
                            <strong> {{$product->presentPrice()}}</strong>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
