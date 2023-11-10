<?php

namespace App\Repositories\Contract;

interface PaginationInterface {
    /**
     * Retorna os valores da paginação
     *
     * @return array
     */
    public function items(): array;
    /**
     * Retorna o total de valores da paginação
     *
     * @return int
     */
    public function total(): int;
    /**
     * Retorna o total de páginas
     *
     * @return int
     */
    public function totalPages(): int;
    /**
     * Diz se é a primeira pagina 
     *
     * @return bool
     */
    public function isFirstPage(): bool;
    /**
     * Diz se é a última pagina 
     *
     * @return bool
     */
    public function isLastPage(): bool;
    /**
     * Retorna a página atual
     *
     * @return int
     */
    public function currentPage(): int;
    /**
     * Retorna o número da próxima página
     *
     * @return int
     */
    public function getNumberNextPage(): int;
    /**
     * Retorna o número da página anteriour
     *
     * @return int
     */
    public function getNumberPreviousPage(): int;
    /**
     * Retorna a quantidades de itens por página
     *
     * @return int
     */
    public function itemsPerPage(): int;
    /**
     * Retorna qual o indice do primeiro elemento da página
     *
     * @return int
     */
    public function firstItemPage(): int;
    /**
     * Retorna qual o indice do último elemento da página
     *
     * @return int
     */
    public function lastItemPage(): int;
    public function paginationElements(): array;
}