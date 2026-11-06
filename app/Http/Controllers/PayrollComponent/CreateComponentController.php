<?php

namespace App\Http\Controllers\PayrollComponent;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CreateComponentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        return view('components.create');
    }
}
