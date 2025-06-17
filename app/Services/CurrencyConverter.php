<?php

namespace App\Services;

class CurrencyConverter
{
    protected $rates;

    public function __construct()
    {
        // Можно тянуть из API или кэша
        $this->rates = [
            'USD' => 1,
            'EUR' => 0,86,
            'KZT' => 512,55,
            'RUB' => 78,70
        ];
    }

    public function convert(float $amount, string $from, string $to): float
    {
        if ($from === $to) return $amount;

        $usdAmount = $amount / $this->rates[$from]; // Приводим к USD
        return round($usdAmount * $this->rates[$to], 2);
    }

    public function convertPrefix(float $amount, string $currency)
    {
        return $this->currencyPrefix($currency).' '. number_format($amount, 2, '.', ' ');
    }

    protected function currencyPrefix(string $currency): string
    {
        return match ($currency) {
            'USD' => '$',
            'EUR' => '€',
            'KZT' => '₸',
            'RUB' => '₽',
            default => '',
        };
    }
}
