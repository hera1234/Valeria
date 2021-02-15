// JavaScript Document
class Ajax{

	constructor(){

		this.xmlHttp = null;
		this.conection = this.htmlHttp(); 
		
		this.file = "";

	}

	htmlHttp(){

		if(window.XMLHttpRequest){
			
			this.xmlHttp = new XMLHttpRequest();
			return this.xmlHttp;
		
		}else if(window.ActiveXObject){
		
			this.xmlHttp = new ActiveXObject('Micrososft.XMLHTTP');
			return this.xmlHttp;
		
		}else{
		
			return false;
		
		}

	}

	send_data(params = {method:null, functionName:null, data:null}){

		let selfObject = this;

		this.conection.myConection = {conection:this.conection,functionName:params.functionName};
		
		if(params.method == "get"){

			this.conection.onreadystatechange = this.processing_ajax;
			this.conection.open('GET', selfObject.file, true);
			this.conection.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			this.conection.send(null);


		}else if(params.method == "post"){
			
			this.conection.onreadystatechange = this.processing_ajax;
			this.conection.open('POST', selfObject.file, true);
			this.conection.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			this.conection.send(params.data);

		}else{

			console.error("Metodo no valido");

		}


	}

	processing_ajax(){

		let status = false;

		if(this.myConection.conection.readyState == 4){
	
			console.log("request finished and response is ready"+"-"+this.myConection.conection.status);
	
			switch(this.myConection.conection.status){

					case 200:

						//OK
						
						console.log(this.myConection.conection.statusText);
						
						try{

							let data = JSON.parse(this.myConection.conection.responseText);

							this.myConection.functionName({status:data.status, notice:data.notice, data:data.data});
							
						}catch(error){
							
							this.myConection.functionName({status:'error', notice:'<br>Error:'+this.myConection.conection.responseText, data: error});

						}

					break;
					case 403:
						console.log("Forbidden");
					break;
					case 404:
						console.error(this.myConection.conection.statusText);
					break;
					default:
						console.error('Estado de la conexion desconocido');
					break;
				
			}

		}else{

			switch(this.myConection.conection.readyState){
				case 0:
					console.log("request no initialized");

				break;

				case 1:
					console.log("server connection established");
				break;

				case 2:
					console.log("request received");
				break;

				case 3:
					console.log("processing request");
				break;

				default:
					console.error("No valid response");
				break;

			}

		}

	}

}
