<?php

namespace App\Http\Controllers;

use App\Http\Requests\Packages\PackagesUpdateRequest;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Package $package)
    {
        $packages = $package->all();

        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function find(string|int $id, Package $pk)
    {
        $package = $pk->find($id);


        return view('packages.show', compact('package'));
    }

    public function store(PackagesUpdateRequest $request, Package $package)
    {

        // $request->validate([
        //     'images' => 'required',
        //     'images.*' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        // ]);
        // ^^ fazer acima com o StorePackageRequest $request


        // $file = $request->file('images');
        // dd($file);
        // $extension = $file->getClientOriginalExtension();
        // dd($file, $extension);
        $images = [];
        if ($request->has('images')) {
            if (count($request->images) !== 3) {
                return redirect()->route('packages.index');
            }
            $image_index = 1;
            foreach ($request->images as $key => $image) {
                $imageName = time() . rand(1, 99) . '.' . $image->extension();
                $image->move(storage_path('images'), $imageName);

                $img_db = "photo_" . $image_index;
                $image_index++;
                $request->merge([$img_db => $imageName]);
            }
        }
        $data = $request->except('images');
        $package->create($data);

        return redirect()->route('packages.index');
    }
    public function delete(Request $request, Package $package)
    {
        $package->delete($request->id);

        return redirect()->route('packages.index');
    }
    public function edit(Request $request, Package $pk)
    {
        if (!$package = $pk->find($request->id)) {
            return back();
        }

        return view('packages.update', compact('package'));
    }

    public function update(Request $request, Package $pk)
    {
        if (!$package = $pk->find($request->id)) {
            return back();
        }

        $package->update($request->only([
            'name_package', 'food_description', 'beverages_description', 'photo_1', 'photo_2', 'photo_3', 'slug'
        ]));
        return redirect()->route('packages.index');
    }
}
