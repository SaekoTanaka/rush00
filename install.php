#!/usr/bin/php
<?php

include_once("file.php");
include_once("permissions.php");

$accounts =
[
	[
		"login"=>"root",
		"passwd"=>"5e02d9c4ccb972a13348423685314389cf35dd26efb95ac18e77de775050e860175980274596cc9baac1701f35d180ec8aa9eaef902ff88066143cf8e61610f2",
		"salt"=>"4f035302cd31055c",
		"pepper"=>"71859992f1866128",
		"permissions"=>$PER_MODIFY_USER | $PER_INVENTORY
	]
];

if (!save_data("accounts.txt", $accounts))
	echo "ERROR: Failed to create accounts.".PHP_EOL;

$inventory =
[
	[
		"id"=>0,
		"name"=>"BALENCIAGA",
		"image"=>"",
		"price"=>200,
		"tags"=>["cap"]
	],
	[
		"id"=>1,
		"name"=>"ca4la",
		"image"=>"",
		"price"=>120,
		"tags"=>["other"]
	],
	[
		"id"=>2,
		"name"=>"victim",
		"image"=>"",
		"price"=>9999,
		"tags"=>["knit"]
	],
	[
		"id"=>3,
		"name"=>"new era",
		"image"=>"",
		"price"=>9999,
		"tags"=>["cap"]
	],
	[
		"id"=>4,
		"name"=>"L&HARMONY",
		"image"=>"",
		"price"=>9999,
		"tags"=>["cap"]
	],
];

if (!save_data("inventory.txt", $inventory))
	echo "ERROR: Failed to create inventory.".PHP_EOL;

?>
