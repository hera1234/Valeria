class Groups_table{

	constructor(app= null, 
				table = null, 
				statusBtn = null){

		this.app = app;
		this.table = table;
		this.statusBtn = statusBtn;

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
									   		let groupStatus = objectSelf.statusBtn.dataBtn[1];
							   				
							   				objectSelf.statusBtn.change_status({request:'update-status',
																	 data:{id:id,
						 							                 status:groupStatus}});

						 				}});
		}catch(error){

			console.error(error);

		}

	}

	update_dataBtn(fn = null){

		let updateBtn = colegio.getByClass('update-btn');

		this.app.add_events({target:updateBtn, 
						   eventName:'click', 
						   functionName:function(e){

						   		fn(e);

							}});

	}

	del_btn(fn = null){

		let delBtn = colegio.getByClass('del-btn');

		this.app.add_events({target:delBtn, 
						   eventName:'click', 
						   functionName:function(e){

						   		fn(e);

							}});
	
	}

	set_table(data = ''){

		this.table.set_headerTable(`<tr>
										<th>Nombre</th>
										<th>Grado</th>
										<th>Estado</th>
										<th class="thDer">Edicion</th>
									</tr>`);

		this.table.set_bodyTable(data);
	
	}

	get_groups_table(){

		return this.table.get_table();
	
	}

}