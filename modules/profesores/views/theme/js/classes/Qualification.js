class Qualification{

	constructor(app = null){

		//calificar
		this.formModal = colegio.getById('signatures-modal');
		this.qualificationBtn = colegio.getByClass('qualification-btn');
		this.activitiesForm = colegio.getById('signatures-form');

		this.ajaxMsg = null;
		this.tableContainer = null;

		this.ajax = null;
		this.app = app;

		//formulario para agregar o editar calificaiones 
		this.dataForm = null;
		this.setBtn = null;
		this.closeBtn = null;

		this.qData = {teacher:'',
					  level:'',
					  group:'',
					  student:'',
					  signature:'',
					  points:''}
		
	}

	start_qualificationForm(){

		this.dataForm = colegio.getByClass('set-data');

		this.setBtn = colegio.getById('set-dataBtn');//boton de formulario de edicion de calificaciones 
		
		let arrayData = [];

		//evento del boton para agregar o editra calificaiones
		colegio.addEvent(this.setBtn, 'click', (e) => {

			colegio.preventDefault(e);

			let c = 0;	

			colegio.loop({target:this.dataForm, fn:(d) => {

				arrayData[c] = {teacher:this.qData.teacher,
								level:this.qData.level,
								group:this.qData.group,
								student:this.qData.student,
								signature:d.id, 
								points:d.value};
				
				c++;

			}});
			
			this.set_qualifications(arrayData);

		});
										
   		this.closeBtn = colegio.getById('close-QSBtn');//boton para cerrar formulario

   		//evento del boton cerrar formulario
		this.app.addEvent(this.closeBtn, 'click', (e) => {

			e.preventDefault();
			this.app.closeModal(this.formModal);	
		
		});

	}

	open_qualificationForm(e){

		let objectSelf = this;

		let btn = e.target;
   		
   		let btnValues = btn.value.split('||');
   		
   		this.qData.student = btnValues[0];
   		this.qData.group = btnValues[1];
   		this.qData.level = btnValues[2];
   		this.qData.teacher = btnValues[3];

   		let totalWrap = colegio.getById('total-wrap');
				
		let dataJson = 'request='+JSON.stringify({request:'get_data_form', 
												  data:{group:this.qData.group, 
												  		student:this.qData.student, 
												  		level:this.qData.level,
												  		teacher:this.qData.teacher}
												});

		objectSelf.ajax.send_data({method:'post', 
						    functionName:(data) => {

								if(data.status == 'done'){

										this.app.openModal(objectSelf.formModal);

										let getData = data.data;
		
										//contenedor
										let formWrap = colegio.getById('signatures-container');

										let i=0;
										let c = 0; 
										let wrap = '';
										let increment = true;

										let controlsFinal=[];

										colegio.loop({target:getData, fn:function(data){

											let increment = true;
											
											wrap += data;
															
										}});

										this.app.innerHTML(formWrap, wrap);	

										let final = 0;
										
										let total = 0;
										
										if(this.dataForm.length > 0){

											if(this.dataForm.length > 1){

												this.app.loop({target:this.dataForm, fn:function(d){
													
													total += parseInt(d.value);

												}});

											}else{

												total = this.dataForm[0].value;
											
											}

											final =total/this.dataForm.length;		
															
										}
										
										let tabindex = this.dataForm[this.dataForm.length-1].tabIndex;

										this.setBtn.tabIndex = tabindex + 1;

										this.closeBtn.tabIndex = tabindex + 2;

										this.app.innerHTML(totalWrap, 'Total: '+total+'  Promedio: '+final);
									
								}else{

									this.app.innerHTML(this.ajaxMsg, this.app.msg.msg_type(data.status, data.notice));
									
									console.log(data.notice);	
								
								}
								
							},
							data:dataJson});

	}

	set_qualifications(arrayData = ''){

		let dataJson = 'request='+JSON.stringify({request:'set_qualifications', 
												data:arrayData});

		this.ajax.send_data({method:'post', 
						    functionName: (data) => {

								if(data.status == 'done'){
									
									this.app.innerHTML(this.ajaxMsg, this.app.msg.success(data.notice));

									this.app.closeModal(this.formModal);
									
								}else{
								
									this.app.innerHTML(this.ajaxMsg, this.app.msg.msg_type(data.status, data.notice));
									
									console.log(data.data);	
								
								}

								this.app.closeModal(this.formModal);
								
							},
							data:dataJson});

	}

}