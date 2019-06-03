<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightAlsoLike = Product::mightAlsoLike()->get();

        \Cart::condition($this->cartTax());

        $subTotal = \Cart::getSubTotal();

        $vatValue = \Cart::getCondition('VAT 13%')->getCalculatedValue($subTotal);

        $cartTotal = \Cart::getTotal();

//        dd(\Cart::getConditions());

        $cart = [
            'sub_total' => $this->nprFormat($subTotal),
            'vat_total' => $this->nprFormat($vatValue),
            'cart_total' => $this->nprFormat($cartTotal),
        ];


        return view('shop.cart', compact('mightAlsoLike', 'cart'));
    }

    public function cartTax()
    {
        $condition = new CartCondition(
            [
                'name' => 'VAT 13%',
                'type' => 'tax',
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => '13%',
                'attributes' =>
                    [// attributes field is optional
                        'description' => 'Value added tax',
                        'more_data' => 'more data here'
                    ]
            ]
        );

        return $condition;
    }

    public function cartShipping()
    {
        $condition = new CartCondition(
            [
                'name' => 'Express Shipping $15',
                'type' => 'shipping',
                'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => '+15',
                'order' => 1
            ]
        );

        return $condition;
    }

    public function nprFormat($val)
    {
        return money_format('Rs. %(#10n', $val / 100);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        \Cart::session(1);
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $request->image,
                'details' => $request->details,
                'slug' => $request->slug,
                'model' => Product::find($request->id)
            ]
        ]);
//        \Cart::add($request->id, $request->name, 1, $request->price);

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'quantity' => 'required|numeric|between:1,4'
        ]);

        if ($validator->fails()){
            session()->flash('errors', collect([
                'Quantities must be between 1 and 4'
            ]));
            return response()->json(['success' => false],400);
        }

        \Cart::update($id, ['quantity' => [
            'relative' => false,
            'value' => $request->get('quantity')
        ]]);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Cart::remove($id);
        return back()->with('success_message', 'Item has been removed');
    }

    public function saveforlater($id)
    {
        $item = \Cart::remove($id);

        $wishlist = \Cart::session("wishlist");

        $wishlist->add(1, "Name", 1.99, 1);


        dd(\Cart::getContent(), $wishlist->getContent());

    }
}
