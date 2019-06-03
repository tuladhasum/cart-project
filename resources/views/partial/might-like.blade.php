<hr>
<h2>You might also like..</h2>
<div class="row">
    @foreach($mightAlsoLike as $product)
        <div class="col-3">
            <div class="card mb-5">
                <img class="card-img-top"
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
                    <a href="{{route('shop.show', ['slug'=> $product->slug])}}" class="btn btn-sm btn-primary">Details</a> |
                    <strong> {{$product->presentPrice()}}</strong>
                </div>
            </div>
        </div>
    @endforeach
</div>
