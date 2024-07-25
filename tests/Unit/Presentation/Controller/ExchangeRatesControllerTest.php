<?php

namespace Unit\Presentation\Controller;

use App\Exchange\Application\Service\CurrencyService;
use App\Exchange\Presentation\Controller\ExchangeRatesController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class ExchangeRatesControllerTest extends TestCase
{
    public function testInvalidDateFormat(): void
    {
        $currencyServiceMock = $this->createMock(CurrencyService::class);
        $serializerMock = $this->createMock(SerializerInterface::class);

        $controller = new ExchangeRatesController($currencyServiceMock, $serializerMock);

        $response = $controller->getExchangeRates('invalid-date');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('Invalid date format.', $response->getContent());
    }
}