<?php

namespace App\Contract\Repository;

use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\Collection;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;

interface RepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): Model;

    public function update(array $data, $id): int;

    public function delete($id): bool;

    /** @throws NotFoundHttpException */
    public function find($id): Model;
}
