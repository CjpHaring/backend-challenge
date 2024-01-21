<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "player";

    /**
     * @return string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return string[]
     */
    protected $with = [
        'hand',
    ];

    /**
     * @return HasOne
     */
    public function hand(): HasOne
    {
        return $this->hasOne(Hand::class);
    }
}
