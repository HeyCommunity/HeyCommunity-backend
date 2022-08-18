<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedResource;
use App\Models\Feed;

class FeedController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        $feeds = Feed::with('entity')->latest()->paginate();

        return FeedResource::collection($feeds);
    }
}
