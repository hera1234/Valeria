class School{

	constructor(){

		//actualizar
		this.setInfoBtn = colegio.getById('set-infoBtn');//boton para abrir formulario
		this.setForm = colegio.getById('set-form');//formulario editar datos
		this.setModal = colegio.getById('set-modal');//modal editar datos

		this.ajax = null;
		this.ajaxMsg = null;
		this.tableContainer = null;
		
	}

	start_set_form(){

		let objectSelf = this;

		let dataForm = colegio.getByClass('set-data');

		let setBtn = colegio.getById('set-dataBtn');//boton de formulario editar

		let id = objectSelf.setInfoBtn.value;//extraer el id del valor del boton

		colegio.addEvent(setBtn, 'click', function(e){

			colegio.preventDefault(e);

			let arrayData = [];
			
			let c = 0;		

			colegio.loop({target:dataForm, fn:function(d){

				//guardar los datos del formulario en un array
				arrayData[c] = d.value;	

				c++;

			}});

			//colocar en el ultimo indice del array el id 
			arrayData[c]=id;
			
			objectSelf.set_data(arrayData);

		});

		let closeBtn = colegio.getById('close-setFormBtn');
		
		colegio.addEvent(closeBtn, 'click', (e) => {

			e.preventDefault();

			colegio.closeModal(objectSelf.setModal);

		});									

	}

	open_set_form(){

		let objectSelf = this;
				
		colegio.openModal(objectSelf.setModal);
									
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

								colegio.closeModal(objectSelf.setModal);
								
							},
							data:dataJson});

	}

}