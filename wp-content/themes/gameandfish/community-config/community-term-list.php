<?php


//This Post Types array is used in multiple configurations
$gfPostTypes = array(

	"hunting" => array(
		"display_name" => "Hunting",
		"slug" => "hunting",
		"post_list_style" => "tile",
		"show_in_menu" => TRUE,
		"children" => array(

			"big-game" => array(
				"display_name" => "Big Game",
				"slug" => "big-game",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"bear" => array(
						"display_name" => "Bear",
						"slug" => "bear",
						"post_list_style" => "tile",
						"show_in_menu" => TRUE
					),
					"elk" => array(
						"display_name" => "Elk",
						"slug" => "elk",
						"post_list_style" => "tile",
						"show_in_menu" => TRUE
					),
					"moose" => array(
						"display_name" => "Moose",
						"slug" => "moose",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)
				)
			),

			"deer" => array(
				"display_name" => "Deer",
				"slug" => "deer",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"whitetail" => array(
						"display_name" => "Whitetail",
						"slug" => "whitetail",
						"post_list_style" => "tile",
						"show_in_menu" => TRUE
					),
					"mule-deer" => array(
						"display_name" => "Mule Deer",
						"slug" => "mule-deer",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"blacktail" => array(
						"display_name" => "Blacktail",
						"slug" => "blacktail",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),



			"hogs" => array(
				"display_name" => "Hogs",
				"slug" => "hogs",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE

			),

			"turkey" => array(
				"display_name" => "Turkey",
				"slug" => "turkey",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),




			"predators" => array(
				"display_name" => "Predators",
				"slug" => "predators",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"cougars" => array(
						"display_name" => "Cougars",
						"slug" => "cougars",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"coyotes" => array(
						"display_name" => "Coyotes",
						"slug" => "coyotes",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"wolves" => array(
						"display_name" => "Wolves",
						"slug" => "wolves",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),



			"small-game" => array(
				"display_name" => "Small Game",
				"slug" => "small-game",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"rabbits" => array(
						"display_name" => "Rabbits",
						"slug" => "rabbits",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"squirrels" => array(
						"display_name" => "Squirrels",
						"slug" => "squirrels",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),




			"upland-bird" => array(
				"display_name" => "Upland Bird",
				"slug" => "upland-bird",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"doves" => array(
						"display_name" => "Doves",
						"slug" => "doves",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"pheasants" => array(
						"display_name" => "Pheasants",
						"slug" => "pheasants",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			),

			"waterfowl" => array(
				"display_name" => "Waterfowl",
				"slug" => "waterfowl",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"duck" => array(
						"display_name" => "Duck",
						"slug" => "duck",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					),
					"goose" => array(
						"display_name" => "Geese",
						"slug" => "geese",
						"post_list_style" => "tile",
						"show_in_menu" => FALSE
					)

				)
			)


		)
	),

	"fishing" => array(
		"display_name" => "Fishing",
		"slug" => "fishing",
		"post_list_style" => "tile",
		"show_in_menu" => TRUE,
		"children" => array(

			"bass" => array(
				"display_name" => "Bass",
				"slug" => "bass",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE,
				"children" => array(

					"largemouth-bass" => array(
						"display_name" => "Largemouth Bass",
						"slug" => "largemouth-bass",
						"show_in_menu" => TRUE,
						"post_list_style" => "tile"
					),
					"smallmouth-bass" => array(
						"display_name" => "Smallmouth Bass",
						"slug" => "smallmouth-bass",
						"show_in_menu" => TRUE,
						"post_list_style" => "tile"
					),
					"stripers" => array(
						"display_name" => "Stripers & Hybrids",
						"slug" => "stripers",
						"show_in_menu" => TRUE,
						"post_list_style" => "tile"
					)
				)
			),

			"catfish" => array(
				"display_name" => "Catfish",
				"slug" => "catfish",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"panfish" => array(
				"display_name" => "Panfish & Crappie",
				"slug" => "panfish",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"walleye" => array(
				"display_name" => "Walleye",
				"slug" => "walleye",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"trout" => array(
				"display_name" => "Trout",
				"slug" => "trout",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"pike" => array(
				"display_name" => "Pike & Muskie",
				"slug" => "pike",
				"post_list_style" => "tile",
				"show_in_menu" => TRUE
			),
			"saltwater" => array(
				"display_name" => "Saltwater",
				"slug" => "saltwater",
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