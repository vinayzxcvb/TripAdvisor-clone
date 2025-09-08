<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessMediaJob;
use App\Models\Listing;
use Illuminate\Http\Request;


class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new media file for a listing and queue it for processing.
     */
    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'media_file' => 'required|file|mimes:jpeg,png,jpg,mp4|max:20480', // 20MB Max
        ]);

        $path = $request->file('media_file')->store('media_uploads', 'public');
        $type = str_starts_with($request->file('media_file')->getMimeType(), 'video') ? 'video' : 'image';

        $media = $listing->media()->create([
            'user_id' => auth()->id(),
            'path' => $path,
            'type' => $type,
        ]);

        // Dispatch a job to handle thumbnail creation, watermarking, etc.
        ProcessMediaJob::dispatch($media);

        return back()->with('success', 'Your media has been uploaded and is being processed.');
    }
}