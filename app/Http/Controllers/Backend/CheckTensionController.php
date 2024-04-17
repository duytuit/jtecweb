<?php

namespace App\Http\Controllers\Backend;

use App\Models\CheckTension;
// use App\Imports\CheckTensionImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckTensionController extends Controller
{
    public $user;

    public function __construct()
    {
        // dd(1);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        // dd(123);
        $checkTension = CheckTension::all();
        return view('backend.pages.checkTension.index', compact('checkTension'));
    }
    public function view()
    {
        // dd(123);
        $checkTension = CheckTension::all();
        return view('backend.pages.checkTension.view', compact('checkTension'));
    }
}
