<script>
	var tableW = $("#main-table").innerWidth();
	var tbDef =  {
		name: "Accounts",
		columns:[
			{display: 'User name', name : 'username', width : 150, sortable : false, align: 'left'},
			{display: 'First name', name : 'firstname', width : 150, sortable : false, align: 'left'},
			{display: 'Last name', name : 'lastname', width : 150, sortable : false, align: 'left'},
			{display: 'Status', name : 'status', width : 150, sortable : false, align: 'left'},
			{display: 'Password type', name : 'passwordtype', width : 150, sortable : false, align: 'left'},
			{display: 'Role', name : 'role', width : 150, sortable : false, align: 'left'},
			{display: 'Verified', name : 'status', width : 100, sortable : false, align: 'left'},
		],
		title: "Registered accounts"
	};


$(function() {
	$(document).ready(function(evt) {
		$('.search-bar .query').change(function() {
			$("#main-table").flexOptions(
				{params: [
					{name: 'query', value:$(this).val()},
					{name: 'qtype', value:'username'},
				]}).flexReload();
		})
  	});
});


</script>