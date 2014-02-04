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
				"show_in_menu" => TRUE,
				"children" => array(

					"bear" => array(
						"display_name" => "Bear",
						"post_list_style" => "tile",
						"show_in_menu" => TRUE
					),
					"elk" => array(
						"display_name" => "Elk",
						"post_list_style" => "tile",
						"show_in_menu" => TRUE
					),
					"moose" => array(
						"display_name" => "Moose",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)
				)
			),

			"deer" => array(
				"display_name" => "Deer",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"whitetail" => array(
						"display_name" => "Whitetail",
						"post_list_style" => "tile",
						"show_in_menu" => TRUE
					),
					"mule-deer" => array(
						"display_name" => "Mule Deer",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"blacktail" => array(
						"display_name" => "Blacktail",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),



			"hogs" => array(
				"display_name" => "Hogs",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE

			),

			"turkey" => array(
				"display_name" => "Turkey",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),




			"predators" => array(
				"display_name" => "Predators",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"cougars" => array(
						"display_name" => "Cougars",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"coyotes" => array(
						"display_name" => "Coyotes",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"wolves" => array(
						"display_name" => "Wolves",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),



			"small-game" => array(
				"display_name" => "Small Game",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"rabbits" => array(
						"display_name" => "Rabbits",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"squirrels" => array(
						"display_name" => "Squirrels",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),




			"upland-bird" => array(
				"display_name" => "Upland Bird",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"doves" => array(
						"display_name" => "Doves",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"pheasants" => array(
						"display_name" => "Pheasants",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),

			"waterfowl" => array(
				"display_name" => "Waterfowl",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"duck" => array(
						"display_name" => "Duck",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"goose" => array(
						"display_name" => "Geese",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			)


		)
	),

	"fishing" => array(
		"display_name" => "Fishing",
		"post_list_style" => "tile",
		"children" => array(

			"bass" => array(
				"display_name" => "Bass",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"largemouth-bass" => array(
						"display_name" => "Largemouth Bass",
						"show_in_menu" => TRUE,
						"post_list_style" => "tile"
					),
					"smallmouth-bass" => array(
						"display_name" => "Smallmouth Bass",
						"show_in_menu" => TRUE,
						"post_list_style" => "tile"
					),
					"stripers" => array(
						"display_name" => "Stripers & Hybrids",
						"show_in_menu" => TRUE,
						"post_list_style" => "tile"
					)
				)
			),

			"catfish" => array(
				"display_name" => "Catfish",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"panfish" => array(
				"display_name" => "Panfish & Crappie",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"walleye" => array(
				"display_name" => "Walleye",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"trout" => array(
				"display_name" => "Trout",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"pike" => array(
				"display_name" => "Pike & Muskie",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"saltwater" => array(
				"display_name" => "Saltwater",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
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