<?php

namespace App\Services;

class CurrencyConverter
{
    protected $rates;

    public function __construct()
    {
        // Можно тянуть из API или кэша
        $this->rates = [
            'RUB' => 1,
            'USD' => 0.09,
            'EUR' => 0.01,

        ];
    }

    public function convert(float $amount, string $from, string $to): float
    {
        if ($from === $to) return $amount;

        $rubAmount = $amount / $this->rates[$from]; // Приводим к RUB

        return round($rubAmount * $this->rates[$to], 2);
    }

    public function convertPrefix(float $amount, string $currency)
    {
        return $this->currencyPrefix($currency).number_format($amount, 2, '.', ' ');
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
