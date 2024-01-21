<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hand extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "hand";

    /**
     * @return string[]
     */
    protected $fillable = [
        'player_id',
    ];

    /**
     * @return string[]
     */
    protected $with = [
        'cards',
    ];

    /**
     * @return BelongsTo
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return HasMany
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
