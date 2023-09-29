<?php

require_once '../app/controllers/AppController.php';
require_once '../app/controllers/Authentication.php';
require_once '../app/controllers/FinanceManager.php';
require_once '../app/controllers/CustomerController.php';
require_once '../app/FileStorage.php';
require_once '../app/models/Customer.php';
require_once '../app/models/Admin.php';
require_once '../app/models/Deposit.php';
require_once '../app/models/Withdraw.php';
require_once '../app/UserType.php';
require_once '../app/TransactionType.php';

$app = new AppController();
$app->run();