<?php

namespace App\Http\Controllers;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\Http\Requests\Packages\PackagesUpdateRequest;
use App\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(
        protected PackageService $service
        ){}
    
    public function index()
    {
        $packages = $this->service->getAll();

        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function find(string $id)
    {
        if(!$package = $this->service->find($id)){
            return back();
        }

        return view('packages.show', compact('package'));
    }

    public function find_api(string $id)
    {
        if(!$package = $this->service->find($id)){
            return (object)[];
        }

        return response()->json($package);
    }

    public function store(PackagesUpdateRequest $request)
    {
        $this->service->create(CreatePackageDTO::makeFromRequest($request));

        return redirect()->route('packages.index');
    }
    public function delete(Request $request)
    {
        $this->service->delete($request->id);

        return redirect()->route('packages.index');
    }
    public function edit(Request $request)
    {
        if (!$package = $this->service->find($request->id)) {
            return back();
        }

        return view('packages.update', compact('package'));
    }

    public function update(PackagesUpdateRequest $request)
    {
        $package= $this->service->update(
            UpdatePackageDTO::makeFromRequest($request)
        );
        if(!$package){
            return back();
        }

        // $package= $this->service->update($request->only([
        //     'name_package', 'food_description', 'beverages_description', 'photo_1', 'photo_2', 'photo_3', 'slug'
        // ]));
        return redirect()->route('packages.index');
    }
}
