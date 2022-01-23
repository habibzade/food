<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Type;

class FoodController extends Controller
{
    // All type of foods
    const ALL_TYPE = 0;

    /**
     * @var Food
     */
    private $food;

    /**
     * FoodController constructor.
     * @param Food $food
     */
    public function __construct(Food $food)
    {
        $this->food = $food;
    }

    /**
     * Display a listing of the resource.
     *
     * @param integer $type_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($type_id = self::ALL_TYPE)
    {
        $foods = $this->food->foods($type_id);
        $types = Type::all();

        return view('food.index', compact('foods', 'types', 'type_id'));
    }
}
