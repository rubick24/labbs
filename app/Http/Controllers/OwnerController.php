<?php

namespace App\Http\Controllers;

use App\User;
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

    public function manageUser(){
        $users = User::paginate(10);
        return view('owner.manageUser',compact('users'));
    }
}
