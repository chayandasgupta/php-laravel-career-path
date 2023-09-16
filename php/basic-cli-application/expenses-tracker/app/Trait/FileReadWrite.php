<?php

trait FileReadWrite 
{
  public function fileReadWrite($data, $file) {
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    echo "Data stored successfully\n\n";
    fclose($file);
  }
}