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

                <form action="{{route('checkout.store')}}" class="mt-4" id="payment-form" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control" name="email">
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>

                    <div class="form-row form-group">
                        <div class="col">
                            <label for="">City</label>
                            <input type="text" class="form-control" name="city">
                        </div>
                        <div class="col">
                            <label for="">Province</label>
                            <input type="text" class="form-control" name="state">
                        </div>
                    </div>

                    <div class="form-row form-group">
                        <div class="col">
                            <label for="">Postal Code</label>
                            <input type="text" class="form-control" name="zipcode">
                        </div>
                        <div class="col">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                    </div>


                    <h4 class="mt-5 mb-3">Payment Details</h4>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name_on_card">
                    </div>

                    <div class="form-group">
                        <label for="card-element">
                            Credit Card Details
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-success" >Complete Order</button>
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

@section('top-script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('script')

    <script>
        // Create a Stripe client.
        var stripe = Stripe('sk_test_j1JvtJnBYfMnFIKJvtweoUWq00xU06iM4H');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            alert('hello');
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection

@section('top-css')
    <style>
        /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid gray;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection
