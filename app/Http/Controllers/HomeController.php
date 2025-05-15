<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Coffee;

use App\Models\Order;

use App\Models\Food;

use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function my_home()
    {

        $coffee = Coffee::all();
        $food = Food::all();
        return view('home.index', compact('coffee', 'food'));


    }
    public function index()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                $coffee = Coffee::all();
                $food = Food::all();
                return view('home.index', compact('coffee', 'food'));
            } else {


                $total_user= User::where('usertype', '=','user')->count();

                $total_coffee= Coffee::count();


                return view('admin.index', compact('total_user', 'total_coffee'));
            }

        } else {
            return redirect()->route('login');
        }
    }


    public function add_cart(Request $request, $id, $type = 'coffee')
{
    if (Auth::id()) {
        $user = Auth::user();
        $type = $request->input('type', 'coffee');

        $item = $type === 'coffee' ? Coffee::find($id) : Food::find($id);
        $title_field = $type . '_title';

        if ($item) {

            if (!$item->availability) {
                return redirect()->back()->with('error', ucfirst($type) . ' "' . $item->$title_field . '" is currently not available.');
            }

            $cart = Cart::where($title_field, $item->$title_field)
                       ->where('user_id', $user->id)
                       ->when($type === 'coffee', function($query) {
                           return $query->whereNull('food_title');
                       })
                       ->when($type === 'food', function($query) {
                           return $query->whereNull('coffee_title');
                       })
                       ->first();

            if ($cart) {
                $cart->quantity += $request->qty;
                $cart->price = (float) Str::remove('$', $item->price) * $cart->quantity;
                $cart->save();

                return redirect()->back()->with('message', ucfirst($type) . ' quantity updated in cart!');
            } else {
                $cart = new Cart;
                $cart->$title_field = $item->$title_field;
                $cart->detail = $item->detail;
                $cart->price = (float) Str::remove('$', $item->price) * $request->qty;
                $cart->image = $item->image;
                $cart->quantity = $request->qty;
                $cart->user_id = $user->id;
                $cart->save();

                return redirect()->back()->with('message', ucfirst($type) . ' added to cart successfully!');
            }
        } else {
            return redirect()->back()->with('error', ucfirst($type) . ' not found!');
        }
    } else {
        return redirect('login');
    }
}

  public function my_cart()
    {
        $user_id = Auth::user()->id;
        $coffee = Cart::where('user_id', $user_id)->get();

        // Calculate the total price by summing the price field
        $total_price = $coffee->sum('price');

        return view('home.my_cart', compact('coffee', 'total_price'));
    }

public function remove_cart($id)
{
    $cart_item = Cart::find($id);
    if ($cart_item) {
        $item_type = $cart_item->coffee_title ? 'Coffee' : 'Food';
        $cart_item->delete();
        return redirect()->back()->with('message', $item_type . ' removed from cart successfully!');
    }
    return redirect()->back()->with('error', 'Item not found in cart!');
}




 public function confirm_order(Request $request)
{
    $request->validate([
        'coffee_id' => 'required|array',
        'coffee_title' => 'required|array',
        'quantity' => 'required|array',
        'price' => 'required|array',
        'image' => 'required|array',
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'address' => 'required|string',
    ]);

    $user = Auth::user();

    foreach ($request->coffee_id as $index => $coffee_id) {
        $order = new Order;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->title = $request->coffee_title[$index];
        $order->quantity = $request->quantity[$index];
        $order->price = $request->price[$index];
        $order->image = $request->image[$index];

        $order->save();

        // Remove the item from the cart
        Cart::where('id', $coffee_id)->delete();
    }

    return redirect()->back()->with('message', 'Order placed successfully!');

}

}
