class User{

	constructor(statusBtn = null, 
				table = null,
				usersTable = null, 
				ajax = null){

		//administrar usuarios
		//buscar
		this.searchUserBtn = colegio.getById('head-pageSearchBtn');
		this.searchForm = colegio.getById('head-pageSearchForm');
		this.searchTxt = colegio.getById('head-pageSearchTxt');

		
		//agregar
		this.newUserBtn = colegio.getById('head-pageNewRecord');
		this.addFormModal = colegio.getById('add-formModal');

		//actualizar
		this.setFormModal = colegio.getById('set-modal');

		this.ajaxMsg = null;
		this.tableContainer = null;
		this.statusBtn = statusBtn;
		this.table = table;
		this.usersTable = usersTable;
		this.ajax = ajax;
		
		
	}

	search_data(){

		let objectSelf = this;

		let dataForm = 	colegio.get_dataForm('one', this.searchTxt);

		let dataJson = 'request='+JSON.stringify({request:'search-user',
						data:dataForm});

		this.ajax.send_data({method:'post', 
							functionName:function(data){
								
								if(data.status == 'done'){

									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

									//cargar la tabla con los resultados

									let usersTable = objectSelf.usersTable;

									usersTable.set_table(data.data);

									colegio.innerHTML(objectSelf.tableContainer, usersTable.get_users_table());
									
									//botones de la tabla de resultados 

									usersTable.status_btn();//boton para cambiar estado
									
									usersTable.update_dataBtn((e) => {

										objectSelf.open_set_form(e);

									});//boton para editar informacin
									
									usersTable.del_btn((e) => {
						   		
						   				objectSelf.del_data(e);

									});//boton para borrar usuario
								
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
			console.log(dataForm);		
			
			let dataFormSend = colegio.get_dataForm('more', dataForm);
			
			let dataJson = 'request='+JSON.stringify({request:'add-user',
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

	open_set_form(e){

		let objectSelf = this;

		let btn = e.target;
   		
   		let id = btn.value;

		let dataForm = colegio.getByClass('set-data');
				
		let dataJson = 'request='+JSON.stringify({request:'get_data_setForm', idUser:id});

		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){

								if(data.status == 'done'){

										let getData = data.data;

										let dataUser = [];

										dataUser[0] = getData.usuario;
										dataUser[1] = getData.nombre;
										dataUser[2] = '';
										dataUser[3] = getData.email;
										dataUser[4] = getData.direccion;
										dataUser[5] = getData.telefono;
										dataUser[6] = getData.fechaNacimiento;
										dataUser[7] = getData.estado;
										dataUser[8] = id;																	
		
										colegio.openModal(objectSelf.setFormModal);

										colegio.load_data_onForm(dataForm, dataUser);

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

		let dataJson = 'request='+JSON.stringify({request:'del-data', idUser:id});
		
		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){

								if(data.status == 'done'){
									
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

									let usersTable = objectSelf.usersTable;

									let newData = usersTable.table.remove_row(id);

									usersTable.table.set_bodyTable(newData);

									colegio.innerHTML(objectSelf.tableContainer, usersTable.get_users_table());

									//botones de la tabla de resultados 

									usersTable.status_btn();//boton para cambiar estado
									
									usersTable.update_dataBtn((e) => {

										objectSelf.open_set_form(e);

									});//boton para editar informacin
									
									usersTable.del_btn((e) => {
						   		
						   				objectSelf.del_data(e);

									});//boton para borrar usuario
									
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

		let objectSelf = this;

		let dataForm = colegio.getByClass('set-data');

		let arrayData = [];
											
		let c = 0;	

		colegio.loop({target:dataForm, fn:function(d){

			arrayData[c] = d.value;
			c++;

		}});
		
		if(!colegio.empty(arrayData[1]) && !colegio.empty(arrayData[2])){

			colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.info('Hay campos vacios'));
		
		}else if(arrayData[1] != arrayData[2]){

			colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.info('Su password no coincide en confirmacion'));
		
		}else{
		
			let dataJson = 'request='+JSON.stringify({request:'set_password', data:arrayData});

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

	}

}