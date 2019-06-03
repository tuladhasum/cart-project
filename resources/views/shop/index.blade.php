@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Shop</h1>
        <hr>
        <div class="row">
            <div class="col-md-2 ">

                <div class="card">
                    <div class="card-header">Categories</div>
                    <ul class="list-group ">
                        @foreach($categories as $category)
                            <a href="{{route('shop.index',['category'=>$category->slug])}}"
                               class="{{setActiveCategory($category->slug)}} list-group-item d-flex justify-content-between align-items-center list-group-item-action ">
                                {{$category->name}}
                                <span class="badge badge-secondary badge-pill">14</span>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between">
                    <h3>{{$categoryName}}</h3>
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown">Sort by
                                Price
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{route('shop.index', ['category'=>request()->category, 'sort' => 'low-high'])}}"
                                   class="dropdown-item {{request()->sort == 'low-high' ? 'active' : ''}}">Low to
                                    High</a>
                                <a href="{{route('shop.index', ['category'=>request()->category, 'sort' => 'high-low'])}}"
                                   class="dropdown-item  {{request()->sort == 'high-low' ? 'active' : ''}}">High to
                                    Low</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-4">
                            <div class="card mb-5">
                                <img class="card-img-top"
                                     src="{{$product->placeholderImage()}}"
                                     alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{$product->name}}</h5>
                                    <h6 class="card-subtitle">{{$product->details}}</h6>
                                    <hr>
                                    {!! $product->description !!}
                                    <p class="card-text">
                                        <small class="text-muted">Last updated {{$product->createAgo()}}</small>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{route('shop.show', ['slug'=> $product->slug])}}"
                                       class="btn btn-sm btn-primary">Details</a> |
                                    <strong> {{$product->presentPrice()}}</strong>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger">
                            No Items found
                        </div>
                    @endforelse

                    {{$products->appends(request()->input())->links()}}
                </div>
            </div>
        </div>


    </section>
@endsection
