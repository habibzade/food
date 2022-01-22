<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterOrderRequest;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;

    /**
     * OrderController constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $food_id = $request->get('food_id');
        $food = Food::find($food_id);

        $time_to_ready = $this->order->calculationTimeToReady($food->type_id);

        return view('order.create', compact('food', 'time_to_ready'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterOrderRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(RegisterOrderRequest $request)
    {
        $food_id = $request->get('food_id');

        if ($user = $this->order->register($food_id)) {
            return redirect()->route('home')->withSuccess('Order registered successfully.');
        }

        return back()->withErrors('Internal error. Please try later.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function history(Request $request)
    {
        $orders = Order::where('food_id', $request->food_id)->get();

        return view('order.history', compact('orders'));
    }
}
