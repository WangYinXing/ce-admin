
function initTable() {
	$("#main-table").flexigrid({
		url: tbDef.name + '/ajax_list',
		dataType: 'json',
		colModel : tbDef.columns,
		buttons : [
			{name: 'Edit', bclass: 'edit', onpress : doCommand},
			{name: 'Delete', bclass: 'delete', onpress : doCommand},
			{separator: true}
		],
		searchitems : [
			{display: 'User name', name : 'username'},
			{display: 'email', name : 'email', isdefault: true},
		],
		sortname: "id",
		usepager: true,
		title: tbDef.title,
		useRp: true,
		rp: 10,
		showTableToggleBtn: false,
		resizable: true,
		singleSelect: true,
		onDoubleClick: onDblClick,
		height:$("#flexigridDiv").innerHeight()
    });

    $(".pSearch.pButton").hide();

    $(".btn-create").click(function() {
		window.location.assign(siteUrl + tbDef.name + "/edit/");
	});
	
	$(".btn-edit").click(function() {
		$(".fbutton .edit").click();
	});

	$(".btn-delete").click(function() {
		$(".fbutton .delete").click();
	});
};

function onDblClick(target, grid) {
	var index = $(target).attr("data-id");

	if (typeof index == "undefined") {
		alert("Can't open account.");
		return;
	}

	window.location.assign(siteUrl + tbDef.name + "/edit/" + index);
}
  
function doCommand(comm) {
	var selectedUser = $(".flexigrid .trSelected").attr("data-id");

	if (!selectedUser) {
		alert("Please select the record that is going to be modified.");
		return;
	}

	if (comm == "Edit") {
		window.location.assign(siteUrl + tbDef.name + "/edit/" + selectedUser);
	}
	else if (comm == "Delete") {
		if (!confirm("Are you sure to delete this account? You can't undo this action.")) {
			return;
		}

		window.location.assign(siteUrl + tbDef.name + "/del/" + selectedUser);
	}
}