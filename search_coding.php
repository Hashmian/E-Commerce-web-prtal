<?php
        $error = null;
        $keywords = "";
        $results = " ";
if (isset($_POST['submit'])) {
    $keywords = mysqli_real_escape_string($conn, htmlentities(trim($_POST['keywords'])));
    $error = null; // Use a single variable for error message

    if (empty($keywords)) {
        $error = "You did not enter any search product.";
    } elseif (strlen($keywords) < 4) {
        $error = "Search product should be at least 4 characters long.";
    } else {
        // Perform the search and check if it returned any results.
        $results = search_results($keywords);
        
        if ($results === false) {
            $error = "Your search did not yield any results.";
        }
    }
}

if ($error === null) {
    // Display search results if there are no errors.
    $results = search_results($keywords);
   // $result_num = count($results);
    echo "<strong>" . $keywords . "</strong> " . " <br />";
    
    foreach ($results as $result) {
       // echo "<h3>" . $result['title'] . "</h3>";
    }
} else {
    // Display the first error message encountered.
    echo $error;
}
?>