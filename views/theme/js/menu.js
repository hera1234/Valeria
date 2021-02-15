colegio.addEvent(window, 'load', start_menu);

function start_menu(){

	let menu = new Menu();

	menu.start_menu({
		mobileBtn:colegio.getById('mobile-btn'),
		mobileMenuBtn:colegio.getById('menu-mobileUserBtn'),
		mobileMenu:colegio.getById('mobile-menu'),
		userDesplegableMenu:colegio.getById('mobile-userDesplegableMenu'),
		menuBtn:colegio.getById('user-menuBtn'),
		desplegableMenu:null
	});


	colegio.addEvent(window, "resize", () =>{

		if(screen.width > 880){
			
			menu.close_desplegable_menu(menu.mobileMenu);

		}

	});

	colegio.addEvent(menu.menuBtn, 
					 'click', 
					 (e) => {

					   		let origin = e.target;

							menu.desplegableMenu = origin.nextElementSibling;

					   		if(menu.is_open(menu.desplegableMenu)){

					   			menu.close_desplegable_menu(menu.desplegableMenu);
					   		
					   		}else{

					   			menu.open_desplegable_menu(menu.desplegableMenu);

					   		}
					   		
					   });

	//mobile
	
	colegio.addEvent(menu.mobileBtn, 'click', (e) => {

					   		if(menu.is_open(menu.mobileMenu)){

					   			menu.close_desplegable_menu(menu.userDesplegableMenu);

					   			menu.close_desplegable_menu(menu.mobileMenu);
					   		
					   		}else{

					   			menu.open_desplegable_menu(menu.mobileMenu);

					   		}
					   		
					   });

	colegio.addEvent(menu.mobileMenuBtn, 'click', (e) => {

							if(e.target.id == 'menu-mobileUserBtn'){

						   		if(menu.is_open(menu.userDesplegableMenu)){

						   			menu.close_desplegable_menu(menu.userDesplegableMenu);
						   		
						   		}else{

						   			menu.open_desplegable_menu(menu.userDesplegableMenu);

						   		}
						   	}
					   		
					   });


}