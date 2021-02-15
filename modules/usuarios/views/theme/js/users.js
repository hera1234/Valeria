// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let boxMsg = colegio.getById('ajaxMsgPage');
	let tableContainer = colegio.getById('table-records');

	let ajax = new Ajax();

	let statusBtn = new Status_btn(ajax);

	statusBtn.boxMsg = boxMsg;

	let table = new Table(colegio);
	let tableForUsers = new Table(colegio);

	let usersTable = new Users_table(colegio, 
								     tableForUsers, 
								     statusBtn);

	let user = new User(statusBtn, 
					  	table,
					  	usersTable, 
					  	ajax);

	user.ajax.file = 'modules/usuarios/controllers/ajax/users_controller.php';

	user.ajaxMsg = boxMsg; 

	user.tableContainer = tableContainer;

	colegio.addEvent(user.searchForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		user.search_data();

	});

	colegio.addEvent(user.newUserBtn, 'click', function(){

		user.open_addForm();

	});	

}