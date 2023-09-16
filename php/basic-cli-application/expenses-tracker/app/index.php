<?php
  require_once '../app/controllers/MainCotroller.php';
  require_once '../app/controllers/IncomeController.php';
  require_once '../app/controllers/ExpenseController.php';
  require_once '../app/controllers/CategoryController.php';
  
  
  $app = new MainController();
  $app->run();
?>