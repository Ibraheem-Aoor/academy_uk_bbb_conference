<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'renewed_at',
    ];

    public function plan():BelongsTo
    {
        return $this->belongsTo(Plan::class , 'plan_id');
    }

    /**
     * Renews the plan history. If the renewed_at date is already set, a new history record is created.
     * Otherwise, the renewed_at date is updated and the current record is saved.
     *
     * @return void
     */
    public function renew() 
    {
        if(isset($this->renewed_at))
        {
            self::query()->create([
                'renewed_at' => now(),
                'plan_id' => $this->plan_id,
            ]);
            return;
        }

        $this->renewed_at = now();
        $this->save();
    }
}
