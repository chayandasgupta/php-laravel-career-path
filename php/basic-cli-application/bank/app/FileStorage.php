<?php

declare(strict_types=1);

require_once '../app/StorageInterface.php';

class FileStorage implements StorageInterface
{
  public function save($model, $data): void
  {
    file_put_contents($this->getModelPath($model), serialize($data));
  }

  public function loadData($model = ''): array
  {
    return [];
  }

  public function getModelPath($model)
  {
    return 'storage/' . $model . ".txt";
  }
}
