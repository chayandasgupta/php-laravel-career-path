<?php
  class MainController {
    
    private $incomeController;
    private $expenseController;
    private $categoryController;
    
    private $incomeCsvFile = "storage/income.csv";
    private $expenseCsvFile = "storage/expense.csv";
    private $categoryTxtFile = "storage/Category.txt";
    
    public function __construct()
    { 
      $this->incomeController =  new IncomeController($this->incomeCsvFile);
      $this->expenseController = new ExpenseController($this->expenseCsvFile);
      $this->categoryController = new CategoryController($this->categoryTxtFile);
    }
    
    public function run() {

    
      while (true) {

        echo "================================================\n";
        echo "\t\tWhat do you want?\n";
        echo "================================================\n";
        
        // Menu Lists
        echo "1. Add Income\n";
        echo "2. Add Expense\n";
        echo "3. View Income\n";
        echo "4. View Expense\n";
        echo "5. View Total\n";
        echo "6. View Categories\n";
        echo "7. Exit\n\n";
        
        // User input
        $choiceMenu = readline("Enter your choice:");
        echo "\n";
        
        if($choiceMenu == 1) {

          $this->incomeController->addIncome();

        } elseif($choiceMenu == 2) { 

          $this->expenseController->addExpense();

        } elseif($choiceMenu == 3) {

          $this->incomeController->ViewIncome();
          
        } elseif($choiceMenu == 4) {

          $this->expenseController->viewExpense();
          
        } elseif($choiceMenu == 5) {
          
          $totalIncome  = $this->incomeController->getTotalIncome();
          $totalExpense = $this->expenseController->getTotalExpense();
          $total = $totalIncome - $totalExpense;
          echo "Total: $total\n\n";

        } elseif($choiceMenu == 6) {
          
          $this->categoryController->viewAllCategory();
          
        } elseif ($choiceMenu == 7) {
            exit();
        } else {
            echo "Invalid choice\n\n";
        }
      }
    }
  }
?>