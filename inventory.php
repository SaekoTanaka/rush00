<?php

include("file.php");

function inventory_get_item($id)
{
	if (!is_numeric($id))
		return FALSE;
	if (!load_data("inventory.txt", $inventory))
		return FALSE;
	foreach($inventory as $item)
		if ($item["id"] == $id)
			return $item;
	return FALSE;
}

function inventory_add($name, $image, $price, $tags = null)
{
	if (
		empty($name) or
		empty($image) or
		!is_numeric($price)
	)
		return FALSE;
	if (!load_data("inventory.txt", $inventory))
		return FALSE;
	$new_product = array();
	$new_product["id"] = end($inventory)["id"] + 1;
	$new_product["name"] = $name;
	$new_product["image"] = $image;
	$new_product["price"] = $price;
	if ($tags)
		$new_product["tags"] = preg_split("/\s+/", trim($tags));
	else
		$new_product["tags"] = array();
	$inventory[] = $new_product;
	return save_data("inventory.txt", $inventory);
}

function inventory_remove($id)
{
	if (!is_numeric($id))
		return false;
	if (!load_data("inventory.txt", $inventory))
		return FALSE;
	for ($i = 0; $i < count($inventory); $i++)
		if ($inventory[$i]["id"] == $id)
		{
			array_splice($inventory, $i, 1);
			return save_data("inventory.txt", $inventory);
		}
	return FALSE;
}

function inventory_get_tagged($tag)
{
	$tag = strtolower($tag);
	if (!load_data("inventory.txt", $inventory))
		return FALSE;
	$tagged_items = array();
	foreach ($inventory as $item)
		foreach ($item["tags"] as $item_tag)
			if (strtolower($item_tag) == $tag)
				$tagged_items[] = $item;
	return $tagged_items;
}

function name_match($name, $key)
{
	return (strpos(strtolower($name), strtolower($key)) !== false);
}

function tags_match($tags, $key)
{
	foreach ($tags as $item_tag)
		if (name_match($item_tag, $key))
			return true;
	return false;
}

function inventory_search($key)
{
	if (!load_data("inventory.txt", $inventory))
		return FALSE;
	$matching_items = array();
	foreach ($inventory as $item)
	{
		if (
			name_match($item["name"], $key) or
			tags_match($item["tags"], $key)
		)
			$matching_items[] = $item;
	}
	return $matching_items;
}

?>
