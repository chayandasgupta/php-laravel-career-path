<?php
require_once 'Trait/FileReadWrite.php';

class IncomeController {

  use FileReadWrite;
  
  protected $csvFile;
  
  public function __construct($csvFile) 
  {
    $this->csvFile = $csvFile;
  }
  
  public function addIncome() 
  {

    $incomeAmount   = (int) readline("Enter amount: ");
    $incomeCategory = readline("Enter income category: ");
    
    $incomeData = [
      [
        'Amount' => $incomeAmount,
        'Category' => $incomeCategory,
      ]
    ];
  
    
    if(!file_exists($this->csvFile)) {
      $file = fopen($this->csvFile, "w");
      
      fputcsv($file, ['Amount', 'Category']);
      
      if ($file !== false) {
        $this->fileReadWrite($incomeData, $file);
      } else {
          echo 'Unable to create the CSV file.'."\n\n";
      }
    } else {
      $file = fopen($this->csvFile, "a");
      $this->fileReadWrite($incomeData, $file);
    }
  }
  
  public function viewIncome() 
  {

    if (!file_exists($this->csvFile)) {
        echo "The CSV file does not exist.\n";
        return;
    }

    $file = fopen($this->csvFile, "r");

    if ($file !== false) {
        // Read and print the header row
        $header = fgetcsv($file);
        if ($header !== false) {
            echo implode("\t", $header) . "\n";
        }

        // Read and print each row of data
        while (($row = fgetcsv($file)) !== false) {
            echo implode("\t", $row) . "\n";
        }

        fclose($file);
    } else {
        echo "Unable to open the CSV file.\n";
    }

  }

  public function getTotalIncome() 
  {
    if (!file_exists($this->csvFile)) {
        return 0;
    }

    $totalIncome = 0;
    $file = fopen($this->csvFile, 'r');
    if ($file !== false) {
        // Skip the header row
        fgetcsv($file);
        
        while (($data = fgetcsv($file)) !== false) {
          $totalIncome += (float) $data[0];
        }

        fclose($file);
    }

    return $totalIncome;
  }
}