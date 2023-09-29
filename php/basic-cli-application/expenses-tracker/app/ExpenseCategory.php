<?php

class ExpenseCategory extends Category
{
    public function __construct(string $name = "")
    {
        $this->name = $name;
        $this->type = TransactionType::EXPENSE;
    }
}
