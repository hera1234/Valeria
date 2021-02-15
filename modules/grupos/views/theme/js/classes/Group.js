class Group{

	constructor(statusBtn = null, 
				table = null,
				groupsTable = null, 
				ajax = null){

		console.log('test');

		//buscar
		this.searchRecordsBtn = colegio.getById('head-pageSearchBtn');//BOTON PARA BUSCAR ALUMNOS
		this.searchForm = colegio.getById('head-pageSearchForm');//Formulario parar buscar alumnos
		this.searchTxt = colegio.getById('head-pageSearchTxt');

		//agregar
		this.newRecordBtn = colegio.getById('head-pageNewRecord');

		//actualizar
		this.addFormModal = colegio.getById('add-formModal');
		this.setFormModal = colegio.getById('set-modal');

		this.ajaxMsg = null;
		this.tableContainer = null;

		this.ajax = ajax;
		this.statusBtn = statusBtn;
		this.table = table;
		this.groupsTable = groupsTable;
	
	}

	search_data(){

		let objectSelf = this;

		let dataForm = 	colegio.get_dataForm('one', this.searchTxt);

		let dataJson = 'request='+JSON.stringify({request:'search-group',
						data:dataForm});

		this.ajax.send_data({method:'post', 
							functionName:function(data){
								
								if(data.status == 'done'){

									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

									let groupsTable = objectSelf.groupsTable;

									groupsTable.set_table(data.data);

									//cargar la tabla con los resultados
									colegio.innerHTML(objectSelf.tableContainer, groupsTable.get_groups_table());
									
									//botones de la tabla de resultados 

									groupsTable.status_btn();//boton para cambiar estado
									
									groupsTable.update_dataBtn((e) => {

										objectSelf.open_set_form(e);

									});//boton para editar informacin
									
									groupsTable.del_btn((e) => {
						   		
						   				objectSelf.del_data(e);

									});//boton para borrar grupos
								
								}else{
								
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}
								
							},
							data:dataJson});

	}

	start_addForm(){

		let objectSelf = this ;

		let addBtn = colegio.getById('save-data');

		colegio.addEvent(addBtn, 'click', function(e){

			objectSelf.add_record(e);

		});

		let closeBtn = colegio.getById('close-formBtn');

		colegio.addEvent(closeBtn, 'click', function(e){

			colegio.preventDefault(e);

			colegio.closeModal(objectSelf.addFormModal);
		
		});

	}

	open_addForm(){

		colegio.openModal(this.addFormModal);
	
	}

	add_record(e){

		let objectSelf = this;

		colegio.preventDefault(e);

		let dataForm = colegio.getByClass('add-data');
	
		let dataFormSend = colegio.get_dataForm('more', dataForm);
		
		let dataJson = 'request='+JSON.stringify({request:'add-signature',
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


	}

	open_set_form(e){

		let objectSelf = this;

		let btn = e.target;
   		
   		let id = btn.value;

		let dataForm = colegio.getByClass('set-data');
				
		let dataJson = 'request='+JSON.stringify({request:'get_data_setForm', id:id});

		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){
						    
						    	if(data.status == 	'done'){

										let getData = data.data;

										let dataGroup = [];

										dataGroup[0] = getData.gru_nombre;
										dataGroup[1] = getData.gru_grado;
										dataGroup[2] = getData.gru_status;
										dataGroup[3] = id;																	
		
										colegio.openModal(objectSelf.setFormModal);

										colegio.load_data_onForm(dataForm, dataGroup);

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

		let dataJson = 'request='+JSON.stringify({request:'del-data', id:id});
		
		objectSelf.ajax.send_data({method:'post', 
						    functionName:function(data){

								if(data.status == 'done'){
									
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.success(data.notice));

									let groupsTable = objectSelf.groupsTable;

									let newData = groupsTable.table.remove_row(id);

									groupsTable.table.set_bodyTable(newData);

									colegio.innerHTML(objectSelf.tableContainer, groupsTable.get_groups_table());

									//botones de la tabla de resultados 

									groupsTable.status_btn();//boton para cambiar estado

									groupsTable.update_dataBtn((e) => {

										objectSelf.open_set_form(e);

									});//boton para editar informacin
									
									groupsTable.del_btn((e) => {
						   		
						   				objectSelf.del_data(e);

									});//boton para borrar grupo
									
								}else{
								
									colegio.innerHTML(objectSelf.ajaxMsg, colegio.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}
	
							},
							data:dataJson});

	}


}