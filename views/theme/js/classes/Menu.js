class Menu{

	construct(app = null){

		this.mobileBtn = null;
		this.mobileMenuBtn =  null;
		this.mobileMenu =  null;
		this.userDesplegableMenu =  null;
		this.menuBtn =  null;
		this.desplegableMenu = null;

		this.app = app;

	}

	start_menu(params = {
		mobileBtn:null,
		mobileMenuBtn:null,
		mobileMenu:null,
		userDesplegableMenu:null,
		menuBtn:null,
		desplegableMenu:null
	}){

		this.mobileBtn = params.mobileBtn;
		this.mobileMenuBtn = params.mobileMenu;
		this.mobileMenu = params.mobileMenu;
		this.userDesplegableMenu = params.userDesplegableMenu;
		this.menuBtn = params.menuBtn;
		this.menu = params.menu;
		this.desplegableMenu = params.desplegableMenu;

	}

	is_open(target = null){

		if(target.style.display == 'block'){

   			return true;
   		
   		}else{

   			return false;	

   		}
					   		
	}

	open_desplegable_menu(desplegable){

		colegio.show(desplegable);

	}

	close_desplegable_menu(desplegable){

		colegio.hide(desplegable);

	}

	select_btn(btn = null){

	}


}