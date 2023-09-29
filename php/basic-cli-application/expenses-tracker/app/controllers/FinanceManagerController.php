<?php

declare(strict_types=1);

class FinanceManageController
{
    private Storage $storage;
    private array $categories;
    private array $transactions;

    public function __construct(Storage $storage)
    {
        $this->storage      = $storage;

        $this->categories   = $this->storage->loadData(Category::getModelName());
        $this->transactions = $this->storage->loadData(TransactionModel::getModelName());

        if (count($this->categories) == 0) {
            $this->createDefaultCategories();
            // $this->storage->loadData(Category::getModelName());
        }
    }

    public function createDefaultCategories(): void
    {
        $incomeCategories = [
            'Salary',
            'Business',
            'Loan',
        ];

        $expenseCategories = [
            'Rent',
            'Family',
            'Recreation',
            'Sadakah',
            'Food'
        ];

        $categories = [];

        foreach ($incomeCategories as $incomeCategoryName) {
            $categories[] = new IncomeCategory($incomeCategoryName);
        }

        foreach ($expenseCategories as $expenseCategoryName) {
            $categories[] = new ExpenseCategory($expenseCategoryName);
        }

        $this->storage->save(Category::getModelName(), $categories);
    }

    public function addIncome(float $amount, string $categoryName): void
    {
        $category = $this->validateCategory($categoryName, TransactionType::INCOME);
        if (!$category) {
            printf("Invalid category!\n");
            return;
        }

        $income = new IncomeModel();
        $income->setAmount($amount);
        $income->setCategory($category);

        $this->transactions[] = $income;

        $this->saveTransactions();

        printf("Income added successfully!\n");
    }

    public function addExpense(float $amount, string $categoryName): void
    {
        $category = $this->validateCategory($categoryName, TransactionType::EXPENSE);
        if (!$category) {
            printf("Invalid category!\n");
            return;
        }

        $expense = new ExpenseModel();
        $expense->setAmount($amount);
        $expense->setCategory($category);

        $this->transactions[] = $expense;

        $this->saveTransactions();

        printf("Expense added successfully!\n");
    }

    public function showIncomes()
    {
        printf("Income Lists\n");
        printf("----------------------------------\n");
        foreach ($this->transactions as $transaction) {
            if ($transaction->getCategory()->getType() === TransactionType::INCOME) {
                printf("Amount: %.2f, Category: %s\n\n", $transaction->getAmount(), $transaction->getCategory()->getName());
            }
        }
    }

    public function showExpenses()
    {
        printf("Expense Lists\n");
        printf("----------------------------------\n");
        foreach ($this->transactions as $transaction) {
            if ($transaction->getCategory()->getType() === TransactionType::EXPENSE) {
                printf("Amount: %.2f, Category: %s\n\n", $transaction->getAmount(), $transaction->getCategory()->getName());
            }
        }
    }

    public function showCategories()
    {
        printf("---------------------------------\n");
        foreach ($this->categories as $category) {
            printf("Name: %s, Type: %s\n", $category->getName(), $category->getType()->name);
        }
        printf("---------------------------------\n\n");
    }

    public function showSavings(): void
    {
        $totalIncome  = 0;
        $totalExpense = 0;
        $saving       = 0;

        printf("---------------------------------\n");
        foreach ($this->transactions as $transaction) {
            if ($transaction->getCategory()->getType() === TransactionType::INCOME) {
                $totalIncome += $transaction->getAmount();
                $saving += $transaction->getAmount();
            } else {
                $totalExpense += $transaction->getAmount();
                $saving -= $transaction->getAmount();
            }
        }

        printf("Total Income: %.2f\n", $totalIncome);
        printf("Total Expense: %.2f\n", $totalExpense);
        printf("---------------------------------\n");
        printf("Savings: %.2f\n\n", $saving);
    }

    private function getCategory(string $name, TransactionType $type): ?Category
    {
        foreach ($this->categories as $category) {
            if ($category->getName() === $name && $category->getType() === $type) {
                return $category;
            }
        }

        return null;
    }

    public function saveTransactions(): void
    {
        $this->storage->save(TransactionModel::getModelName(), $this->transactions);
    }

    public function validateCategory($categoryName, $transactionType)
    {
        $category = $this->getCategory($categoryName, $transactionType);
        return $category;
    }
}
