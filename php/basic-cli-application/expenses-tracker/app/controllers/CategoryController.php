<?php

class CategoryController {
  
  protected $categorytTxtFile;
  
  public function __construct($txtFile)
  {
    $this->categorytTxtFile = $txtFile;
  }
  
  public function viewAllCategory() {
    $myfile = fopen($this->categorytTxtFile, "r");
    
    if (!file_exists($this->categorytTxtFile) || !is_readable($this->categorytTxtFile)) {
        return [];
    }
    $categories =  file($this->categorytTxtFile, FILE_IGNORE_NEW_LINES);
    foreach ($categories as $index => $category) {
        echo $category . "\n";
    }
    fclose($myfile);
    echo "\n";
  }
}