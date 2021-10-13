colegio = {

	body:document.getElementsByTagName("body"),
	mainContainer:document.getElementsByClassName('main-container'),
	msg:{success:function(msg = ""){

						return "<div class='alert alert-success'>"+msg+"</div>";

					},
		info:function(msg = ""){

						return "<div class='alert alert-info'>"+msg+"</div>";

					},
		warning:function(msg = ""){

						return "<div class='alert alert-warning'>"+msg+"</div>";

					},
		danger:function(msg = ""){

						return "<div class='alert alert-error'>"+msg+"</div>";

					},
		msg_type(status = "", $msg = ""){

			switch(status){

				case'done':

					return colegio.msg.done($msg);

				break;
				case'no-data':

					return colegio.msg.info($msg);
				
				break;
				case'warning':
				
					return colegio.msg.warning($msg);

				break;
				case'error':
				
					return colegio.msg.danger($msg);

				break;
				default:

					return colegio.msg.danger("Tipo de mensage desconocido");
				
				break;

			}
		}
	},	
	getById:function(objectName = ""){

		return document.getElementById(objectName);

	},
	getByClass:function(className = ""){

		return document.getElementsByClassName(className);

	},
	getByTag:function(objectName = ""){

		return document.getElementsByTagName(objectName);

	},
	get_dataForm:function(noData = '', control = null){

		if(noData == '' || control == null){

			return false;

		}else{

			if(noData == 'one'){

				return control.value;

			}else if(noData == 'more'){

				let data = [];
				let c=0;

				colegio.loop({target:control, fn:function(d){
					
					data.push(d.value);

				}});

				return data;
			
			}else{

				return false;
			}

		}

	},
	clean_form_controls:function(ctrl = '', noCtrl = ''){

		if(ctrl != '' || noCtrl != ''){

			switch(noCtrl){

				case'one':

					ctrl.value = '';

					return true;

				break;
				case'moreOne':

					colegio.loop({target:ctrl, fn:function(d){

						if(d.localName == 'select'){

							d.value = 'ninguno'; 
						
						}else{

							d.value = '';
							
						}
						

					}});

					return true;
				
				break;
				default:

					return false;

				break;
			}

		}else{

			return false;

		}

	},
	load_data_onForm(dataForm = null, data = ''){

		let c = 0 ;
		colegio.loop({target:dataForm, fn:function(d){

			d.value = data[c];
			c++;

		}});

	},
	innerHTML(ctrl = null, content = ''){
		try{

			ctrl.innerHTML = content;
		
		}catch(error){

			console.log(error+'-Error al colocar el contenido en el lugar solicitado');
		}

	},
	addEvent:function(objectName = null, eventName = "", fn = null){

		try{

			objectName.addEventListener(eventName, fn, false);

		}catch(error){

			console.log(error);
		}	

	},
	add_events(params = {target:null, eventName:null, functionName:null}){

		if(params.target.length != null && params.target.length != undefined){

			for(let i=0; i < params.target.length; i++ ){

				params.target[i].addEventListener(params.eventName, params.functionName, false);

			}

			return true;
		
		}else{

			console.log("add events false");

			return false;
		
		}

	},
	openModal:function(modal = null){
						
		colegio.show(modal);

		colegio.body[0].style.position = 'fixed';
		
		colegio.body[0].style.overflow = 'hidden';

	},
	closeModal(modal = null){

		colegio.hide(modal);

		colegio.body[0].style.position = 'static';
		
		colegio.body[0].style.overflow = 'auto';
		            		
	},
	empty:function(data = '', fn = ''){
	
		if(data == '' ||
			data == null ||
			data == undefined){

			return false;

		}else{

			if(fn != ""){

				fn();
			
			}

			return true;
		}

	},
	loop(params = {target:null, fn:null}){
		
		if(this.empty(params.target) && this.empty(params.fn)){
			
			if(params.target.length > 0){
				
				for(var i=0; i < params.target.length; i++ ){

					params.fn(params.target[i]);

				}
		
				return true;

			}else{

				console.log("Numero de objectos menor al requerido");

				return false;	
			
			} 

		}else{

			console.log("iterar false");

			return false;
		
		}

	},
	remove_one:function(target = '', id = ''){

		if(target == '' && id != ''){
			
			return false;
		
		}else{

			let array = [];
			let i  = 0;
				
			colegio.loop({target:target, fn:(d) => {

				if(d.id != id){

					array[i] = d;

					i++;
				}

			}});

			return array;

		}
	},
	show:function(objectName = ""){

		this.empty(objectName, function(){

			objectName.style.display = "block";
		
		});	
		
	},
	hide:function(objectName = ""){

		this.empty(objectName, function(){

			objectName.style.display = "none";

		});

	},
	preventDefault(e){

		let target = null;
		
		if(e){
		
			e.preventDefault();
			target = e.target;
		
		}else{
		
			if(window.event){

				window.event.returnValue = false;
				target = window.event.srcElement;
			
			}
		
		}

		return target;

	},
	change_class(params = {target: null, 
		                   forChangeClass: null, 
		                   newClass: null}){

		try{

			if(!colegio.empty(params.target) ||
			   !colegio.empty(params.forChangeClass) ||
			   !colegio.empty(params.newClass)){

				console.log('Faltan parametros para modificar clases');

			}else{
			
				let classList = params.target.classList;
							
				let count = 0;
				let count2 = 0;
				let arrayClass = [];
				
				colegio.loop({target:classList, fn:function(classLi){
						
					arrayClass[count] = classLi; 
								
					colegio.loop({target:params.forChangeClass, fn:function(oldClass){
						
						if(classLi == oldClass){
				
							arrayClass[count] = params.newClass[count2];
							count2 += 1;
					
						}
							
					}});

					count++;	
					
				}});

				let stringClass = '';

				for (var i = 0; i < arrayClass.length; i++) {
					
					stringClass += arrayClass[i]+' ';
				
				}
				
				params.target.className = stringClass;

			}
				
		}catch(error){

			console.log(error);
		
		}
		
	},
	scroll_hide(target = null, hide = false){

		if(hide == false){

			target.style.overflow = 'scroll';

		}else if(hide == true){

			target.style.overflow = 'hidden';

		}else{

			console.log('Error scroll hide');

		}
	}


};