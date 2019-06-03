@extends('layouts.app')

@section('title','Cart')

@section('content')
    <div class="container">
        @include('partial.session-message')

        <h1 class="display-3">Cart</h1>

        @if(Cart::getTotalQuantity() > 0)
            <h3>{{Cart::getTotalQuantity()}} Item(s) in the Cart</h3>

{{--            <code>{{Cart::getContent()->toJson()}}</code>--}}
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Item Description</th>
                    <th></th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach(Cart::getContent() as $item)
                    <tr>
                        <td><img src="{{$item->attributes->image}}" alt="" class="img-thumbnail" width="200px"></td>
                        <td>
                            <h5>
                                <a href="{{route('shop.show',['slug'=>$item->attributes->slug])}}">{{$item->name}}</a>
                            </h5>
                            <p>{{$item->attributes->details}}</p>
                        </td>
                        <td>
                            <form action="{{route('cart.destroy',$item->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                            </form>
                            <p>
                                Save for Later
                            </p>
                        </td>
                        <td>
                            <cart-update-quantity
                                product-id ="{{$item->id}}"
                                init-quantity="{{$item->quantity}}"></cart-update-quantity>
                        </td>
                        <td>
                            Rs. {{$item->price /100}}
                        </td>
                        <td>
                            Rs. {{$item->getPriceSum() /100}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row p-3" style="background-color: lightgrey">
                <div class="col-4 ">
                    <p>Shipping is free because we're awesome like that. Also because that's additional stuff I don't
                        feel like figuring out :)</p>
                </div>
                <div class="col-4 offset-4">
                    <div class="row">
                        <div class="col">Subtotal</div>
                        <div class="col"><span class="float-right">{{$cart['sub_total']}}</span></div>
                    </div>
                    <div class="row">
                        <div class="col">Tax (VAT 13%)</div>
                        <div class="col">
                            <span class="float-right">{{$cart['vat_total']}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col font-weight-bolder">Total</div>
                        <div class="col font-weight-bolder">
                            <span class="float-right">{{$cart['cart_total']}}</span>
                        </div>
                    </div>
                </div>
            </div>


            <hr>
            <p>
                <a href="/empty" class="btn btn-lg btn-danger">Empty Cart</a>
                <a href="{{route('cart.checkout')}}" class="btn btn-success btn-lg float-right">Checkout</a>
            </p>


        @else
            <div class="alert alert-danger">
                No Items in the cart
            </div>
            <a href="{{route('shop.index')}}">Continue Shopping</a>
        @endif

        @include('partial.might-like')
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
