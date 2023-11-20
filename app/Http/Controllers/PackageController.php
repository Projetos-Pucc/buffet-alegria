<?php

namespace App\Http\Controllers;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\DTO\Packages\UpdatePackageImageDTO;
use App\Http\Requests\Packages\PackagesUpdateRequest;
use App\Services\PackageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use TypeError;

class PackageController extends Controller
{
    public function __construct(
        protected PackageService $service
        ){}

    public function update_image(Request $request) {
        if (isset($request->files)) {
            if(!$this->service->findBySlug($request->slug)){
                return redirect()->route('packages.not_found');
            }
            $this->service->updateImage(UpdatePackageImageDTO::makeFromRequest($request));
            return back();
        }
        $retornos = new MessageBag();
        $retornos->add('errors', 'Imagem não enviada');
        return back()->withErrors($retornos);
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
        $retornos = new MessageBag();
    
        try {
            $package = $this->service->findBySlug($request->slug);
            if($package) {
                $retornos->add('errors', 'Slug já existe');
                return back()->withErrors($retornos);
            }

            if(!isset($request->images) || count($request->images) != 3) {
                $retornos->add('errors', 'Não existem 3 fotos na requisição');
                return back()->withErrors($retornos);
            }
            $package = $this->service->create(CreatePackageDTO::makeFromRequest($request));

            return redirect()->route('packages.show', $package->slug);
        } catch (TypeError $e) {
            // Captura uma exceção de tipo (TypeError)
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        } catch (Exception $e) {
            // Captura outras exceções
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        }
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
        $retornos = new MessageBag();
    
        try {
            $package = $this->service->update(
                UpdatePackageDTO::makeFromRequest($request)
            );
            if(!$package){
                return redirect()->route('packages.not_found');
            }
    
            $package = $this->service->find($request->id);
    
            return redirect()->route('packages.show', $package->slug);
        } catch (TypeError $e) {
            // Captura uma exceção de tipo (TypeError)
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        } catch (Exception $e) {
            // Captura outras exceções
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        } catch (TypeError $e) {
            // Captura outras exceções
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        }
    }
}
