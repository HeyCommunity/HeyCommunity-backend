<?php

namespace App\Http\Controllers\Dashboard\LogViewer;

use Arcanedev\LogViewer\Contracts\LogViewer as LogViewerContract;
use Arcanedev\LogViewer\Http\Controllers\LogViewerController;

class HeyCommunityLogController extends LogViewerController
{
    public function __construct(LogViewerContract $logViewer)
    {
        parent::__construct($logViewer);

        $logViewer->setPath(storage_path('logs/heycommunity'));
        $logViewer->setPattern('hc-');
    }
}
