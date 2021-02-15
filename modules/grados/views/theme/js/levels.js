// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let boxMsg = colegio.getById('ajaxMsgPage');
	let tableContainer = colegio.getById('table-records');

	let ajax = new Ajax();

	let statusBtn = new Status_btn(ajax);

	statusBtn.boxMsg = boxMsg;

	let table = new Table(colegio);
	let tableForLevels = new Table(colegio);

	let levelTable = new Level_table(colegio, 
									 tableForLevels, 
									 statusBtn);
	let level = new Level(statusBtn, 
						  table,
						  levelTable, 
						  ajax);

	level.ajax.file = 'modules/grados/controllers/ajax/levels_controller.php';

	level.ajaxMsg = boxMsg; 

	level.tableContainer = tableContainer;

	level.ajaxMsg = boxMsg;

	level.tableContainer = tableContainer;

	colegio.addEvent(level.searchForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		level.search_data();

	});

	colegio.addEvent(level.newRecordBtn, 'click', function(){

		level.open_addForm();

	});

	level.start_addForm();	

}
