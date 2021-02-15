// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let user = new User();
	
	user.ajax = new Ajax();

	user.ajax.file = 'modules/usuarios/controllers/ajax/acount_controller.php';

	user.ajaxMsg = colegio.getById('ajax-msgPage');

	let setForm = colegio.getById('set-form');

	colegio.addEvent(setForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		user.set_acount();

	});

}