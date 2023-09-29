<?php

declare(strict_types=1);
require_once '../app/models/Transaction.php';

class Withdraw extends Transaction
{
  public function __construct()
  {
    $this->type = TransactionType::WITHDRAW;
  }
}
