<?php

declare(strict_types=1);

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
    public function update($id, array $data): bool
    {
        $model = $this->findModelOrThrowNotFoundException($id);

        try {
            return $model->update($data);
        } catch (QueryException $e) {
            throw new ConflictHttpException($this->model);
        }
    }

    /** @inheritDoc */
    public function delete($id): bool
    {
        $model = $this->findModelOrThrowNotFoundException($id);

        return (bool) $model->destroy($id);
    }

    /** @inheritDoc */
    public function find($id): Model
    {
        return $this->findModelOrThrowNotFoundException($id);
    }

    private function findModelOrThrowNotFoundException($id): Model
    {
        $model = $this->model->findFromCache($id);

        if (null === $model) {
            throw new NotFoundHttpException($this->model, $id);
        }

        return $model;
    }
}
