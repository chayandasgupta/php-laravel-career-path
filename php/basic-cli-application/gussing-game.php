<?php

    $options = getopt("", ['min::', 'max::']);   // min:: menas its optional parameter.
    $min     = $options['min'] ?? 1;
    $max     = $options['max'] ?? 100;
    
    if(!$options) {
      echo "Missing options value.";
      exit;
    }
    
    $number = rand($min, $max);
    
    while(true) {

      $input_number = readline("Enter your number: ");
      
      if($input_number > $number) {
        echo "Try a lower number.\n";
      } elseif ($input_number < $number) {
        echo "Try a bigger number.\n";
      } else {
        echo "Congrats! you guess the correct number.\n";
        break;
      }
    }
?>