<?php

namespace App\Contract\Repository\Generic;

use App\Model\Generic\Model;
use Hyperf\Database\Model\Collection;
use App\Contract\Exception\ConflictException;
use App\Contract\Exception\NotFoundException;

interface RepositoryInterface
{
    public function all(): Collection;

    /** @throws ConflictException */
    public function create(array $data): Model;

    /** @throws NotFoundException */
    public function update($id, array $data): int;

    /** @throws NotFoundException */
    public function delete($id): bool;

    /** @throws NotFoundException */
    public function find($id): Model;
}
