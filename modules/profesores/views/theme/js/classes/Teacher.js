class Teacher{

	constructor(statusBtn = null, 
			    table = null,
			    teacherTable = null, 
			    ajax = null,
			    app = null){

		//buscar
		this.searchTeacherBtn = colegio.getById('head-pageSearchBtn');
		this.searchForm = colegio.getById('head-pageSearchForm');
		this.searchTxt = colegio.getById('head-pageSearchTxt');
		
		//agregar
		this.newTeacherBtn = colegio.getById('head-pageNewRecord');

		//actualizar
		this.addFormModal = colegio.getById('add-formModal');
		this.setFormModal = colegio.getById('set-modal');
		this.signaturesListModal = colegio.getById('signatures-listModal');
		this.addSignaturesModal = colegio.getById('add-signaturesModal');
		this.infoModal = colegio.getById('info-modal');

		this.ajaxMsg = null;
		this.tableContainer = null;
		this.teacherId = '';
		this.data = '';
		this.signaturesList = null;//contenedor de la lista de materias asignadas al profesor
		
		this.statusBtn = statusBtn;
		this.table = table;
		this.teacherTable = teacherTable;
		this.ajax = ajax;
		this.app = app;
		
	}

	search_data(){

		let objectSelf = this;

		let dataForm = 	colegio.get_dataForm('one', this.searchTxt);

		let dataJson = 'request='+JSON.stringify({request:'search-teacher',
						data:dataForm});

		this.ajax.send_data({method:'post', 
							functionName:function(data){
								
								if(data.status == 'done'){

									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

									//cargar la tabla con los resultados

									let teacherTable = objectSelf.teacherTable;

									teacherTable.set_table(data.data);

									colegio.innerHTML(objectSelf.tableContainer, teacherTable.get_teacher_table());
									
									//botones de la tabla de resultados 

									teacherTable.status_btn();//boton para cambiar estado

									teacherTable.list_btn((e) => {

										objectSelf.open_signatures_list(e);

									});//lista de materias

									teacherTable.add_signature_btn((e) => {

										objectSelf.open_add_signaturesForm(e);

									});//agregar materia
									
									teacherTable.info_btn((e) => {

										objectSelf.open_info_modal(e);

									});//ver informacion
									
									teacherTable.update_dataBtn((e) => {

										objectSelf.open_set_form(e);
									
									});//actualizar

									teacherTable.del_btn((e) => {

										objectSelf.del_data(e);

									});//borrar profesor
								
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

			let dataForm = colegio.getByClass('add-data');
			
			let dataFormSend = colegio.get_dataForm('more', dataForm);
			
			let dataJson = 'request='+JSON.stringify({request:'add-teacher',
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

		colegio.addEvent(closeBtn, 'click', function(e){

			colegio.preventDefault(e);
			colegio.closeModal(objectSelf.addFormModal);
		
		});
	
	}

	open_signatures_list(e){

		let objectSelf = this;

		let btn = e.target;
   		
   		let id = btn.value;

   		colegio.openModal(objectSelf.signaturesListModal);

   		objectSelf.load_teacher_signatures(id);

   		let closeBtn = colegio.getById('close-signaturesList');

		colegio.addEvent(closeBtn, 'click', function(e){

			colegio.preventDefault(e);
			colegio.closeModal(objectSelf.signaturesListModal);
		
		});

	}

	del_signature_ofList(delBtn = null){

		//borrar la materia de la lista de materias
		if(delBtn == null){

			console.log('Falta referencia en boton para eliminar materia de la lista');

		}else{

			let objectSelf = this;

			colegio.add_events({target:delBtn, 
				  		       eventName:'click', 
						       functionName:function(e){

						       		let delBtnVal = e.target.value;
						       		delBtnVal = delBtnVal.split('||');
						       		let regId = delBtnVal[0];
						       		let signatureId = delBtnVal[1];

									let dataJson = 'request='+JSON.stringify({request:'del-signatureOfList',
													teacherId:objectSelf.teacherId,
													signatureId:regId});
	
									objectSelf.ajax.send_data({method:'post', 
														    functionName:function(data){

																if(data.status == 'done'){

																	colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));
																	
																	//remover fila eliminada de la tabla
																	let newData = objectSelf.table.remove_row(signatureId, () => {

																		colegio.innerHTML(objectSelf.signaturesList, 'Sin materias registradas');
																	
																	});

																	objectSelf.table.set_bodyTable(newData);

																	colegio.innerHTML(objectSelf.signaturesList, objectSelf.table.get_table());
												
																	let delBtn = colegio.getByClass('quit-btn');

																	objectSelf.del_signature_ofList(delBtn);

																}else{
																
																	
																	colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
															
									
																	console.log(data.data);

																}
																
															},
															data:dataJson});
						   		 
							  }});

		}

	}

	load_teacher_signatures(teacherId = 0){

		let objectSelf = this;

		if(teacherId != 0){

			objectSelf.teacherId = teacherId;

			let dataJson = 'request='+JSON.stringify({request:'get-teacherSignatures',
							teacherId:teacherId});

			objectSelf.signaturesList = colegio.getById('signatures-list');			
			
			this.app.innerHTML(this.signaturesList, '');

			objectSelf.ajax.send_data({method:'post', 
								    functionName:function(data){

										if(data.status == 'done'){									

											//cargar la tabla con los resultados
		
											let table = objectSelf.table;

											table.set_headerTable(`<tr>
																		<th>Materia</th>
																		<th>Grado</th>
																		<th>Grupo</th>
																		<th class="thDer">Quitar</th>
																	</tr>`);

											table.set_bodyTable(data.data);

											colegio.innerHTML(objectSelf.signaturesList, table.get_table());									

											let delBtn = colegio.getByClass('quit-btn');

											objectSelf.del_signature_ofList(delBtn);
										
										}else{
										
											if(data.status == 'error'){
											
												colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
											
											}
											
											colegio.innerHTML(objectSelf.signaturesList, '<div class="no-dataTableMsg">Sin materias registradas</div>');
			
											console.log(data.data);

										}
										
									},
									data:dataJson});
		
		}else{

			return false;
		
		}

	}

	start_add_signatureForm(){

		let objectSelf = this;

		let signature = colegio.getById('materia-profesor');
		
		let group = colegio.getById('grupo-profesor');

   		let addSignatureCtrls = colegio.getByClass('add-signature');

   		let level = colegio.getById('grado-materia');

   		colegio.addEvent(level, 'change', (e) => {

   			let value = e.target.value;

			let dataJson = 'request='+JSON.stringify({request:'load-selectSignatures',
							levelId:value});
			
			objectSelf.ajax.send_data({method:'post', 
								    functionName:function(data){
										
										let dataOptions = data.data;

										if(dataOptions.signatures.status == 'done' && 	
										   dataOptions.groups.status){	

											//cargamos en el control select las materias correspondientes al grado
									   		colegio.innerHTML(signature, dataOptions.signatures.data);
									   		colegio.innerHTML(group, dataOptions.groups.data);
										
										}else{
										
											colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.signatures.status, data.signature+notice)+
																				  colegio.msg.msg_type(data.groups.status, data.groups.notice));
											
											console.log(data.data);
											return false;	
										
										}
										
									},
									data:dataJson});


   		});

   		let addSignature = colegio.getById('add-signatureBtn');

   		colegio.addEvent(addSignature, 'click', (e) => {

   			e.preventDefault();

			let dataJson = 'request='+JSON.stringify({request:'add-teacherSignature',
							teacherId:objectSelf.teacherId,
							signatureId:signature.value,
							groupId:group.value,
							levelId:level.value});
			
			objectSelf.ajax.send_data({method:'post', 
								    functionName:function(data){
	
										if(data.status == 'done'){

											colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));
									   		
									   		colegio.clean_form_controls(addSignatureCtrls, 'moreOne');

										}else{
										
											colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
											
											console.log(data.data);
										
										}

										colegio.closeModal(objectSelf.addSignaturesModal);
										
									},
									data:dataJson});

		
		});

		let closeBtn = colegio.getById('close-addSignaturesBtn');

		colegio.addEvent(closeBtn, 'click', function(e){

			colegio.preventDefault(e);
			colegio.closeModal(objectSelf.addSignaturesModal);

		});
	}

	open_add_signaturesForm(e){

		let btn = e.target;
   		
   		this.teacherId = btn.value;

   		colegio.openModal(this.addSignaturesModal);

	}

	open_info_modal(e){

		let objectSelf = this;

		let btn = e.target;
   		
   		let id = btn.value;

   		colegio.openModal(objectSelf.infoModal);

   		objectSelf.load_teacher_info(id);

   		let closeBtn = colegio.getById('close-infoModal');

		colegio.addEvent(closeBtn, 'click', function(e){

			colegio.preventDefault(e);
			colegio.closeModal(objectSelf.infoModal);
		
		});

	}

	load_teacher_info(teacherId = 0){

		let objectSelf = this;

		if(teacherId != 0){

			objectSelf.teacherId = teacherId;

			let dataJson = 'request='+JSON.stringify({request:'get-teacherInfo',
							teacherId:teacherId});

			let infoWrap = colegio.getById('info-wrap');	

			this.app.innerHTML();		
			
			objectSelf.ajax.send_data({method:'post', 
								    functionName:function(data){

										if(data.status == 'done'){									

											colegio.innerHTML(infoWrap, data.data);

										}else{
										
											if(data.status == 'error'){
											
												colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
											
											}
											
											colegio.innerHTML(objectSelf.signaturesList, '<p>Sin materias registradas</p>');
			
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
				
		let dataJson = 'request='+JSON.stringify({request:'get_data_setForm', idTeacher:id});

		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){

								if(data.status == 'done'){

										let getData = data.data;

										let dataTeacher = [];

										dataTeacher[0] = getData.usuario;
										dataTeacher[1] = getData.nombre;
										dataTeacher[2] = '';
										dataTeacher[3] = getData.email;
										dataTeacher[4] = getData.direccion;
										dataTeacher[5] = getData.telefono;
										dataTeacher[6] = getData.fechaNacimiento;
										dataTeacher[7] = getData.estado;
										dataTeacher[8] = id;																	
		
										colegio.openModal(objectSelf.setFormModal);

										colegio.load_data_onForm(dataForm, dataTeacher);

										let setBtn = colegio.getById('set-dataBtn');

										colegio.addEvent(setBtn, 'click', function(e){

											colegio.preventDefault(e);

											let arrayData = [];
											
											let c = 0;	

											colegio.loop({target:dataForm, fn:function(d){

												arrayData[c] = d.value;
												c++;

											}});

											objectSelf.set_data(arrayData);

										});

										let closeBtn = colegio.getById('close-setFormBtn');
										
										colegio.addEvent(closeBtn, 'click', (e) => {

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

		let dataJson = 'request='+JSON.stringify({request:'del-data', idTeacher:id});
	
		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){

								if(data.status == 'done'){
									
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

									let teacherTable = objectSelf.teacherTable;

									let newData = teacherTable.table.remove_row(id);

									teacherTable.table.set_bodyTable(newData);

									colegio.innerHTML(objectSelf.tableContainer, teacherTable.table.get_table());
									
									//botones de la tabla de resultados 
									teacherTable.status_btn();//boton para cambiar estado

									teacherTable.list_btn((e) => {

										objectSelf.open_signatures_list(e);

									});//lista de materias

									teacherTable.add_signature_btn((e) => {

										objectSelf.open_add_signaturesForm(e);

									});//agregar materia
									
									teacherTable.info_btn((e) => {

										objectSelf.open_info_modal(e);

									});//ver informacion
									
									teacherTable.update_dataBtn((e) => {

										objectSelf.open_set_form(e);
									
									});//actualizar

									teacherTable.del_btn((e) => {

										objectSelf.del_data(e);

									});//borrar profesor
								

								}else{
								
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}

								colegio.closeModal(objectSelf.addFormModal);
								
							},
							data:dataJson});

	}

		//actualizar datos de cuenta
	set_acount(){

		let objectSelf = this;

		let dataForm = colegio.getByClass('set-data');

		let arrayData = [];
											
		let c = 0;	

		colegio.loop({target:dataForm, fn:function(d){

			arrayData[c] = d.value;
			c++;

		}});
		
		let dataJson = 'request='+JSON.stringify({request:'set_acount', data:arrayData});

		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){

								if(data.status == 'done'){
									
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));
	
								}else{
								
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}
								
							},
							data:dataJson});

	}

	//cambiar password
	set_password(){

		let dataForm = colegio.getByClass('set-data');

		let arrayData = [];
											
		let c = 0;	

		this.app.loop({target:dataForm, fn:(d) => {

			arrayData[c] = d.value;
			c++;

		}});
		
		if(!this.app.empty(arrayData[1]) && !this.app.empty(arrayData[2])){

			this.app.innerHTML(this.ajaxMsg, this.app.msg.info('Hay campos vacios'));
		
		}else if(arrayData[1] != arrayData[2]){

			this.app.innerHTML(this.ajaxMsg, this.app.msg.info('Su password no coincide en confirmacion'));
		
		}else{
		
			let dataJson = 'request='+JSON.stringify({request:'set_password', data:arrayData});

			this.ajax.send_data({method:'post', 
							    functionName:(data) =>{

									if(data.status == 'done'){
										
										this.app.innerHTML(this.ajaxMsg, this.app.msg.success(data.notice));

										this.app.clean_form_controls(dataForm, 'moreOne');
									}else{
									
										this.app.innerHTML(this.ajaxMsg, this.app.msg.msg_type(data.status, data.notice));
										
										console.log(data.data);	
									
									}
									
								},
								data:dataJson});

		}

	}



}