<?php

declare(strict_types=1);

class Transaction implements ModelInterface
{
  private float $amount;
  protected string $user;
  protected TransactionType $type;

  public static function getModelName(): string
  {
    return 'transactions';
  }

  public function getAmount(): float
  {
    return $this->amount;
  }

  public function setAmount(float $amount): void
  {
    $this->amount = $amount;
  }

  public function setUser(string $user): void
  {
    $this->user = $user;
  }

  public function getUser(): string
  {
    return $this->user;
  }

  public function getType(): TransactionType
  {
    return $this->type;
  }
}
