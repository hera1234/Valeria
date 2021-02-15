class Teacher_table{

	constructor(app= null, 
				table = null, 
				statusBtn = null){

		this.app = app;
		this.table = table;
		this.statusBtn = statusBtn;

	}

	list_btn(fn = null){
		
		let listBtn = colegio.getByClass('signatures-listBtn');

		this.app.add_events({target:listBtn, 
						   eventName:'click', 
						   functionName:function(e){

						  		fn(e);

							}});


	}

	add_signature_btn(fn = null){

		let addSignatureBtn = colegio.getByClass('add-signaturesBtn');

		this.app.add_events({target:addSignatureBtn, 
						   eventName:'click', 
						   functionName:function(e){

						   		fn(e);

							}});
		
	}

	info_btn(fn = null){

		let infoBtn = colegio.getByClass('info-btn');

		colegio.add_events({target:infoBtn, 
						   eventName:'click', 
						   functionName:function(e){

						   		fn(e);

							}});

	}

	status_btn(){

		let objectSelf = this;
		
		try{

			this.statusBtn.allBtns = colegio.getByClass('status-btn');
			
			this.statusBtn.add_event_allBtns({eventName:'click', 
									    fn:function(e){

									   		objectSelf.statusBtn.btn = e.target;
									   		objectSelf.statusBtn.dataBtn = objectSelf.statusBtn.btn.value.split('||');

									   		let id = objectSelf.statusBtn.dataBtn[0];
									   		let teacherStatus = objectSelf.statusBtn.dataBtn[1];
							   				
							   				objectSelf.statusBtn.change_status({request:'update-status',
																	 data:{id:id,
						 							                 status: teacherStatus}});

						 				}});
		}catch(error){

			console.error(error);

		}

	}

	update_dataBtn(fn = null){

		let updateBtn = colegio.getByClass('update-btn');

		colegio.add_events({target:updateBtn, 
						   eventName:'click', 
						   functionName:function(e){

						   		fn(e);

							}});	

	}

	del_btn(fn = null){

		let delBtn = colegio.getByClass('del-btn');

		colegio.add_events({target:delBtn, 
						   eventName:'click', 
						   functionName:function(e){

						   		fn(e);

							}});

	
	}

	set_table(data = ''){

		this.table.set_headerTable(`<tr>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>Materias</th>
									<th>Info</th>
									<th>Estado</th>
									<th class="thDer">Edicion</th>
								</tr>`);

		this.table.set_bodyTable(data);
	
	}

	get_teacher_table(){

		return this.table.get_table();
	
	}

}