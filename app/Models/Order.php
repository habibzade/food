<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

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

            DB::beginTransaction();
            try {
                // Create Order
                Order::create([
                    'user_id' => Auth::user()->id,
                    'food_id' => $food->id
                ]);

                // Update Stock
                $food->decrement('stock');

                DB::commit();
                return true;

            } catch (\Exception $e) {
                DB::rollBack();
            }
        }

        return false;
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
