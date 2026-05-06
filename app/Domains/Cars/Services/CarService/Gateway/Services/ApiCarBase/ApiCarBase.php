<?php

namespace App\Domains\Cars\Services\CarService\Gateway\Services\ApiCarBase;

use App\Domains\Cars\Services\CarService\Gateway\DataObjects\CarResponseDTO;
use App\Domains\Cars\Services\CarService\Gateway\Interfaces\GatewayCarInterface;
use App\Domains\Logger\Enums\LoggerTypeEnum;
use App\Domains\Logger\Services\LoggerService\LoggerServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\DataCollection;

class ApiCarBase implements GatewayCarInterface
{
    public function __construct(
        protected LoggerServiceInterface $loggerService,
    ) {
    }

    /**
     * @return Collection<int, CarResponseDTO>
     */
    public function getData(): Collection
    {
        $response = Http::withHeaders($this->getRequestHeaders())
            ->get($this->getApiEndpoint())
        ;

        if (!$response->successful()) {
            $this->loggerService
                ->writeLog(
                    json_encode(
                        [
                            'response' => $response->body(),
                            'http_code' => $response->status(),
                            'response_readers' => $response->headers(),
                            'request_header' => $this->getRequestHeaders(),
                        ],
                        JSON_UNESCAPED_UNICODE
                    ),
                    LoggerTypeEnum::SYNC_CARS_GET_REQUEST,
                )
            ;

            return new Collection();
        }

        $dataDecoded = json_decode($response->body(), true);

        if (!$dataDecoded) {
            $this->loggerService
                ->writeLog(
                    json_encode(
                        [
                            'response' => $response->body(),
                            'http_code' => $response->status(),
                            'response_readers' => $response->headers(),
                            'request_header' => $this->getRequestHeaders(),
                        ],
                        JSON_UNESCAPED_UNICODE
                    ),
                    LoggerTypeEnum::SYNC_CARS_INVALID_DATA,
                )
            ;

            return new Collection();
        }

        if (!isset($dataDecoded['data'])) {
            $this->loggerService
                ->writeLog(
                    json_encode(
                        [
                            'response' => $response->body(),
                            'http_code' => $response->status(),
                            'response_readers' => $response->headers(),
                            'request_header' => $this->getRequestHeaders(),
                        ],
                        JSON_UNESCAPED_UNICODE
                    ),
                    LoggerTypeEnum::SYNC_CARS_EMPTY_DATA,
                )
            ;

            return new Collection();
        }

        $dtoCollection = new DataCollection(CarResponseDTO::class, $dataDecoded['data']);

        /** @var Collection $collection */
        return $dtoCollection->toCollection();
    }

    private function getApiEndpoint(): ?string
    {
        // Вообще можно сделать сервис настроек с системой кэширования и вынести их в адмнку, но тк это тех. задание, то просто из config.
        return config('sync_car_gateway.api_url');
    }

    /**
     * @return string[]
     */
    private function getRequestHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
}
