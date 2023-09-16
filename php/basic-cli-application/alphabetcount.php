<?php

  // Without pass parameter from terminal.
  $string  = readline("Enter string: ");
  $count = 0;

  for ($i = 0; $i < strlen($string); $i++) {
      $char = $string[$i];
      if (($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z')) {
          $count++;
      }
  }

  echo "Total alphabetic characters: $count";

  //When Pass parameter string from terminal.
  // $options = getopt("", ['string::']);
  // $count = 0;

  // for ($i = 0; $i < strlen($options['string']); $i++) {
  //     $char = $options['string'][$i];
  //     if (($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z')) {
  //         $count++;
  //     }
  // }

  // echo "Number of alphabetic characters: $count";
?>