<?php

declare(strict_types=1);
require_once './models/TransactionModel.php';

class IncomeModel extends TransactionModel
{
  public function __construct()
  {
    $this->type = TransactionType::INCOME;
  }
}
