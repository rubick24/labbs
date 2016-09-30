<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    public function index(){
        return view('owner.index');
    }
}
