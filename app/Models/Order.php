<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    const FOOD_NOT_EXIST = 0;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'food_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    /**
     * @param $food_id
     * @return bool
     */
    public function register($food_id)
    {
        if ($food = Food::find($food_id)) {

            // Create Order
            return Order::create([
                'user_id' => Auth::user()->id,
                'food_id' => $food->id
            ]);
        }

        return false;
    }

    /**
     * @param $order
     * @return bool
     */
    public function confirm($order)
    {
        // Check stock is exist
        if ($food = Food::where(['id' => $order->food_id], ['stock', '>', 0])) {

            DB::beginTransaction();
            try {
                // Confirm order
                $this->confirmOrder($order);

                // Update Stock
                $food->decrement('stock');

                DB::commit();
                return true;

            } catch (\Exception $e) {
                DB::rollBack();
            }
        }

        return self::FOOD_NOT_EXIST;
    }

    /**
     * @param $order
     * @return mixed
     */
    private function confirmOrder($order)
    {
        $order->confirm = true;
        return $order->save();
    }

    /**
     * @param $type
     * @return int
     */
    public function calculationTimeToReady($type)
    {
        // Can be configurable
        $fixed_time = 20;

        switch ($type) {
            case 1:
                $type_time = 15;
                break;
            case 2:
                $type_time = 25;
                break;
            case 3:
                $type_time = 35;
                break;
            default:
                $type_time = 22;
        }

        return $fixed_time + $type_time;
    }

}
