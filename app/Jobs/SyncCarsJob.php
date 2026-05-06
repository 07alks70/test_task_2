<?php

namespace App\Jobs;

use App\Domains\Cars\Services\CarService\Interfaces\CarServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncCarsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->queue = 'sync-queue';
    }

    /**
     * Execute the job.
     */
    public function handle(CarServiceInterface $carService): void
    {
        $carService->synchronization()
            ->syncCars()
        ;
    }
}
