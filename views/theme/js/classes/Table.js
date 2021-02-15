class Table{

	constructor(app = null){

		this.iniTable = '<table>';
		this.headerTable = '';
		this.bodyTable = '';
		this.endTable = '</table>';
		this.app = app;
		this.data = '';
		this.doTable = true;

	}

	set_iniTable(param = ''){

		this.iniTable = param;
	}

	set_headerTable(param = ''){

		this.headerTable = param;

	}

	set_bodyTable(data = ''){

		let rows = '';

		this.data = data;
		
		if(this.data.length > 0){

			colegio.loop({target:this.data, 
						  fn:(row)=>{
						  	
						  	rows += row.tr;

						  }});

			this.bodyTable = rows;

		}else{

			this.doTable = false;

		}
	
	}

	set_endTable(param = ''){

		this.endTable = param;

	}

	get_table(msg = 'Sin datos para mostrar'){

		if(this.doTable){
			
			return this.iniTable+this.headerTable+this.bodyTable+this.endTable;

		}else{

			return this.iniTable+this.headerTable+this.endTable+`<div class="no-dataTableMsg">${msg}</div>`;

		}
	
	}

	do_rows(data = '', fn = null){

		let rows = [];
		let i = 0;

		colegio.loop({target:data, 
					  fn:(row)=>{
					  	
					  	rows[i] = {tr:`<tr>${fn(row)}</tr>`};
					  	
					  	i++;

					  }});	

		return rows;

	}

	remove_row(id = ''){

		if(id == ''){

			console.log('Faltan valores para remover objecto de lista');
			
			return false;
		
		}else{

			if(this.data.length > 0){

				this.data  = this.app.remove_one(this.data, id);

			}	

			return  this.data;
		
		}
		
	}

}