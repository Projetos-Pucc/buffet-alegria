<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Package $package) {
        $packages = $package->all();

        return view('packages.index', compact('packages'));
    }

    public function create() {
        return view('packages.create');
    }

    public function find(string|int $id, Package $package) {
        $pk = $package->find($id);

        return view('packages.show', compact('pk'));
    }

    public function store(Request $request, Package $package) {
        $pk = $package->create($request->all());

        return redirect()->route('packages.index');
    }
    public function delete(Request $request, Package $package){
        $id = $request->only(['id']);
        $package->delete($id);

        return redirect()->route('packages.index');
        
    }
}
