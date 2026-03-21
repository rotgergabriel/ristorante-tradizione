<?php
function getRecipesList($conn)
{
    $sql = "SELECT title FROM recipes ORDER BY title ASC";
    return mysqli_query($conn, $sql);
}

function getRecipesFilter($conn, $search_query, $selection_menu)
{
    $filter = "";
    if (!empty($search_query)) {
        $busqueda = mysqli_real_escape_string($conn, $search_query);
        $filter = " WHERE title LIKE '%$busqueda%'";
    } elseif (!empty($selection_menu)) {
        $seleccion = mysqli_real_escape_string($conn, $selection_menu);
        $filter = " WHERE title = '$seleccion'";
    }
    return $filter;
}

function getTotalRecipesCount($conn, $filter)
{
    $res_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM recipes $filter");
    $row = mysqli_fetch_assoc($res_count);
    return $row['total'];
}

function getPagedRecipes($conn, $filter, $limit, $offset)
{
    $sql = "SELECT * FROM recipes $filter ORDER BY title ASC LIMIT $limit OFFSET $offset";
    return mysqli_query($conn, $sql);
}

function recipesToArray($result)
{
    $recipes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $recipes[] = $row;
    }
    return $recipes;
}

function getAllRecipes($conn, $limit = 8)
{
    $sql = "SELECT id, title FROM recipes ORDER BY title ASC LIMIT $limit";
    return mysqli_query($conn, $sql);
}