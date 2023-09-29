<?php

declare(strict_types=1);
require_once '../app/models/Transaction.php';

class Deposit extends Transaction
{
  public function __construct()
  {
    $this->type = TransactionType::DEPOSIT;
  }
}
