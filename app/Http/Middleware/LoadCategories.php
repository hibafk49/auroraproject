<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Categorie;

class LoadCategories
{
    public function handle($request, Closure $next)
    {
        $categories = Categorie::all();
        view()->share('collections', $categories);
        return $next($request);
    }
}

