// JavaScript Document

colegio.addEvent(window, 'load', start_app);

function start_app(){

	let boxMsg = colegio.getById('ajaxMsgPage');
	let tableContainer = colegio.getById('table-records');

	let ajax = new Ajax();

	let statusBtn = new Status_btn(ajax);

	statusBtn.boxMsg = boxMsg;

	let table = new Table(colegio);
	let tableForTeachers = new Table(colegio);

	let teacherTable = new Teacher_table(colegio, 
										 tableForTeachers, 
										 statusBtn);

	let teacher = new Teacher(statusBtn, 
							  table,
							  teacherTable, 
							  ajax, 
							  colegio);
	
	teacher.ajax.file = 'modules/profesores/controllers/ajax/teacher_controller.php';

	teacher.ajaxMsg = boxMsg;

	teacher.tableContainer = tableContainer;

	teacher.start_add_signatureForm();
	//this.start_add_signatureForm();

	colegio.addEvent(teacher.searchForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		teacher.search_data();

	});

	colegio.addEvent(teacher.newTeacherBtn, 'click', function(){

		teacher.open_addForm();

	});	

}