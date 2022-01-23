<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @param $type_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function foods($type_id)
    {
        $query = Food::query();

        if ($type_id) {
            $query = $query->where('type_id', $type_id);
        }

        return $query->get();
    }
}
