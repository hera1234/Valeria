// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let teacher = new Teacher();
	
	teacher.ajax = new Ajax();

	teacher.ajax.file = 'modules/profesores/controllers/ajax/acount_controller.php';

	teacher.ajaxMsg = colegio.getById('ajax-msgPage');

	let setForm = colegio.getById('set-form');

	colegio.addEvent(setForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		teacher.set_acount();

	});

}