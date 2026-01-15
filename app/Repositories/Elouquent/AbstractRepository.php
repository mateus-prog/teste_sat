<?php

namespace App\Repositories\Elouquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function all(string $orderBy = '', string $orderDirection = '', int $limit = 0): object
    {
        return $this->model
                ->when(!empty($orderBy) && !empty($orderDirection), function ($query) use ($orderBy, $orderDirection) {
                    return $query->orderBy($orderBy, $orderDirection);
                })
                ->when($limit > 0, function ($query) use ($limit) {
                    return $query->limit($limit);
                })
                ->get();
    }

    public function store(array $request): Model
    {
        return $this->model->create($request);
    }

    public function findById(string $id): object
    {
        return $this->model->findOrFail($id);
    }

    public function update(string $id, array $data): Model
    {
        
        $object = $this->findById($id);
        if (!empty($data)) {
            $object->update($data);
        }
    
        return $object->refresh();
    }

    public function updateOrCreate(array $attributes, array $data): Model
    {
        return $this->model->updateOrCreate($attributes, $data)->refresh();
    }

    public function delete(string $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }
}
