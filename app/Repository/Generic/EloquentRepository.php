<?php

namespace App\Repository\Generic;

use App\Model\Generic\Model;
use Hyperf\Database\Model\Collection;
use App\Exception\Http\ConflictHttpException;
use App\Exception\Http\NotFoundHttpException;
use Hyperf\Database\Exception\QueryException;
use App\Contract\Repository\Generic\RepositoryInterface;

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

    /** @inheritDoc */
    public function create(array $data): Model
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new ConflictHttpException($this->model);
        }
    }

    /** @inheritDoc */
    public function update(array $data, $id): int
    {
        $model = $this->findModelOrThrowNotFoundException($id);

        return $model->update($data);
    }

    /** @inheritDoc */
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
