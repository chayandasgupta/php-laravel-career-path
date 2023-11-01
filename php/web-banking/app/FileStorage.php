<?php

declare(strict_types=1);

namespace App;

use App\StorageInterface;

class FileStorage implements StorageInterface
{
  public function save($model, $data): void
  {
    file_put_contents($this->getModelPath($model), serialize($data));
  }

  public function loadData($model = ''): array
  {
    $data = [];
    if (file_exists($this->getModelPath($model))) {
      $data = unserialize(file_get_contents($this->getModelPath($model)));
    }

    if (!is_array($data)) {
      return [];
    }

    return $data;
  }

  public function getModelPath($model)
  {
    return 'app/storage/' . $model . ".txt";
  }
}
