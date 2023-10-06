<?php

namespace App\Controllers;

use App\StorageInterface;
use App\models\Transaction;
use App\models\User;
use App\models\Deposit;
use App\models\Withdraw;
use App\UserType;
use App\TransactionType;

class FinanceManager
{
  private StorageInterface $storage;
  private string $user;
  private array $transactions;
  private array $users;

  public function __construct(StorageInterface $storage, string $user = '')
  {
    $this->storage = $storage;
    $this->user    = $user;
    $this->transactions = $this->storage->loadData(Transaction::getModelName());
    $this->users        = $this->storage->loadData(User::getModelName());
  }

  public function showTransactions(string $customerEmail = null): void
  {
    printf("Transaction Lists\n");
    printf("----------------------------------\n");
    if ($customerEmail) {
      foreach ($this->transactions as $transaction) {
        if ($transaction->getUser() === $customerEmail) {
          printf("Amount: %.2f, TransactionType: %s\n\n", $transaction->getAmount(), $transaction->getType()->name);
        }
      }
    } else {
      foreach ($this->transactions as $transaction) {
        if ($transaction->getUser() === $this->user) {
          printf("Amount: %.2f, TransactionType: %s\n\n", $transaction->getAmount(), $transaction->getType()->name);
        }
      }
    }
  }

  public function showAllTransactions(): void
  {
    printf("Transaction Lists\n");
    printf("----------------------------------\n");
    foreach ($this->transactions as $transaction) {
      printf("Amount: %.2f, User: %s, TransactionType: %s\n\n", $transaction->getAmount(), $transaction->getUser(), $transaction->getType()->name);
    }
  }

  public function showAllCustomers(): void
  {
    printf("Customers Lists\n");
    printf("----------------------------------\n");
    foreach ($this->users as $user) {
      if ($user->getType() === UserType::CUSTOMER) {
        printf("Name: %s, Email: %s\n\n", $user->getName(), $user->getEmail());
      }
    }
  }

  public function depositMoney(float $amount, string $user)
  {
    $deposit = new Deposit();
    $deposit->setAmount($amount);
    $deposit->setUser($user);

    $this->transactions[] = $deposit;
    $this->saveTrsansaction();
  }

  public function withdrawMoney(float $amount)
  {
    $currentBalance = $this->showCurrentBalance();
    if ($currentBalance == 0 || $currentBalance < $amount) {
      return [
        "status"     => "error",
        "message"    => "Insufficient funds. Please try again!",
      ];
    }

    $withdraw = new Withdraw();
    $withdraw->setAmount($amount);
    $withdraw->setUser($this->user);

    $this->transactions[] = $withdraw;

    $this->saveTrsansaction();
  }

  public function showCurrentBalance()
  {
    $totalDeposit   = 0;
    $totalWithdraw  = 0;
    $currentBalance = 0;

    foreach ($this->transactions as $transaction) {
      if ($transaction->getUser() === $this->user) {
        if ($transaction->getType() === TransactionType::DEPOSIT) {
          $totalDeposit   += $transaction->getAmount();
          $currentBalance += $transaction->getAmount();
        } else {
          $totalWithdraw  += $transaction->getAmount();
          $currentBalance -= $transaction->getAmount();
        }
      }
    }

    return $currentBalance;
  }

  public function transferAmount(string $recipentUser, float $transferAmount)
  {
    if (!is_numeric($transferAmount)) {
      return [
        "status"     => "error",
        "message"    => "Transfer amount must be a number\n",
      ];
    }

    if ($transferAmount <= 0) {
      return [
        "status"     => "error",
        "message"    => "Amount must be a positive number.\n",
      ];
    }

    if ($this->user === $recipentUser) {
      return [
        "status"     => "error",
        "message"    => "You can't transfer amount in own account.\n",
      ];
    }

    $recipentUserFound = false;
    foreach ($this->users as $user) {
      if ($user->getEmail() === $recipentUser) {
        $recipentUserFound = true;
        break;
      }
    }
    if (!$recipentUserFound) {
      return [
        "status"     => "error",
        "message"    => "Recipients user not found\n",
      ];
    }

    $currentBalance = $this->showCurrentBalance();
    if ($currentBalance == 0 || $currentBalance < $transferAmount) {
      return [
        "status"     => "error",
        "message"    => "Insufficient funds. Please try again!",
      ];
    }

    if ($recipentUserFound && $currentBalance) {
      $this->withdrawMoney($transferAmount);
      $this->depositMoney($transferAmount, $recipentUser);
    }
  }

  private function saveTrsansaction()
  {
    $this->storage->save(Transaction::getModelName(), $this->transactions);
  }

  public function checkBalance(float $amount)
  {
    $totalDepositAmount = 0;
    foreach ($this->transactions as $transaction) {
      if ($transaction->getUser() === $this->user && $transaction->getType() === TransactionType::DEPOSIT) {
        $totalDepositAmount += $transaction->getAmount();
      }
    }

    return $totalDepositAmount;
  }
}
