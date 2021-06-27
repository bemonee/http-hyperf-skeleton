<?php

namespace App\Contract\Repository\Generic;

use App\Model\Generic\Model;
use Hyperf\Database\Model\Collection;
use App\Exception\Http\ConflictHttpException;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;

interface RepositoryInterface
{
    public function all(): Collection;

    /** @throws ConflictHttpException */
    public function create(array $data): Model;

    /** @throws NotFoundHttpException */
    public function update(array $data, $id): int;

    /** @throws NotFoundHttpException */
    public function delete($id): bool;

    /** @throws NotFoundHttpException */
    public function find($id): Model;
}
