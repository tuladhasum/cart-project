@extends('layouts.app')
@section('content')
<section class="container">
    <h1>Shop</h1>

    <div class="row">
        @foreach($products as $product)
            <div class="col-4">
                <div class="card mb-5">
                    <img class="card-img-top"
                         src="{{$product->placeholderImage()}}"
                         alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <h6 class="card-subtitle">{{$product->details}}</h6>
                        <hr>
                        {{$product->description}}
                        <p class="card-text">
                            <small class="text-muted">Last updated {{$product->createAgo()}}</small>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('shop.show', ['slug'=> $product->slug])}}" class="btn btn-sm btn-primary">Details</a> |
                        <strong> {{$product->presentPrice()}}</strong>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
