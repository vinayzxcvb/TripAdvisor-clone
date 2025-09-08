<?php

namespace App\Http\Controllers;

use App\Jobs\FetchHotelPricesJob;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class HotelPricingController extends Controller
{
    /**
     * Fetch prices for a given hotel (listing).
     * Checks cache first, otherwise dispatches a job.
     */
    public function getPrices(Request $request, Listing $listing)
    {
        // Ensure the listing is a hotel
        if ($listing->type !== 'hotel') {
            return response()->json(['error' => 'Not a hotel'], 400);
        }

        $cacheKey = "prices.hotel.{$listing->id}";

        // 1. Check for cached prices
        if (Cache::has($cacheKey)) {
            return response()->json([
                'status' => 'success',
                'prices' => Cache::get($cacheKey)
            ]);
        }
        
        // 2. Dispatch a job to fetch prices
        $jobId = (string) Str::uuid(); // Generate a unique ID for this job
        FetchHotelPricesJob::dispatch($listing->id, $jobId);

        // 3. Return a response indicating the job is processing
        return response()->json([
            'status' => 'processing',
            'job_id' => $jobId,
            'message' => 'Prices are being fetched. Please check back shortly.'
        ]);
    }
}