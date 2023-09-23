<?php

declare(strict_types=1);
class AppController
{
    private FinanceManageController $financeManager;

    private const ADD_INCOME      = 1;
    private const ADD_EXPENSE     = 2;
    private const VIEW_INCOME     = 3;
    private const VIEW_EXPENSE    = 4;
    private const VIEW_SAVINGS    = 5;
    private const VIEW_CATEGORIES = 6;
    private const EXIT_APP        = 7;

    private $menuOptions = [
        self::ADD_INCOME      => 'Add Income',
        self::ADD_EXPENSE     => 'Add Expense',
        self::VIEW_INCOME     => 'View Income',
        self::VIEW_EXPENSE    => 'View Expense',
        self::VIEW_SAVINGS    => 'View Savings',
        self::VIEW_CATEGORIES => 'View Categories',
        self::EXIT_APP        => 'Exit',
    ];


    public function __construct()
    {
        $this->financeManager =  new FinanceManageController(new FileStorage());
    }

    public function run(): void
    {

        while (true) {

            echo "================================================\n";
            echo "\t\tWhat do you want?\n";
            echo "================================================\n";

            // Menu Lists
            foreach ($this->menuOptions as $option => $menuLebel) {
                printf("%d. %s\n", $option, $menuLebel);
            }

            // User input
            $choiceMenu = intval(readline("Enter your choice:"));
            echo "\n";

            switch ($choiceMenu) {
                case self::ADD_INCOME;
                    $amount   = (float) trim(readline("Enter income amount: "));
                    $category = trim(readline("Enter income category: "));
                    $this->financeManager->addIncome($amount, $category);
                    break;
                case self::ADD_EXPENSE;
                    $amount   = (float) trim(readline("Enter expense amount: "));
                    $category = trim(readline("Enter expense category: "));
                    $this->financeManager->addExpense($amount, $category);
                    break;
                case self::VIEW_INCOME;
                    $this->financeManager->showIncomes();
                    break;
                case self::VIEW_EXPENSE;
                    $this->financeManager->showExpenses();
                    break;
                case self::VIEW_SAVINGS;
                    $this->financeManager->showSavings();
                    break;
                case self::VIEW_CATEGORIES;
                    $this->financeManager->showCategories();
                    break;
                case self::EXIT_APP;
                    return;
                default:
                    echo "Invalid option.\n";
            }
        }
    }
}
