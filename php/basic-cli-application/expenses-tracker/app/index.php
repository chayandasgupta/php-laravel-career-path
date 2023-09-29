<?php
require_once './controllers/FinanceManagerController.php';
require_once './FileStorage.php';
require_once './models/Model.php';
require_once './models/IncomeModel.php';
require_once './models/ExpenseModel.php';
require_once './TransactionType.php';
require_once './models/Category.php';
require_once './IncomeCategory.php';
require_once './ExpenseCategory.php';
require_once './controllers/AppController.php';

$app = new AppController();
$app->run();
