<?php


//This Post Types array is used in multiple configurations
$gfPostTypes = array(

	"hunting" => array(
		"display_name" => "Hunting",
		"post_list_style" => "tile",
		"children" => array(

			"big-game" => array(
				"display_name" => "Big Game",
				"post_list_style" => "tile",
				"children" => array(

					"bear" => array(
						"display_name" => "Bear",
						"post_list_style" => "tile"
					),
					"elk" => array(
						"display_name" => "Elk",
						"post_list_style" => "tile"
					),
					"moose" => array(
						"display_name" => "Moose",
						"post_list_style" => "tile"
					)
				)
			),

			"waterfowl" => array(
				"display_name" => "Waterfowl",
				"post_list_style" => "tile",
				"children" => array(

					"duck" => array(
						"display_name" => "Duck",
						"post_list_style" => "tile"
					),
					"goose" => array(
						"display_name" => "Goose",
						"post_list_style" => "tile"
					)

				)
			),

			"deer" => array(
				"display_name" => "Deer",
				"post_list_style" => "tile",
				"children" => array(

					"whitetail" => array(
						"display_name" => "Whitetail",
						"post_list_style" => "tile"
					),
					"blacktail" => array(
						"display_name" => "Blacktail",
						"post_list_style" => "tile"
					)

				)
			)
		)
	),

	"fishing" => array(
		"display_name" => "Fishing",
		"post_list_style" => "tile",
		"children" => array(

			"freshwater" => array(
				"display_name" => "Freshwater",
				"post_list_style" => "tile",
				"children" => array(

					"trout" => array(
						"display_name" => "Trout",
						"post_list_style" => "tile"
					),
					"catfish" => array(
						"display_name" => "Catfish",
						"post_list_style" => "tile"
					),
					"bass" => array(
						"display_name" => "Bass",
						"post_list_style" => "tile"
					)
				)
			),

			"saltwater" => array(
				"display_name" => "Saltwater",
				"post_list_style" => "tile",
				"children" => array(

					"tuna" => array(
						"display_name" => "Tuna",
						"post_list_style" => "tile"
					),
					"grouper" => array(
						"display_name" => "Grouper",
						"post_list_style" => "tile"
					)

				)
			)
		)
	)
);

// $simpleTermList = array();

// foreach ($gfPostTypes as $tertiaryTermName => $tertiaryTermValue) {

// 	foreach ($tertiaryTermValue as $secondaryTermName => $secondaryTermValue) {

// 		foreach ($secondaryTermValue as $termName => $termValue) {

// 			$simpleTermList[$termName]["secondary"] = $secondaryTermName;
// 			$simpleTermList[$termName]["tertiary"] = $tertiaryTermName;

// 		}

// 	}

// }