<?php

//defining a namespace
namespace Lab8\Library;

class Functions {

  function populateDropdown($options, $select = ""){

    $html_dropdown = "";
    foreach($options as $manufacturer) {

      $selected = $select == $manufacturer->Company ? "selected" : "";
      $html_dropdown.= "<option $selected value = '$manufacturer->id'>$manufacturer->Company</option>";

    }

    return $html_dropdown;
  }

}