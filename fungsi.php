<?php


// Get the current page from the query parameters
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Get the number of items per page from the query parameters
$itemsPerPageDefault = 8;
$itemsPerPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : $itemsPerPageDefault;

// Define the available options for items per page (1 to 10)
$itemsPerPageOptions = range(1, 10); // Values from 1 to 10
// Calculate the offset for the SQL query
$offset = ($page - 1) * $itemsPerPage;

// Get the sort option from the query parameters
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Define the available sort options
$sortOptions = [
    'default' => 'Default',
    'date' => 'Sort by Date',
    'description' => 'Sort by Description',
    'newest' => 'Newest',
    // Add more options as needed
];

// Build the SQL query with sorting
if ($sortOption === 'date') {
    $sql = "SELECT * FROM contents ORDER BY content_date LIMIT $offset, $itemsPerPage";
} elseif ($sortOption === 'description') {
    $sql = "SELECT * FROM contents ORDER BY content_description LIMIT $offset, $itemsPerPage";
} elseif ($sortOption === 'newest') {
    $sql = "SELECT * FROM contents ORDER BY content_date DESC LIMIT $offset, $itemsPerPage";
} else {
    $sql = "SELECT * FROM contents LIMIT $offset, $itemsPerPage";
}

$result = $conn->query($sql);

// Get the total number of items
$totalItems = $conn->query("SELECT COUNT(*) as total FROM contents")->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalItems / $itemsPerPage);

// Calculate the range of items being shown
$firstItem = ($page - 1) * $itemsPerPage + 1;
$lastItem = min($page * $itemsPerPage, $totalItems);
?>
