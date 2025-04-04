<?php
session_start();
include("../Includes/conn.php");

if (!is_logged_in() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit;
}

try {
    $category_id = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);
    $title = filter_var($_POST['category_title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(empty($title)) {
        throw new Exception("Category name required");
    }

    $stmt = $con->prepare("UPDATE pet_category SET category_title = ? WHERE category_id = ?");
    $stmt->bind_param("si", $title, $category_id);
    $stmt->execute();

    if($stmt->affected_rows === 0) {
        throw new Exception("No changes made");
    }

    echo json_encode(['success' => true]);
} catch(Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}