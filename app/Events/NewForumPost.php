<?php

namespace App\Events;

use App\Models\ForumPost;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewForumPost implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public ForumPost $post) {}

    /**
     * Get the channels the event should broadcast on.
     * We use a PrivateChannel to ensure only relevant users get the notification.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('forum-thread.' . $this->post->thread_id),
        ];
    }

    /**
     * The data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->post->id,
            'body' => $this->post->body,
            'user' => [
                'id' => $this->post->user->id,
                'name' => $this->post->user->name,
            ],
            'created_at' => $this->post->created_at->toIso8601String(),
        ];
    }
}