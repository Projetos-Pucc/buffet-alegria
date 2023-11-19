<?php

namespace App\Http\Controllers;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\DTO\Packages\UpdatePackageImageDTO;
use App\Http\Requests\Packages\PackagesUpdateRequest;
use App\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(
        protected PackageService $service
        ){}

    public function update_image(Request $request) {
        if (isset($request->files)) {
            // $image_index = 1;
            // foreach ($request->files as $image) {
            //     $img_db = 'photo_' . $image_index;
            //     $image_index++;
            //     $dto->$img_db = $this->service->uploadImage($image);
            // }
        }
        dd(UpdatePackageImageDTO::makeFromRequest($request));
    }
    
    public function index(Request $request)
    {
        $packages = $this->service->paginate(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), filter: $request->filter);;

        return view('packages.index', compact('packages'));
    }

    public function not_found() {
        return view('packages.package-not-found');
    }

    public function create()
    {
        return view('packages.create');
    }

    public function find(string $slug)
    {
        if(!$package = $this->service->findBySlug($slug)){
            return redirect()->route('packages.not_found');
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
        $package = $this->service->create(CreatePackageDTO::makeFromRequest($request));

        return redirect()->route('packages.show', $package->slug);
    }
    public function change_status(Request $request)
    {
        if (!$package = $this->service->findBySlug($request->slug)) {
            return redirect()->route('packages.not_found');
        }

        $this->service->change_status($package->id);

        return redirect()->route('packages.index');
    }
    public function edit(Request $request, string $slug)
    {      
        if (!$package = $this->service->findBySlug($request->slug)) {
            return redirect()->route('packages.not_found');
        }

        return view('packages.update', compact('package'));
    }

    public function update(PackagesUpdateRequest $request)
    {
        $package = $this->service->update(
            UpdatePackageDTO::makeFromRequest($request)
        );
        if(!$package){
            return redirect()->route('packages.not_found');
        }

        $package = $this->service->find($request->id);

        return redirect()->route('packages.show', $package->slug);
    }
}
