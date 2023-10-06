<?php

declare(strict_types=1);

namespace App;

interface StorageInterface
{
  public function save(string $model, array $data): void;

  public function loadData(string $model): array;

  public function getModelPath(string $model);
}
