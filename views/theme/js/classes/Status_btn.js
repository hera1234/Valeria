class Status_btn{

	constructor(ajax = null){

		this.btn = null;
		this.allBtns = null;
		this.dataBtn = '';
		this.ajax = ajax;
		this.boxMsg = null;

	}

	change_status(params = {request:'',
							data:{id:'',
	 					    status:'undefined'}}){
		
		let objectSelf = this;
   		
   		let dataJson = 'request='+JSON.stringify(params);

		objectSelf.ajax.send_data({method:'post', 
								   functionName:function(data){	
								   		
								   		if(data.status == 'done'){

											colegio.innerHTML(objectSelf.boxMsg, colegio.msg.success(data.notice));

											//modificar status a boton

											objectSelf.btn.value = params.data.id+'||'+data.data;
											
											objectSelf.change_status_appearance(data.data);//cambiar el status del boton
											
										}else{
										
											colegio.innerHTML(objectSelf.boxMsg, colegio.msg.msg_type(data.status, data.notice));
											
											console.log(data.data);	
										
										}
										
									},
									data:dataJson});

	}

	change_status_appearance(status = 'undefined'){

		let forChangeClass = [];//classes a cambiar
		let newClass = [];//nuevas clases

		switch(status){

			case'Activo':

				newClass[0] = 'status-activeBtn';
				newClass[1] = 'fa-toggle-on';
				forChangeClass[0] = 'status-inactiveBtn'; 
				forChangeClass[1] = 'fa-toggle-off';

			break;
			case'Inactivo':
				
				newClass[0] = 'status-inactiveBtn';
				newClass[1] = 'fa-toggle-off';
				forChangeClass[0] = 'status-activeBtn'; 
				forChangeClass[1] = 'fa-toggle-on';																				
				
			break;
			default:
			
				console.log('Status desconocio');

			break;

		}

		colegio.change_class({target:this.btn, 
							  forChangeClass:forChangeClass, 
							  newClass:newClass});

	}

	add_event_allBtns(params = {eventName:'', fn:null}){

		colegio.add_events({target:this.allBtns, 
						   eventName:params.eventName, 
						   functionName:function(e){

						   		params.fn(e);
						   
						   }});

	}

}