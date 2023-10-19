<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lot extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'lots';

    protected $guarded = false;

    public function category(){

        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class,  'lot_id', 'id');
    }
}
