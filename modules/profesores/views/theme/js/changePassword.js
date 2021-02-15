// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let ajax = new Ajax();

	let teacher = new Teacher(null, 
							  null,
							  null, 
							  ajax,
							  colegio);

	teacher.ajax.file = 'modules/profesores/controllers/ajax/change_password_controller.php';

	teacher.ajaxMsg = colegio.getById('ajax-msgPage');

	let setForm = colegio.getById('set-form');

	colegio.addEvent(setForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		teacher.set_password();

	});

}