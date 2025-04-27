<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PoliciesController extends Controller
{
    public function index() {
        return Inertia::render('NotFound');
    }
}
