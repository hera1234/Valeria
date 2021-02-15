class Student{

	constructor(statusBtn = null, 
				table = null,
				studentTable = null, 
				ajax = null, 
				app = null){

		//buscar
		this.searchStudentBtn = colegio.getById('head-pageSearchBtn');//boton buscar 
		this.searchForm = colegio.getById('head-pageSearchForm');//formulario buscar
		this.searchTxt = colegio.getById('head-pageSearchTxt');//input donde se introduce la busqueda

		
		//agregar
		this.newStudentBtn = colegio.getById('head-pageNewRecord');//boton para abrir formulario de registro

		//actualizar
		this.addFormModal = colegio.getById('add-formModal');//formulario para registrar
		this.setFormModal = colegio.getById('set-modal');//formulario para editar

		this.signaturesListModal = colegio.getById('signatures-listModal');

		
		this.ajaxMsg = null;
		this.tableContainer = null;
		this.signatureTable = null;

		this.app = app;
		this.ajax = ajax;
		this.statusBtn = statusBtn;
		this.table = table;
		this.studentTable = studentTable;
		
	}

	search_student(){

		let objectSelf = this;

		let dataForm = 	colegio.get_dataForm('one', this.searchTxt);

		let dataJson = 'request='+JSON.stringify({request:'search-student',
						data:dataForm});

		this.ajax.send_data({method:'post', 
							functionName:function(data){
								
								if(data.status == 'done'){

									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

									//cargar la tabla con los resultados

									let studentTable = objectSelf.studentTable;

									studentTable.set_table(data.data);

									let loadedStudentTable = 

									colegio.innerHTML(objectSelf.tableContainer, studentTable.get_student_table());

									
									//botones de la tabla de resultados 

									studentTable.status_btn();//boton para cambiar estado
									
									studentTable.show_signaturesBtn((e) => {

										objectSelf.open_signatures_list(e);

									});//boton para ver materias

									studentTable.update_dataBtn((e) => {

										objectSelf.open_set_form(e);

									});//boton para editar informacin
									
									studentTable.del_btn((e) => {
						   		
						   				objectSelf.del_data(e);

									});//boton para borrar alumno
								
								}else{
								
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}
								
							},
							data:dataJson});

	}

	open_addForm(){

		let objectSelf = this;

		colegio.openModal(this.addFormModal);

		let addBtn = colegio.getById('save-data');

		colegio.addEvent(addBtn, 'click', function(e){

			colegio.preventDefault(e);

			let dataForm = colegio.getByClass('addData');

			let dataFormSend = colegio.get_dataForm('more', dataForm);
					
			let dataJson = 'request='+JSON.stringify({request:'add-student',
							data:dataFormSend});

			objectSelf.ajax.send_data({method:'post', 
							    functionName:function(data){
							
									if(data.status == 'done'){

										colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

										colegio.clean_form_controls(dataForm, 'moreOne');
									
									}else{
									
										colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
										
										console.log(data.data);	
									
									}

									colegio.closeModal(objectSelf.addFormModal);
									
								},
								data:dataJson});

		})

		let closeBtn = colegio.getById('close-formBtn');

		colegio.addEvent(closeBtn, 'click', (e) => {

			colegio.preventDefault(e);
			colegio.closeModal(objectSelf.addFormModal);
		
		});
	
	}

	open_signatures_list(e){

		let objectSelf = this;

		let btn = e.target;
   		
   		let id = btn.value;

   		colegio.openModal(objectSelf.signaturesListModal);

   		objectSelf.load_student_signatures(id);

   		let closeBtn = colegio.getById('close-signaturesList');

		colegio.addEvent(closeBtn, 'click', function(e){

			colegio.preventDefault(e);
			colegio.closeModal(objectSelf.signaturesListModal);
		
		});

	}


	load_student_signatures(studentId = 0){

		if(studentId != 0){

			this.studentId = studentId;

			let dataJson = 'request='+JSON.stringify({request:'get-signaturesList',
							studentId:studentId});

			this.signaturesList = colegio.getById('signatures-list');			
			
			this.ajax.send_data({method:'post', 
								    functionName: (data) => {

										if(data.status == 'done'){									

											//cargar la tabla con los resultados
											let table = this.table;

											table.set_iniTable('<table class="signatures-listTable">');

											table.set_headerTable(`<tr>
																		<th>Grado</th>
																		<th>Grupo</th>
																		<th>Materia</th>
																		<th>Profesor</th>
																	</tr>`);

											let rows = table.do_rows(data.data, (row) => {

												let rows = `<td>${row.levelName}</td>
					  										<td>${row.groupName}</td>
					  										<td>${row.signatureName}</td>
					  										<td>${row.teacherName}</td>`;

							  					return rows;

											});

											table.set_bodyTable(rows);//cargar las materias en la tabla

											this.app.innerHTML(this.signaturesList, table.get_table());									
										
										}else{
										
											if(data.status == 'error'){
											
												this.app.innerHTML(this.ajaxMsg, this.app.msg.msg_type(data.status, data.notice));
											
											}
											
											this.app.innerHTML(this.signaturesList, '<div class="no-dataTableMsg">Sin materias registradas</div>');
			
											console.log(data.data);

										}
										
									},
									data:dataJson});
		
		}else{

			return false;
		
		}

	}


	open_set_form(e){

		let objectSelf = this;

		let btn = e.target;
   		
   		let id = btn.value;

		let dataForm = colegio.getByClass('set-data');
				
		let dataJson = 'request='+JSON.stringify({request:'get_data_setForm', idStudent:id});

		colegio.openModal(objectSelf.setFormModal);


		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){
						    	
						    	if(data.status == 'done'){

										let getData = data.data;

										let dataStudent = [];

										dataStudent[0] = getData.nombre;
										dataStudent[1] = getData.fechaDeNacimiento;
										dataStudent[2] = getData.matricula;
										dataStudent[3] = getData.padre;
										dataStudent[4] = getData.madre;
										dataStudent[5] = getData.direccion;
										dataStudent[6] = getData.telefono;
										dataStudent[7] = getData.grupo;
										dataStudent[8] = getData.estado;
										dataStudent[9] = id;																	
												
										//cargar los datos en el formulario
										colegio.load_data_onForm(dataForm, dataStudent);

										let setBtn = colegio.getById('set-dataBtn');

										colegio.addEvent(setBtn, 'click', function(e){

											colegio.preventDefault(e);

											let arrayData = []//array para los datos que se enviaran;
											
											let c = 0;	

											colegio.loop({target:dataForm, fn:function(d){

												//llenar el array con los datos que se enviaran

												arrayData[c] = d.value;
												
												c++;
											
											}});

											objectSelf.set_data(arrayData);

										});

										let closeBtn = colegio.getById('close-setFormBtn');
										
										colegio.addEvent(closeBtn, 'click', (e) =>{

											e.preventDefault();
											colegio.closeModal(objectSelf.setFormModal);

										});
										
									
								}else{
								
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}
								
							},
							data:dataJson});

	}

	set_data(arrayData = ''){

		//mandar los datos para actualizar 
		
		let objectSelf = this;

		let dataJson = 'request='+JSON.stringify({request:'set_data', data:arrayData});

		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){

								if(data.status == 'done'){
									
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

								}else{
								
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}

								colegio.closeModal(objectSelf.setFormModal);
								
							},
							data:dataJson});

	}

	del_data(e){

		let btn = colegio.preventDefault(e);

		let id = btn.value;

		let objectSelf = this;

		let dataJson = 'request='+JSON.stringify({request:'del-data', idStudent:id});
		
		objectSelf.ajax.send_data({method:'post', 
						    	  functionName:function(data){

									if(data.status == 'done'){
										
										colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

										let studentTable = objectSelf.studentTable;

										let newData = studentTable.table.remove_row(id);

										studentTable.table.set_bodyTable(newData);

										colegio.innerHTML(objectSelf.tableContainer, studentTable.get_student_table());

										//botones de la tabla de resultados 

										studentTable.status_btn();//boton para cambiar estado
										
										studentTable.show_signaturesBtn((e) => {

											objectSelf.open_signatures_list(e);

										});//boton para ver materias

										studentTable.update_dataBtn((e) => {

											objectSelf.open_set_form(e);

										});//boton para editar informacin
										
										studentTable.del_btn((e) => {
							   		
							   				objectSelf.del_data(e);

										});//boton para borrar alumno
										
									}else{
									
										colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
										
										console.log(data.data);	
									
									}

									colegio.closeModal(objectSelf.addFormModal);
									
								},
								data:dataJson});

	}

}