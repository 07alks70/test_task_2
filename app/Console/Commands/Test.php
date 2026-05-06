<?php

namespace App\Console\Commands;

use App\Domains\Cars\Services\CarService\Interfaces\CarServiceInterface;
use Illuminate\Console\Command;

/**
 * @internal
 *
 * @coversNothing
 */
class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CarServiceInterface $carService): void
    {
        $carService->synchronization()
            ->syncCars()
        ;
    }
}
