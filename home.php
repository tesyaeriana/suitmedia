<?php
require_once 'connection.php';
require_once 'fungsi.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Your Title</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <style>
        
    </style>
</head>
<body>
    <?php include_once 'header.php'; ?>
    <?php include_once 'banner.php'; ?>
    
    <div class="post-list">
        <!-- Showing Info -->
        <div class="showing-info">
            Showing <?php echo $firstItem; ?> to <?php echo $lastItem; ?> of <?php echo $totalItems; ?> items
        </div>

        <!-- Show Per Page dropdown -->
        <div class="show-per-page">
            <label for="per_page">Show Per Page:</label>
            <select id="per_page" onchange="location = this.value;">
                <?php foreach ($itemsPerPageOptions as $option) { ?>
                    <option value="?page=<?php echo $page; ?>&sort=<?php echo $sortOption; ?>&per_page=<?php echo $option; ?>" <?php if ($itemsPerPage == $option) echo 'selected'; ?>>
                        <?php echo $option; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Sort By dropdown -->
        <div class="sort-by">
            <label for="sort">Sort By:</label>
            <select id="sort" onchange="location = this.value;">
                <?php foreach ($sortOptions as $optionKey => $optionLabel) { ?>
                    <option value="?page=<?php echo $page; ?>&sort=<?php echo $optionKey; ?>&per_page=<?php echo $itemsPerPage; ?>" <?php if ($sortOption === $optionKey) echo 'selected'; ?>>
                        <?php echo $optionLabel; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <main>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card">
                <div class="image">
                    <img src="<?php echo $row["content_image"]; ?>" alt="">
                </div>
                <div class="caption">
                    <p class="date"><?php echo $row["content_date"]; ?></p>
                    <p class="text"><?php echo $row["content_description"]; ?></p>
                </div>
            </div>
        <?php } ?>
    </main>

    <!-- Pagination -->
    <div class="pagination-container">
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php } ?>
        </div>
    </div>

    <script src="" async defer></script>
</body>
</html>
