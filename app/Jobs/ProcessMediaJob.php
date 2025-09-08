<?php

namespace App\Jobs;

use App\Models\Media;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessMediaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Media $media) {}

    public function handle(): void
    {
        // Example: Use a library like Intervention/Image to create thumbnails
        // 1. Get the path from storage: Storage::disk('public')->path($this->media->path)
        // 2. Process the image (resize, watermark, etc.)
        // 3. Save the new versions
        
        Log::info("Processing media file: {$this->media->path}");
        // Add actual image/video processing logic here.
    }
}