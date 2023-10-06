<?php

require "vendor/autoload.php";

use App\Controllers\AppController;

// use App\controllers\AdminController;
// require_once '../app/Controllers/AdminController.php';
// require_once '../app/controllers/Authentication.php';
// require_once '../app/controllers/FinanceManager.php';
// require_once '../app/controllers/CustomerController.php';
// require_once '../app/FileStorage.php';
// require_once '../app/models/Customer.php';
// require_once '../app/models/Admin.php';
// require_once '../app/models/Deposit.php';
// require_once '../app/models/Withdraw.php';
// require_once '../app/UserType.php';
// require_once '../app/TransactionType.php';
// require_once realpath("vendor/autoload.php");


$app = new AppController();
$app->run();
