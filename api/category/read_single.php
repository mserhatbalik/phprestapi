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
$category = new Category($db);

// Set ID
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Call the Read Method
$result = $category->readSingle();

// Check Results
$category_arr = [
  'id' => $category->id,
  'name' => $category->name,
  'created_at' => $category->created_at
];

// Echo Results
echo json_encode($category_arr);
