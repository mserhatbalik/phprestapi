<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Blog Post Object
$post = new Post($db);

// Blog Post Query
$result = $post->read();

// Get Row Count
$num = $result->rowCount();

// Check If Any Post Exists
if ($num > 0) {
  // Post Array
  $posts_arr = [];
  $posts_arr['data'] = [];




  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $post_item = [
      'id' => $id,
      'title' => $title,
      'body' => html_entity_decode($body),
      'author' => $author,
      'category_id' => $category_id,
      'category_name' => $category_name
    ];

    // Push to the tail of "data" array untill while loop ends
    array_push($posts_arr['data'], $post_item);
  }

  // Turn to JSON & Output
  echo json_encode($posts_arr);
} else {
  // No Posts Found
  echo json_encode(array('message' => 'No Posts Found'));
}
