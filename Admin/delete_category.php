<?php
session_start();
include("../Includes/conn.php");

if (!is_logged_in() || $_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(403);
    exit;
}

try {
    $category_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    // Check for existing pets
    $check_stmt = $con->prepare("SELECT COUNT(*) FROM pets WHERE category_id = ?");
    $check_stmt->bind_param("i", $category_id);
    $check_stmt->execute();
    
    if($check_stmt->get_result()->fetch_row()[0] > 0) {
        throw new Exception("Category has active listings and cannot be deleted");
    }

    $delete_stmt = $con->prepare("DELETE FROM pet_category WHERE category_id = ?");
    $delete_stmt->bind_param("i", $category_id);
    $delete_stmt->execute();

    if($delete_stmt->affected_rows === 0) {
        throw new Exception("Category not found");
    }

    echo json_encode(['success' => true]);
} catch(Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}