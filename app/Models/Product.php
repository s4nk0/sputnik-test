<?php

namespace App\Models;

use App\Services\CurrencyConverter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'price'
    ];

    protected $casts = [
        'price'=>'array'
    ];

    public function getConvertedPrice(string $targetCurrency): float
    {
        $converter = app(CurrencyConverter::class);
        return $converter->convert((float)$this->price['amount'], $this->price['currency'], $targetCurrency);
    }

    public function getConvertedPricePrefix(string $targetCurrency)
    {
        $converter = app(CurrencyConverter::class);

        return $converter->convertPrefix($this->getConvertedPrice($targetCurrency), $targetCurrency);
    }
}
