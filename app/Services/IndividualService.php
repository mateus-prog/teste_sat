<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

use App\Repositories\Elouquent\IndividualRepository;
use App\Traits\Pagination;

class IndividualService
{
    use Pagination;

    protected $individualRepository;
    public function __construct()
    {
        $this->individualRepository = new IndividualRepository();
    }

    public function all()
    {
        return $this->individualRepository->all();
    }

    public function store(array $request): Model
    {
        return $this->individualRepository->store($request);
    }

    public function findById(string $id): object
    {
        return $this->individualRepository->findById($id);
    }

    public function update(string $id, array $request): Model
    {
        return $this->individualRepository->update($id, $request);
    }

    public function destroy(string $id): bool
    {
        return $this->individualRepository->delete($id);
    }

}
