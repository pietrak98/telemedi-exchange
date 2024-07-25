<?php
namespace App\Exchange\Domain\Service;

class ExchangeRateCalculator
{
    private array $rateAdjustments;

    public function __construct(array $rateAdjustments)
    {
        $this->rateAdjustments = $rateAdjustments;
    }

    public function calculateBuyRate(string $currency, float $nbpRate): ?float
    {
        if (isset($this->rateAdjustments[$currency]['buy'])) {
            return $nbpRate + $this->rateAdjustments[$currency]['buy'];
        }
        return null;
    }

    public function calculateSellRate(string $currency, float $nbpRate): float
    {
        if (isset($this->rateAdjustments[$currency]['sell'])) {
            return $nbpRate + $this->rateAdjustments[$currency]['sell'];
        }
        return $nbpRate + $this->rateAdjustments['default']['sell'];
    }
}
