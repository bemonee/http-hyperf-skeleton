<?php


namespace App\Repository;

use App\Contracts\Repository\RepositoryInterface;
use App\Exception\Http\NotFoundHttpException;
use App\Model\Model;
use Hyperf\Database\Model\Collection;

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
        $model = $this->findModelOrThrowNotFoundException($id);

        return $model->update($data);
    }

    public function delete($id): bool
    {
        $model = $this->findModelOrThrowNotFoundException($id);

        return $model->destroy($id);
    }

    /** @inheritDoc */
    public function find($id): Model
    {
        return $this->findModelOrThrowNotFoundException($id);
    }

    private function findModelOrThrowNotFoundException($id): Model
    {
        $model = $this->model->find($id);

        if (null === $model) {
            throw new NotFoundHttpException($this->model, $id);
        }

        return $model;
    }
}
