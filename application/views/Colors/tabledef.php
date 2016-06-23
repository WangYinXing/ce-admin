<script>
var tableW = $("#main-table").innerWidth();
var tbDef =  {
	name: "Colors",
	columns:[
		{display: 'Color name', name : 'name', width : 700, sortable : false, align: 'left'},
	],
	title: "Added colors"
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