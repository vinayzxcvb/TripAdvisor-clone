<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckListingType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string $type The required listing type (e.g., 'hotel', 'restaurant').
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        // Get the 'listing' model that's automatically resolved from the route
        $listing = $request->route('listing');

        // If the listing's type does not match the required type, abort.
        if (! $listing || $listing->type !== $type) {
            abort(404, 'The requested resource is not available for this listing type.');
        }

        return $next($request);
    }
}