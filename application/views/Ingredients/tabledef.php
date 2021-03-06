<script>
var tableW = $("#main-table").innerWidth();
var tbDef =  {
	name: "Ingredients",
	columns:[
		{display: 'Ingredient name', name : 'name', width : 500, sortable : false, align: 'left'},
		{display: 'Coverage Area', name : 'coverage', width : 200, sortable : false, align: 'left'},
		{display: 'Purchase Price', name : 'purchaseprice', width : 200, sortable : false, align: 'left'},
	],
	title: "Added ingredients"
};

$(function() {
	$(document).ready(function(evt) {
		$('.search-bar .query').change(function() {
			$("#main-table").flexOptions(
				{params: [
					{name: 'query', value:$(this).val()},
					{name: 'qtype', value:'name'},
				]}).flexReload();
		})
  	});
});
</script>