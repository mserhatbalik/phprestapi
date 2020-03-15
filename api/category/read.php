<?php

// Define Header Rules
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include Necessary Configs - Libraries
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB
$db = new Database();
$db = $db->connect();

// Instantiate Category Class
$categories = new Category($db);

// Call the Read Method
$results = $categories->read();

// Get Row Count
$num = $results->rowCount();

// Check if results are empty
if ($num > 0) {
  $category_arr = [];
  $category_arr['data'] = [];

  while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $categoryItem = [
      'id' => $id,
      'name' => $name,
      'created_at' => $created_at
    ];
    array_push($category_arr['data'], $categoryItem);
  }

  // Echo JSON
  echo json_encode($category_arr);
} else {
  echo json_encode(['message' => 'No Categories Found']);
}
