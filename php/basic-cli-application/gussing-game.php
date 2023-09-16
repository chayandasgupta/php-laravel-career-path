<?php

    $options = getopt("", ['min::', 'max::']);   // min:: menas its optional parameter.
    $min     = $options['min'] ?? 1;
    $max     = $options['max'] ?? 100;
    
    if(!$options) {
      echo "Missing options value.";
      exit;
    }
    
    $number = rand($min, $max);

    echo "================================================\n";
    echo "      Welcome to the Number Guessing Game!\n";
    echo "   I'm thinking of a number between $min and $max.\n";
    echo "================================================\n\n";
    
    while(true) {

      $input_number = (int) readline("Enter your number: ");
      
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