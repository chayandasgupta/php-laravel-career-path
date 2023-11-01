<?php

namespace App\Controllers;

use App\Controllers\Authentication;
use App\FileStorage;
// use App\StorageInterface;
use App\UserType;

class AppController
{

	private Authentication $auth;
	private string $userEmail;

	// Common
	private const LOGIN    = 1;
	private const REGISTER = 2;
	private $initialMenuOptions = [
		self::LOGIN    => 'Login',
		self::REGISTER => 'Register',
	];

	// For Customer
	private const SHOW_TRANSACTION 		 = 1;
	private const DEPOSIT_MONEY    		 = 2;
	private const WITHDRAW_MONEY   		 = 3;
	private const SHOW_CURRENT_BALANCE = 4;
	private const TRANSFER_MONEY 			 = 5;
	private const LOGOUT 			 			   = 6;
	private $customerMenuOptions = [
		self::SHOW_TRANSACTION      => 'Show my transactions',
		self::DEPOSIT_MONEY    			=> 'Deposit money',
		self::WITHDRAW_MONEY    		=> 'Withdraw money',
		self::SHOW_CURRENT_BALANCE  => 'Show current balance',
		self::TRANSFER_MONEY    		=> 'Transfer money',
		self::LOGOUT    						=> 'Logout',
	];

	// For Admin
	private const SHOW_All_TRANSACTION		  = 1;
	private const SPECIFIC_USER_TRANSACTION = 2;
	private const SHOW_CUSTOMERS   		 			= 3;
	private $adminMenuOptions = [
		self::SHOW_All_TRANSACTION      => 'Show all transactions',
		self::SPECIFIC_USER_TRANSACTION => 'Transaction by user',
		self::SHOW_CUSTOMERS    				=> 'Show all customers',
	];

	public function __construct()
	{
		$this->auth = new Authentication(new FileStorage());
	}

	public function run(): void
	{
		while (true) {
			echo "\n";
			echo "Select from the following menu:\n";

			// Menu Lists
			foreach ($this->initialMenuOptions as $option => $initialMenuLebel) {
				printf("%d. %s\n", $option, $initialMenuLebel);
			}

			echo "\n";
			$choice = readline("Enter your choice:\n");

			switch ($choice) {
				case self::LOGIN;
					$email      = trim(readline("Enter your email address:\n"));
					$password   = readline("Enter your password:\n");
					$loggedInUser = $this->auth->login($email, $password);

					if ($loggedInUser == null) {
						echo "Login failed. Please check your credentials.\n";
						break;
					}

					if ($loggedInUser->getType() === UserType::CUSTOMER) {
						echo "\n";
						echo "Welcome, " . $loggedInUser->getName() . "!\n";
						// $customerPanel = new CustomerController($loggedInUser->getName());
						// $customerPanel->menu();
						$this->userEmail = $loggedInUser->getEmail();
						$this->customerPanel();
					} else {
						$this->adminPanel();
					}
					break;
				case self::REGISTER;
					$name  		= trim(readline("Enter your name:\n"));
					$email    = trim(readline("Enter your email address:\n"));
					$password = readline("Enter your password:\n");
					$this->auth->register($name, $email, $password);
					break;
				default:
					echo "Invalid\n";
			}
		}
	}

	public function customerPanel(): void
	{
		$transaction = new FinanceManager(new FileStorage(), $this->userEmail);
		// $transaction = new FinanceManager(new FileStorage());

		while (true) {
			echo "Select from the following menu:\n";

			// Menu Lists
			foreach ($this->customerMenuOptions as $option => $customerMenuLabel) {
				printf("%d. %s\n", $option, $customerMenuLabel);
			}

			echo "\n";
			$choice = readline("Enter your choice:");

			switch ($choice) {
				case self::SHOW_TRANSACTION;
					$transaction->showTransactions();
					break;

				case self::DEPOSIT_MONEY;
					$amount = (float) readline("Enter your deposit amount: ");

					if (!is_numeric($amount)) {
						printf("----------------------------------\n");
						echo "Amount must be a numeric value.\n\n";
						break;
					}
					if ($amount <= 0) {
						printf("----------------------------------\n");
						echo "Amount must be a positive number.\n\n";
						break;
					}

					// $transaction->depositMoney($amount);
					$transaction->depositMoney($amount, $this->userEmail);
					printf("----------------------------------\n");
					echo "Amount deposit successfully\n\n";
					break;

				case self::WITHDRAW_MONEY;
					$amount = (float) readline("Enter your withdraw amount: ");
					if (!is_numeric($amount)) {
						echo "Amount must be a numeric value.";
						break;
					}
					// Check if it's a positive value
					if ($amount <= 0) {
						echo "Amount must be a positive number.\n";
						break;
					}

					$response = $transaction->withdrawMoney($amount);

					printf("----------------------------------\n");
					if ($response) {
						if ($response['status'] == 'error') {
							echo $response['message'] . "\n\n";
							break;
						}
					}

					echo "Amount withdraw successfully\n";
					break;

				case self::SHOW_CURRENT_BALANCE;
					$response = $transaction->showCurrentBalance();
					printf("---------------------------------\n");
					printf("Current Balance: %.2f\n\n", $response);
					break;

				case self::TRANSFER_MONEY;
					$recipentEmail  = trim(readline("Enter recipient's email: "));
					$transferAmount = (float)trim(readline("Enter amount to transfer: "));
					$response = $transaction->transferAmount($recipentEmail, $transferAmount);

					if ($response) {
						if ($response['status'] == 'error') {
							printf("----------------------------------\n");
							echo $response['message'] . "\n\n";
							break;
						}
					}

					printf("----------------------------------\n");
					// echo $response['message'] . "\n\n";
					echo "Amount transfer successfully\n\n";
					break;

				case self::LOGOUT;
					$this->run();
					break;

				default:
					echo "Invalid\n";
			}
		}
	}

	public function adminPanel(): void
	{
		$transaction = new FinanceManager(new FileStorage());
		// $transaction = new FinanceManager(new FileStorage());

		while (true) {
			echo "Select from the following menu:\n";

			// Menu Lists
			foreach ($this->adminMenuOptions as $option => $adminMenuLabel) {
				printf("%d. %s\n", $option, $adminMenuLabel);
			}

			echo "\n";
			$choice = readline("Enter your choice:");

			switch ($choice) {
				case self::SHOW_All_TRANSACTION;
					$transaction->showAllTransactions();
					break;

				case self::SPECIFIC_USER_TRANSACTION;
					$customerEmail = trim(readline("Enter customer email: "));
					$transaction->showTransactions($customerEmail);
					break;

				case self::SHOW_CUSTOMERS;
					$transaction->showAllCustomers();
					break;

				case self::LOGOUT;
					$this->run();
					break;

				default:
					echo "Invalid\n";
			}
		}
	}
}
