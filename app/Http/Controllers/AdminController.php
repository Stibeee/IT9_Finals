<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Food;
use App\Models\Stock;
use App\Models\stockHistory;

class AdminController extends Controller
{
    public function add_coffee()
    {
        return view('admin.add_coffee');
    }

    public function upload_coffee(Request $request)
    {
        $data = new Coffee();
        $data->coffee_title = $request->coffee_title;
        $data->detail = $request->detail;
        $data->price = (float) $request->price;
        $data->availability = true;

        $image = $request->img;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $request->img->move('coffee_img', $filename);
        $data->image = $filename;

        $data->save();

        return redirect()->back();
    }

    public function view_coffee(Request $request)
    {
        $search = $request->input('search');
        $coffee = Coffee::when($search, function($query) use ($search) {
            return $query->where('coffee_title', 'like', '%'.$search.'%');
        })->get();

        return view('admin.show_coffee', compact('coffee', 'search'));
    }

    public function delete_coffee($id)
    {
        $coffee = Coffee::find($id);
        $coffee->delete();
        return redirect()->back();
    }

    public function update_coffee($id)
    {
        $coffee = Coffee::find($id);
        return view('admin.update_coffee', compact('coffee'));
    }

    public function edit_coffee(Request $request, $id)
    {
        $coffee = Coffee::find($id);
        $coffee->coffee_title = $request->coffee_title;
        $coffee->detail = $request->detail;
        $coffee->price = $request->price;

        $image = $request->img;
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->img->move('coffee_img', $filename);
            $coffee->image = $filename;
        }

        $coffee->save();
        return redirect('view_coffee');
    }

    public function transactionList()
    {
        $transactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.transactions', compact('transactions'));
    }

    public function availability_coffee()
    {
        $coffee = Coffee::select('id', 'coffee_title', 'detail', 'price', 'image', 'availability')
        ->orderBy('coffee_title')->get();

        return view('admin.availability_coffee', compact('coffee'));
    }

    public function toggle_coffee_availability($id)
{
    try {
        $coffee = Coffee::findOrFail($id);
        $coffee->availability = !$coffee->availability;
        $coffee->save();

        $status = $coffee->availability ? 'Available' : 'Not Available';
        return redirect()->back()->with('message', "Coffee status updated to: {$status}");
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update coffee availability. Please try again.');
    }
}

    public function add_food()
    {
        return view('admin.add_food');
    }

    public function upload_food(Request $request)
    {
        $data = new Food();
        $data->food_title = $request->food_title;
        $data->detail = $request->detail;
        $data->price = (float) $request->price;

        $image = $request->img;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $request->img->move('food_img', $filename);
        $data->image = $filename;

        $data->save();

        return redirect()->route('admin.view_food');
    }

    public function view_food(Request $request)
    {
        $search = $request->input('search');
        $food = Food::when($search, function($query) use ($search) {
            return $query->where('food_title', 'like', '%'.$search.'%');
        })->get();

        return view('admin.view_food', compact('food', 'search'));
    }

    public function delete_food($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('admin.view_food');
    }

    public function update_food($id)
    {
        $food = Food::find($id);
        return view('admin.update_food', compact('food'));
    }

    public function edit_food(Request $request, $id)
    {
        $food = Food::find($id);
        $food->food_title = $request->food_title;
        $food->detail = $request->detail;
        $food->price = $request->price;

        $image = $request->img;
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->img->move('food_img', $filename);
            $food->image = $filename;
        }

        $food->save();

        return redirect()->route('admin.view_food');
    }

    public function availability_food()
    {
        $food = Food::all();
        return view('admin.availability_food', compact('food'));
    }


    public function toggle_food_promo($id)
    {
        $food = Food::findOrFail($id);
        $food->is_promo = !$food->is_promo;
        $food->save();
        return redirect()->back()->with('message', 'Promo status updated!');
    }

    public function promo_food()
    {
        $food = Food::where('is_promo', true)->get();
        return view('admin.promo_food', compact('food'));
    }

    public function toggle_food_availability($id)
    {
        $food = Food::findOrFail($id);
        $food->availability = !$food->availability;
        $food->save();

        return redirect()->back()->with('message', 'Food availability updated!');
    }



    public function addStock()
    {
        return view('admin.add_stock');
    }

    public function viewStock(Request $request)
    {
        $search = $request->input('search');
        $stocks = Stock::when($search, function($query) use ($search) {
            return $query->where('ingredient_name', 'like', '%'.$search.'%');
        })->get();

        return view('admin.view_stock', compact('stocks', 'search'));
    }

    public function storeStock(Request $request)
    {
        $request->validate([
            'ingredient_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'minimum_stock' => 'required|numeric|min:0'
        ]);

        $stock = new Stock();
        $stock->ingredient_name = $request->ingredient_name;
        $stock->quantity = $request->quantity;
        $stock->unit = $request->unit;
        $stock->minimum_stock = $request->minimum_stock;
        $stock->save();

        // Record the stock addition in history
        $stockHistory = new StockHistory();
        $stockHistory->stock_id = $stock->id;
        $stockHistory->type = 'in';
        $stockHistory->quantity = $request->quantity;
        $stockHistory->previous_quantity = 0;
        $stockHistory->new_quantity = $request->quantity;
        $stockHistory->save();

        return redirect()->route('admin.view_stock')->with('message', 'Stock added successfully');
    }

    public function updateStock($id)
    {
        $stock = Stock::findOrFail($id);
        return view('admin.update_stock', compact('stock'));
    }

    public function editStock(Request $request, $id)
    {
        $request->validate([
            'ingredient_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'minimum_stock' => 'required|numeric|min:0'
        ]);

        $stock = Stock::findOrFail($id);
        $previousQuantity = $stock->quantity;

        $stock->ingredient_name = $request->ingredient_name;
        $stock->quantity = $request->quantity;
        $stock->unit = $request->unit;
        $stock->minimum_stock = $request->minimum_stock;
        $stock->save();

        // Record the stock update in history
        $stockHistory = new StockHistory();
        $stockHistory->stock_id = $stock->id;
        $stockHistory->type = $request->quantity > $previousQuantity ? 'in' : 'out';
        $stockHistory->quantity = abs($request->quantity - $previousQuantity);
        $stockHistory->previous_quantity = $previousQuantity;
        $stockHistory->new_quantity = $request->quantity;
        $stockHistory->save();

        return redirect()->route('admin.view_stock')->with('message', 'Stock updated successfully');
    }

    public function deleteStock($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('admin.view_stock')->with('message', 'Stock deleted successfully');
    }

    public function stockHistory()
    {
        $history = StockHistory::with('stock')->orderBy('created_at', 'desc')->get();
        return view('admin.stock_history', compact('history'));
    }


    public function stockUsageReport()
{
    $usageData = StockHistory::with('stock')
        ->selectRaw('stock_id,
            SUM(CASE WHEN type = "in" THEN quantity ELSE 0 END) as total_in,
            SUM(CASE WHEN type = "out" THEN quantity ELSE 0 END) as total_out')
        ->groupBy('stock_id')
        ->get();

    // Prepare data for chart
    $labels = $usageData->map(fn($d) => $d->stock->ingredient_name);
    $stockIn = $usageData->pluck('total_in');
    $stockOut = $usageData->pluck('total_out');
    $currentStock = $usageData->map(fn($d) => $d->stock->quantity);

    return view('admin.stock_usage_report', compact('usageData', 'labels', 'stockIn', 'stockOut', 'currentStock'));
}

    public function orders()
    {
        $orders = Order::all();
        return view('admin.order', compact('orders'));
    }


    public function on_the_way($id)
    {
        $orders = Order::find($id);
        $orders->delivery_status = 'On the Way';
        $orders->save();
        return redirect()->back();
    }


    public function delivered($id)
    {
        $orders = Order::find($id);
        $orders->delivery_status = 'Delivered';
        $orders->save();
        return redirect()->back();
    }

    public function canceled($id)
    {
        $orders = Order::find($id);
        $orders->delivery_status = 'Canceled';
        $orders->save();
        return redirect()->back();
    }


    public function sales()
    {
        // Get monthly sales data
        $monthlySales = Transaction::selectRaw('
            MONTH(created_at) as month,
            YEAR(created_at) as year,
            SUM(total_price) as total_sales,
            COUNT(*) as total_transactions
        ')
        ->groupBy('year', 'month')
        ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Format data for the chart
        $labels = $monthlySales->map(function ($sale) {
            return date('F Y', mktime(0, 0, 0, $sale->month, 1, $sale->year));
        });

        $data = $monthlySales->pluck('total_sales');

        // Calculate total revenue and transactions
        $totalRevenue = $monthlySales->sum('total_sales');
        $totalTransactions = $monthlySales->sum('total_transactions');

        return view('admin.sales', compact('labels', 'data', 'totalRevenue', 'totalTransactions'));
    }




}
