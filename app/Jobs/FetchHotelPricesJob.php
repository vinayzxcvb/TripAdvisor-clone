<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FetchHotelPricesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $listingId,
        public string $jobId
    ) {}

    public function handle(): void
    {
        // --- SIMULATION: In a real app, call booking APIs here ---
        $partnerA_price = rand(150, 200);
        $partnerB_price = rand(160, 210);
        $partnerC_price = rand(155, 195);
        // -----------------------------------------------------------
        
        $prices = [
            ['partner' => 'Booking.com', 'price' => $partnerA_price, 'link' => '#'],
            ['partner' => 'Expedia', 'price' => $partnerB_price, 'link' => '#'],
            ['partner' => 'Agoda', 'price' => $partnerC_price, 'link' => '#'],
        ];

        // Cache the results for 15 minutes
        $cacheKey = "prices.hotel.{$this->listingId}";
        Cache::put($cacheKey, $prices, now()->addMinutes(15));
    }
}