<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Coffee;

use App\Models\Order;

use App\Models\Food;

use App\Models\Cart;

use App\Models\Transaction;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        // Share coffee data with all views that need it
        View::composer([
            'home.blog',
            'home.index',
            'dashboard',
            'admin.availability_coffee',
            'admin.show_coffee',
            'admin.toggle_coffee',
            'admin.update_coffee'
        ], function ($view) {
            $view->with('coffee', Coffee::all());
        });
    }

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
                $total_user = User::where('usertype', '=', 'user')->count();
                $total_coffee = Coffee::count();
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
    
    // Get all cart items for the user
    $cart_items = Cart::where('user_id', $user_id)
        ->select('id', 'coffee_title', 'food_title', 'detail', 'price', 'image', 'quantity', 'user_id')
        ->get();

    // Calculate total price
    $total_price = $cart_items->sum(function ($item) {
        return $item->price;
    });

    return view('home.my_cart', compact('cart_items', 'total_price'));
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
    $user = Auth::user(); 
        $cartItems = Cart::where('user_id', $user->id)->get();
        $totalAmount = 0;
        
        // Create transactions for each cart item
        foreach ($cartItems as $item) {
            $unitPrice = $item->price / $item->quantity;
            Transaction::create([
                'product_name' => $item->coffee_title ?? $item->food_title,
                'quantity' => $item->quantity,
                'price' => $unitPrice,
                'total_price' => $item->price,
                'user_id' => $user->id
            ]);
            $totalAmount += $item->price;
        }
        
        // Store cart items in session for payment
        session(['cart_items' => $cartItems]);
        session(['customer_info' => [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]]);

        // Store total amount in session
        session(['order_total' => $totalAmount]);

        // Redirect to payment page
        return redirect()->route('payment.form');
}

    public function my_orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        $cart_items = Cart::where('user_id', $user->id)->get();
        return view('home.my_orders', compact('orders', 'cart_items'));
    }
}
