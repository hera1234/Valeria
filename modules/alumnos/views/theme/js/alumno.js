// JavaScript Document

colegio.addEvent(window,'load',iniciarAlumno);

function iniciarAlumno(){

	let boxMsg = colegio.getById('ajaxMsgPage');
	let tableContainer = colegio.getById('table-records');

	let ajax = new Ajax();

	let statusBtn = new Status_btn(ajax);

	statusBtn.boxMsg = boxMsg;

	let table = new Table(colegio);
	let tableForStudents = new Table(colegio);

	let studentTable = new Student_table(colegio, 
										 table, 
										 statusBtn);

	let student = new Student(statusBtn, 
							  tableForStudents,
							  studentTable, 
							  ajax, 
							  colegio);

	student.ajax.file = 'modules/alumnos/controllers/ajax/student_controller.php';

	student.ajaxMsg = boxMsg; 

	student.tableContainer = tableContainer;

	colegio.addEvent(student.searchForm, 'submit', function(e){

		let target = colegio.preventDefault(e);

		student.search_student();

	});

	colegio.addEvent(student.newStudentBtn, 'click', function(){

		student.open_addForm();

	});	

}