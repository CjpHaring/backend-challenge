<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "card";
    
    /**
     * @return string[]
     */
    protected $fillable = [
        'type',
        'number',
        'played',
        'hand_id',
    ];
    
    /**
     * @return BelongsTo
     */
    public function hand(): BelongsTo
    {
        return $this->belongsTo(Hand::class);
    }
}
