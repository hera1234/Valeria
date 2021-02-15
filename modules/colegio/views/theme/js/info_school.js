// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let school  = new School();
	
	school.ajax = new Ajax();

	//url del fichero que procesa las peticiones 
	school.ajax.file = 'modules/colegio/controllers/ajax/info_school_controller.php';

	school.ajaxMsg = colegio.getById('ajax-msgPage');

	colegio.addEvent(school.setInfoBtn, 'click', function(){

		school.open_set_form();

	});
	
	school.start_set_form();	

}