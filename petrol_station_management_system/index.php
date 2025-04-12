<?php
// Entry point for the petrol station management system
session_start();

// Include necessary files
include 'config.php';
include 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Load dashboard or main page
include 'dashboard.php';
?>
