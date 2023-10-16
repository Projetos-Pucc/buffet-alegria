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

    public function find(string|int $id, Package $pk) {
        $package = $pk->find($id);


        return view('packages.show', compact('package'));
    }

    public function store(Request $request, Package $package) {
        $package->create($request->all());

        return redirect()->route('packages.index');
    }
    public function delete(Request $request, Package $package){
        $package->delete($request->id);

        return redirect()->route('packages.index');
        
    }
    public function edit(Request $request, Package $pk) {
        if(!$package = $pk->find($request->id)){
            return back();
        }

        return view('packages.update', compact('package'));
    }

    public function update(Request $request, Package $pk){
        if(!$package = $pk->find($request->id)){
            return back();
        }
        
        $package->update($request->only([
            'name_package','food_description','beverages_description','photo_1','photo_2','photo_3','slug'
        ]));
        return redirect()->route('packages.index');

    }
}
