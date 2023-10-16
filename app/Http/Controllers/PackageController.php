<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.permission:operational|commercial', ['only'=>['create', 'index']]);
        $this->middleware('auth.permission:user', ['only'=>['update']]);
    }

    public function index() {
        dd('teste1');
    }

    public function create() {
        dd('teste2');
    }

    public function update() {
        dd('teste3');
    }
}
