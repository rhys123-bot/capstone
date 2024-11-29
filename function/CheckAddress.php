<?php

function extractAddressComponents($address) {
  $street = '';
  $subdivision = '';
  $barangay = '';

  // Extract street component
  $matches = [];
  if (preg_match('/^(.*?)\b\b(.*)$/i', $address, $matches)) {
    if (isset($matches[1])) {
      $street = trim($matches[1]);
    }
  }
  
  // Extract subdivision and barangay components
  $matches = [];
  if (preg_match('/^(.*?),\s*Brgy\.\s*(.*?)$/i', $address, $matches)) {
    if (isset($matches[1])) {
      $subdivision = trim($matches[1]);
    }
    if (isset($matches[2])) {
      $barangay = trim($matches[2]);
    }
  }

  // Remove "Naga City" and "Naga Cebu" from barangay if they exist
  $barangay = str_replace(', Naga City', '', $barangay);
  $barangay = str_replace(', Naga Cebu', '', $barangay);

  // Return an array of components
  return array(
    'street' => $street,
    'subdivision' => $subdivision,
    'barangay' => $barangay
  );
}


?>