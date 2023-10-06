<?php

declare(strict_types=1);
// require_once '../app/models/Transaction.php';
namespace App\models;

use App\models\Transaction;
use App\TransactionType;

class Deposit extends Transaction
{
  public function __construct()
  {
    $this->type = TransactionType::DEPOSIT;
  }
}