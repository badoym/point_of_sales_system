<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $usertype = Auth::user()->usertype;

        return match ($usertype) {
            'admin'   => redirect()->route('admin.dashboard.index'),
            'cashier'    => redirect()->route('cashier.checkout.index'),
            default   => redirect()->route('login')->with('error', 'Unauthorized access'),
        };
    }
}
