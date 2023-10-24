<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bet extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'bets';

    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id', 'id');
    }

    public function getDateAsCarbonAttribute()
    {
        return Carbon::parse($this->created_at);
    }
}
