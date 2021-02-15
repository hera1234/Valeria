// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let boxMsg = colegio.getById('ajaxMsgPage');
	let tableContainer = colegio.getById('table-records');

	let ajax = new Ajax();

	let statusBtn = new Status_btn(ajax);

	statusBtn.boxMsg = boxMsg;

	let table = new Table(colegio);
	let tableForGroups = new Table(colegio);

	let groupsTable = new Groups_table(colegio, 
									   tableForGroups, 
									   statusBtn);
	let group = new Group(statusBtn, 
						  table,
						  groupsTable, 
						  ajax);

	group.ajax.file = 'modules/grupos/controllers/ajax/groups_controller.php';

	group.ajaxMsg = boxMsg; 

	group.tableContainer = tableContainer;

	group.ajaxMsg = boxMsg;

	group.tableContainer = tableContainer;

	colegio.addEvent(group.searchForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		group.search_data();

	});

	colegio.addEvent(group.newRecordBtn, 'click', function(){

		group.open_addForm();

	});

	group.start_addForm();	

}
