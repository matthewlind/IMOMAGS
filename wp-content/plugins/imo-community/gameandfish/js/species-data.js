var speciesData = Array();
var speciesDataList = Array();

var allPostTypes = IMO_COMMUNITY_CONFIG.post_types;

for (var tertiaryPostTypeName in allPostTypes) {

	tertiaryPostType = allPostTypes[tertiaryPostTypeName]['children'];

	for (var secondaryPostTypeName in tertiaryPostType) {

		secondaryPostType = tertiaryPostType[secondaryPostTypeName]['children'];
		secondaryPostTypeData = tertiaryPostType[secondaryPostTypeName];

		if (secondaryPostType == undefined) {


			speciesData[secondaryPostTypeName] = Array();
			speciesData[secondaryPostTypeName].secondary = null;
			speciesData[secondaryPostTypeName].tertiary = tertiaryPostTypeName;
			speciesData[secondaryPostTypeName].display_name = secondaryPostTypeData.display_name;

			var speciesType = {};
			speciesType.post_type = secondaryPostTypeName;
			speciesType.secondary = null;
			speciesType.tertiary = tertiaryPostTypeName;
			speciesType.display_name = secondaryPostTypeData.display_name;

			speciesDataList.push(speciesType);
		}



		for (var postTypeName in secondaryPostType) {

			postType = secondaryPostType[postTypeName];

			speciesData[postTypeName] = Array();
			speciesData[postTypeName].secondary = secondaryPostTypeName;
			speciesData[postTypeName].tertiary = tertiaryPostTypeName;
			speciesData[postTypeName].display_name = postType.display_name;

			var speciesType = {};
			speciesType.post_type = postTypeName;
			speciesType.secondary = secondaryPostTypeName;
			speciesType.tertiary = tertiaryPostTypeName;
			speciesType.display_name = postType.display_name;

			speciesDataList.push(speciesType);

		}
	}
}

