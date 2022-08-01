<?php

namespace App\Http\Controllers\Dashboard\LogViewer;

use Arcanedev\LogViewer\Contracts\LogViewer as LogViewerContract;
use Arcanedev\LogViewer\Http\Controllers\LogViewerController;

class LaravelLogController extends LogViewerController
{
    public function __construct(LogViewerContract $logViewer)
    {
        parent::__construct($logViewer);
    }
}
