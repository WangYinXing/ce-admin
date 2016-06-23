<script>


var tableW = $("#main-table").innerWidth();
var tbDef =  {
	name: "Systems",
	columns:[
		{display: 'System name', name : 'name', width : 500, sortable : false, align: 'left'},
		{display: 'System price / sq ft', name : 'saleprice', width : 200, sortable : false, align: 'left'},
		{display: 'Active', name : 'status', width : 200, sortable : false, align: 'left'},
		{display: 'Share', name : 'share', width : 200, sortable : false, align: 'left'},
	],
	title: "Added systems"
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