<?php

class AppController
{

	private Authentication $auth;
	private const LOGIN    = 1;
	private const REGISTER = 2;

	private $initialMenuOptions = [
		self::LOGIN    => 'Login',
		self::REGISTER => 'Register',
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
					echo "Login\n";
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
}
