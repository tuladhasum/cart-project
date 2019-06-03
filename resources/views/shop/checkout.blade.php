@extends('layouts.app')

@section('title','Cart')

@section('content')
    <div class="container">
        @include('partial.session-message')

        <h1 class="xdisplay-4">Checkout</h1>
        <hr>

        <div class="row mt-3">
            <div class="col-6">
                <h4>Billing Details</h4>

                <form action="" class="mt-4">
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-row form-group">
                        <div class="col">
                            <label for="">City</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="">Province</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-row form-group">
                        <div class="col">
                            <label for="">Postal Code</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="">Phone</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>


                    <h4 class="mt-5 mb-3">Payment Details</h4>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Credit Card Number</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-row form-group">
                        <div class="col">
                            <label for="">Expiry</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="">CVC Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <a href="" class="btn btn-block btn-success">Complete Order</a>
                    </div>

                </form>

            </div>
            <div class="col-6">
                <h4>Your Order</h4>

                @if(Cart::getTotalQuantity() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Item Description</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Cart::getContent() as $item)
                            <tr>
                                <td><img src="{{$item->attributes->image}}" alt="" class="img-thumbnail" width="200px">
                                </td>
                                <td>
                                    <h5>
                                        <a href="{{route('shop.show',['slug'=>$item->attributes->slug])}}">{{$item->name}}</a>
                                    </h5>
                                    <p>{{$item->attributes->details}}</p>
                                </td>
                                <td class="text-center">
                                    {{$item->quantity}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="row pl-4">
                        <div class="col">Subtotal</div>
                        <div class="col">
                            <span class="float-right">{{presentPrice(Cart::getSubtotal())}}</span>
                        </div>
                    </div>
                    <div class="row pl-4">
                        <div class="col">Tax (VAT 13%)</div>
                        <div class="col">
                            <span class="float-right">
                                {{presentPrice(Cart::getTotal()- Cart::getSubtotal())}}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-4">
                        <div class="col font-weight-bolder">Total</div>
                        <div class="col font-weight-bolder">
                            <span class="float-right">{{presentPrice(Cart::getTotal())}}</span>
                        </div>
                    </div>
                    <hr>
                @endif
            </div>
        </div>


        {{--        @include('partial.might-like')--}}
    </div>
@endsection
