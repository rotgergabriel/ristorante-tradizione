<?php

function getMenuCategories($conn)
{
    $sql = "SELECT * FROM menu_categories ORDER BY display_order ASC, name ASC";
    return mysqli_query($conn, $sql);
}

function getCategoryIdByName($conn, $name)
{
    $name = mysqli_real_escape_string($conn, $name);
    $res = mysqli_query($conn, "SELECT id FROM menu_categories WHERE name = '$name' LIMIT 1");
    if ($row = mysqli_fetch_assoc($res)) {
        return $row['id'];
    }
    return null;
}

function createCategory($conn, $name)
{
    $name = mysqli_real_escape_string($conn, $name);
    $slug = strtoupper(str_replace(' ', '_', $name));
    mysqli_query($conn, "INSERT INTO menu_categories (name, slug) VALUES ('$name', '$slug')");
    return mysqli_insert_id($conn);
}

function getMenuItemsByCategory($conn, $category_id)
{
    $category_id = (int)$category_id;

    $sql = "SELECT * FROM menu_items 
            WHERE category_id = $category_id 
            ORDER BY id DESC";

    return mysqli_query($conn, $sql);
}

function deleteMenuItem($conn, $id)
{
    $id = (int)$id;
    return mysqli_query($conn, "DELETE FROM menu_items WHERE id = $id");
}

function getMenuItemById($conn, $id)
{
    $id = (int)$id;
    $sql = "SELECT m.*, c.name as cat_name 
            FROM menu_items m 
            JOIN menu_categories c ON m.category_id = c.id 
            WHERE m.id = $id";
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($res);
}

function deleteRecipe($conn, $id)
{
    $id = (int)$id;
    return mysqli_query($conn, "DELETE FROM recipes WHERE id = $id");
}

function getRecipeById($conn, $id)
{
    $id = (int)$id;
    $res = mysqli_query($conn, "SELECT * FROM recipes WHERE id = $id");
    return mysqli_fetch_assoc($res);
}
