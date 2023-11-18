<?php

namespace App\Repositories\Contract;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

interface BookingRepository {
    /**
     * Get All Bookings.
     *
     * Esta função retorna todas as reservas criadas.
     *
     * @param string $filter Um filtro para as requisições.
     * @return array Retorna um conjunto de reservas.
     */
    public function getAll(string $filter = null): array;
    /**
     * Paginate Bookings.
     *
     * Esta função retorna todas as reservas criadas no formato de paginação.
     *
     * @param int $page Determina a página de visualização.
     * @param int $totalPerPage Determina quantos valores aparecem por página.
     * @param string $filter Um filtro para as requisições.
     * @return LengthAwarePaginator Retorna um conjunto de reservas no formato de paginação.
     */
    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    /**
     * Paginate Bookings.
     *
     * Esta função retorna todas as reservas criadas no formato de paginação.
     *
     * @param $id ID da reserva 
     * @return array Retorna um array com os guests de determinada reserva
     */
    public function getGuestsByBookingId(int $id): array;
    /**
     * Paginate Guests by Booking ID.
     *
     * Esta função retorna os convidados com base na reserva.
     *
     * OBS.: Esta função em algum momento será substituida pela paginate.
     *
     * @param int $id Qual ID da reserva.
     * @param int $page Determina a página de visualização.
     * @param int $totalPerPage Determina quantos valores aparecem por página.
     * @return LengthAwarePaginator Retorna um conjunto de reservas no formato de paginação.
     */
    public function getGuestsByBookingIdPaginate(int $id, int $page = 1, int $totalPerPage = 15): LengthAwarePaginator;
    /**
     * Paginate Bookings by Status.
     *
     * Esta função retorna as próximas reservas de ordem crescente a partir do dia de hoje com base no status.
     *
     * OBS.: Esta função em algum momento será substituida pela paginate.
     *
     * @param BookingStatus $status Determina o status que será buscado.
     * @param int $page Determina a página de visualização.
     * @param int $totalPerPage Determina quantos valores aparecem por página.
     * @param string $filter Um filtro para as requisições.
     * @return LengthAwarePaginator Retorna um conjunto de reservas no formato de paginação.
     */
    public function paginate_bookings_by_status(BookingStatus $status, int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    /**
     * Find Booking By Id.
     *
     * Esta função retorna uma reserva com base no ID da reserva.
     * 
     * OBS.: Esta função será substituida em algum momento pela findOne
     *
     * @param string $id Qual ID da reserva.
     * @return stdClass|null Retorna um stdClass caso exista, ou null caso não exista
     */
    public function findOneById(string $id): stdClass|null;
    /**
     * Find Booking By User Id.
     *
     * Esta função retorna uma reserva com base no ID do usuário que cadastrou.
     * 
     * OBS.: Esta função será substituida em algum momento pela findOne
     *
     * @param string $id Qual ID do usuário que será buscado.
     * @return stdClass|null Retorna um stdClass caso exista, ou null caso não exista
     */
    public function findByUser(int $userId): array;
    /**
     * Find Booking By User Id.
     *
     * Esta função retorna todas as reservas com base no ID do usuário que cadastrou no formato paginação.
     * 
     * OBS.: Esta função será substituida em algum momento pela paginate
     *
     * @param string $userId Qual ID do usuário que será buscado.
     * @return array Retorna um array de reservas
     */
    public function findByUserPaginate(int $userId, int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    /**
     * Find One Booking.
     *
     * Esta função retorna os valores de uma reserva com base em um filtro.
     * 
     * @param string ...$filters Filtros que serão buscados.
     * @return LengthAwarePaginator Retorna um conjunto de reservas no formato de paginação
     */
    public function findOne(...$filters): stdClass|null;
    /**
     * Delete Booking.
     *
     * Esta função altera o status de uma reserva para cancelado.
     * 
     * @param string $id Qual ID da reserva que será cancelado.
     * @return stdClass|null Retorna um stdClass caso exista, ou null caso não exista
     */
    public function delete(string $id): bool|null;
    /**
     * Create Booking.
     *
     * Esta função cria uma reserva.
     * 
     * @param CreateBookingDTO $dto Valores que serão inseridos no banco de dados.
     * @return bool|null Retorna um bool caso exista e tenha atualizado, e null caso não exista ou ocorra um erro
     */
    public function create(CreateBookingDTO $dto): stdClass;
    /**
     * Update Booking.
     *
     * Esta função cria uma reserva.
     * 
     * @param UpdateBookingDTO $dto Valores que serão atualizados no banco de dados.
     * @return stdClass Retorna um stdClass com os valores da reserva
     */
    public function update(UpdateBookingDTO $dto): bool|null;
    /**
     * Change Booking Status.
     *
     * Esta função atualiza o status de uma reserva.
     * 
     * @param string $id ID da reserva que será atualizada.
     * @param BookingStatus $status Valor ENUM do próximo status.
     * @return bool|null Retorna um bool caso exista e tenha atualizado, e null caso não exista ou ocorra um erro
     */
    public function changeStatus(string $id, BookingStatus $status):bool|null;
}