// JavaScript Document

colegio.addEvent(window,'load', start_app);

function start_app(){

	let boxMsg = colegio.getById('ajaxMsgPage');
	let tableContainer = colegio.getById('table-records');

	let ajax = new Ajax();

	let statusBtn = new Status_btn(ajax);

	statusBtn.boxMsg = boxMsg;

	let table = new Table(colegio);
	let tableForSignatures = new Table(colegio);

	let signaturesTable = new Signatures_table(colegio, 
										 table, 
										 statusBtn);

	let signature = new Signature(statusBtn, 
							  	  tableForSignatures,
								  signaturesTable, 
								  ajax);

	signature.ajax.file = 'modules/materias/controllers/ajax/signatures_controller.php';

	signature.ajaxMsg = boxMsg; 

	signature.tableContainer = tableContainer;

	colegio.addEvent(signature.searchForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		signature.search_data();

	});

	colegio.addEvent(signature.newRecordBtn, 'click', function(){

		signature.open_addForm();

	});

	signature.start_addForm();	

}

