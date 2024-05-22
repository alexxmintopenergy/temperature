<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemperatureHistoryController extends Controller
{
    public function index()
    {
        return view('temperature.history');
    }
}
