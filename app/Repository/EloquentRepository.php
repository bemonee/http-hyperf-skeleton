<?php


namespace App\Repository;

use App\Contracts\Repository\RepositoryInterface;
use App\Exception\BusinessException;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;

abstract class EloquentRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id): int
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }

    public function find($id): Model
    {
        $model = $this->model->find($id);

        if (null === $model) {
            throw new BusinessException(get_class($this->model). " with id $id not found");
        }

        return $model;
    }
}
