<?php

require_once '../app/models/User.php';
class CustomerController extends User
{

  private const SHOW_TRANSACTION      = 1;
  private const DEPOSIT_MONEY         = 2;
  private const WITHDRAW_MONEY        = 3;
  private const SHOW_CURRENT_BALANCE = 4;
  private const TRANSFER_MONEY        = 5;
  private $customerMenuOptions = [
    self::SHOW_TRANSACTION      => 'Show my transactions',
    self::DEPOSIT_MONEY         => 'Deposit money',
    self::WITHDRAW_MONEY        => 'Withdraw money',
    self::SHOW_CURRENT_BALANCE  => 'Show current balance',
    self::TRANSFER_MONEY        => 'Transfer money',
  ];

  public function __construct(string $name)
  {
    echo "call when customer controller call";
    var_dump($name);
  }

  public function menu()
  {
    while (true) {
      echo "Select from the following menu:\n";

      // Menu Lists
      foreach ($this->customerMenuOptions as $option => $customerMenuLabel) {
        printf("%d. %s\n", $option, $customerMenuLabel);
      }

      echo "\n";
      $choice = readline("Enter your choice:\n");

      switch ($choice) {
        case self::SHOW_TRANSACTION;
          echo "1";
          break;
        case self::DEPOSIT_MONEY;
          echo "2";
          break;
        case self::WITHDRAW_MONEY;
          echo "3";
          break;
        case self::SHOW_CURRENT_BALANCE;
          echo "4";
          break;
        case self::TRANSFER_MONEY;
          echo "5";
          break;
        default:
          echo "Invalid\n";
      }
    }
  }
}
