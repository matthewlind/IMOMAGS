	
	var postListParams = {
		post_type : "all", // e.g. "report","question"
		secondary_post_type : null,
		state : null, // e.g. "GA","NY"
		skip : 0, //Start Number
		per_page : 20,
		domain: null,
		require_images : 0, //Only return posts with images, use 1 or 0
		order_by : "id", //e.g. "created","view_count"
		sort : "DESC"
	};
	
