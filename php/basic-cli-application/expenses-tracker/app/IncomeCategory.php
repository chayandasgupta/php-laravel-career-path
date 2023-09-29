<?php

class IncomeCategory extends Category
{
    public function __construct(string $name = "")
    {
        $this->name = $name;
        $this->type = TransactionType::INCOME;
    }
}
