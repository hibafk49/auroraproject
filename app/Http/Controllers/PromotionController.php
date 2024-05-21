<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use Carbon\Carbon;
class PromotionController extends Controller
{
public function index()
{ $currentDate = Carbon::now();

    $promotions = Promotion::where('date_debut', '<=', $currentDate)
        ->where('date_fin', '>=', $currentDate)
        ->get();

    return view('promotions.index', ['promotions' => $promotions]);
}
}
