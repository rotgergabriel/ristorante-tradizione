<?php

function getHomeRecipeTitles($conn)
{
    $sql = "SELECT title FROM recipes ORDER BY title ASC";
    return mysqli_query($conn, $sql);
}

function getRandomHomeRecipes($conn, $limit = 3)
{
    $sql = "SELECT * FROM recipes ORDER BY RAND() LIMIT $limit";
    return mysqli_query($conn, $sql);
}

function getCarouselRecipes($conn, $limit = 3)
{
    $sql = "SELECT title, description, subtitle, image_url, rating 
            FROM recipes 
            ORDER BY rating DESC 
            LIMIT $limit";
    return mysqli_query($conn, $sql);
}

function formatResultSetToArray($result)
{
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}