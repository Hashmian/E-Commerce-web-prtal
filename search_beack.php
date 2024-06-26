<?php
include 'connect.php';

function search_results($keywords) {
    global $conn;

    $returned_results = array();
    $where = "";

    $keywords = preg_split("/[\s]+/", $keywords);
    $total_keywords = count($keywords);

    foreach ($keywords as $key => $keyword) {
        $where .= "keywords LIKE '%$keyword%'";
        if ($key != $total_keywords - 1) {
            $where .= " AND ";
        }
    }

    $query = "SELECT name, product_details, url FROM products WHERE $where";

    $results = mysqli_query($conn, $query);
    $result_num = mysqli_num_rows($results);

    if ($result_num === 0) {
        return false;
    } else {
        while ($result_row = mysqli_fetch_assoc($results)) {
            $returned_results[] = array(
                'name' => $result_row['name'],
                'product_details' => $result_row['product_details'],
                'url' => $result_row['url']
            );
        }
        return $returned_results;
    }
}
?>
