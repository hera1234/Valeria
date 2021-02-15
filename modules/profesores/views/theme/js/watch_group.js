// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let qualification = new Qualification(colegio);
	
	qualification.ajax = new Ajax();

	qualification.ajax.file = 'modules/profesores/controllers/ajax/watch_group_controller.php';

	qualification.ajaxMsg = colegio.getById('ajaxMsgPage');

	qualification.tableContainer = colegio.getById('table-records');
	
	qualification.start_qualificationForm();
	
	colegio.add_events({target:qualification.qualificationBtn, eventName:'click', functionName:function(e){

		qualification.open_qualificationForm(e);

	}});	

}