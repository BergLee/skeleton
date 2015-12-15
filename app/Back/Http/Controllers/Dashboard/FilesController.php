<?php

namespace App\Back\Http\Controllers\Dashboard;

use App\Back\Http\Controllers\Controller;
use Baconfy\Analytics\Services\Visits\GetVisitByPeriod;
use Carbon\Carbon;

class FilesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('back::scope.dashboard.files');
    }
}
