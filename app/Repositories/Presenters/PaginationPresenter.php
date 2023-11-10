<?php

namespace App\Repositories\Presenters;

use App\Repositories\Contract\PaginationInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class PaginationPresenter implements PaginationInterface {
    /**
     *
     * @var stdClass[]
     */
    private array $items;
    public function __construct(
        protected LengthAwarePaginator $paginator
    ) {
        $this->items = $this->resolveItems($this->paginator->items());
    }
    public function items(): array {
        return $this->items;
    }
    public function total(): int {
        return $this->paginator->total() ?? 0;
    }
    public function totalPages(): int {
        if($this->paginator->count() === 0) return 0;
        return round($this->paginator->total() / $this->paginator->count());
    }
    public function isFirstPage(): bool {
        return $this->paginator->onFirstPage();
    }
    public function isLastPage(): bool {
        return $this->paginator->currentPage() === $this->paginator->lastPage();
    }
    public function currentPage(): int {
        return $this->paginator->currentPage() ?? 1;
    }
    public function getNumberNextPage(): int {
        return $this->paginator->currentPage() + 1;
    }
    public function getNumberPreviousPage(): int {
        return $this->paginator->currentPage() - 1;
    }
    public function itemsPerPage(): int {
        return $this->paginator->count() ?? 0;
    }
    public function firstItemPage(): int {
        return $this->paginator->firstItem() ?? 0;
    }
    public function lastItemPage(): int {
        return $this->paginator->lastItem() ?? 0;
    }
    public function paginationElements(): array {
        $currentPage = $this->currentPage();
        $totalPages = $this->totalPages();

        $paginationElements = [];

        // Adiciona "três pontos" se houver mais de uma página
        if ($totalPages > 1) {
            $paginationElements[] = '...';
        }

        // Adiciona os números das páginas
        for ($page = 1; $page <= $totalPages; $page++) {
            if ($page == $currentPage) {
                $paginationElements[] = $page; // Página atual
            } else {
                $paginationElements[] = $page; // Link para a página
            }
        }

        // Adiciona "três pontos" se houver mais de uma página
        if ($totalPages > 1) {
            $paginationElements[] = '...';
        }

        return $paginationElements;
    }


    private function resolveItems(array $items): array
    {
        $response = [];
        foreach ($items as $item) {
            $stdClassObject = new stdClass;
            foreach ($item->toArray() as $key => $value) {
                $stdClassObject->{$key} = $value;
            }
            array_push($response, $stdClassObject);
        }
        return $response;
    }

}