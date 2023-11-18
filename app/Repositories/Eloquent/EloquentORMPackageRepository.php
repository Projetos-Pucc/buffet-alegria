<?php

namespace App\Repositories\Eloquent;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\DTO\Packages\UpdatePackageImageDTO;
use App\Models\Package;
use App\Repositories\Contract\PackageRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class EloquentORMPackageRepository implements PackageRepository
{
    public function __construct(
        protected Package $package
    ) {
    }

    public function getAll(string $filter = null): array
    {
        return $this->package
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('name_package', 'like', "%{$filter}%");
                    $query->orWhere('food_description', 'like', "%{$filter}%");
                    $query->orWhere('beverages_description', 'like', "%{$filter}%");
                    $query->orWhere('status', 'like', "%{$filter}%");
                    $query->orWhere('slug', $filter);
                }
            })
            ->get()->toArray();
    }

    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator {
        return $this->package
        ->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('name_package', 'like', "%{$filter}%");
                $query->orWhere('food_description', 'like', "%{$filter}%");
                $query->orWhere('beverages_description', 'like', "%{$filter}%");
                $query->orWhere('status', 'like', "%{$filter}%");
                $query->orWhere('slug', $filter);
            }
        })->paginate($totalPerPage, ['*'], 'page', $page);
    }

    public function getAllByStatus(bool $status = true): array {
        return $this->package
            ->where('status', $status)->get()->toArray();
    }

    public function findOneById(string $id): stdClass|null
    {
        $package = $this->package->find($id);
        if (!$package) {
            return null;
        }
        return (object) $package->toArray();
    }
    public function findOneBySlug(string $slug): ?stdClass
    {
        $package = $this->package->where('slug', $slug)->get()->first();
        if (!$package) {
            return null;
        }
        return (object) $package->toArray();
    }

    public function delete(string $id): bool|null
    {
        if (!$package = $this->findOneById($id)) {
            return null;
        }
        return $this->package->where('id', $id)->update(['status'=>false]);
        // $this->package->destroy($id);
    }

    public function create(CreatePackageDTO $dto): stdClass
    {
        $package = $this->package->create((array)$dto);
        return (object)$package->toArray();
    }

    public function update(UpdatePackageDTO $dto): bool|null
    {
        if (!$package = $this->package->find($dto->id)) {
            return null;
        }
        return $package->update((array)$dto);
    }

    public function updateImage(UpdatePackageImageDTO $dto): stdClass|null
    {
        if (!$package = $this->package->find($dto->id)) {
            return null;
        }
        return $package->update((array)$dto);
    }

    public function findOne(...$filters): stdClass|null
    {
        $package = $this->package->get()->where(...$filters)->first();
        if (!$package) {
            return null;
        }
        return (object) $package->toArray();
    }
}
