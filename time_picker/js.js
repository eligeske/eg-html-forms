//********** Framework CODE ******************

function execFunction(fn, fnBody){
	fn.start();
	
	fnBody(function(){fn.success(); fn.end();}, 
	       function(){fn.failure(); fn.end();}
	);
}


function createFunction(fn){
	fn.Start=new Ibeza.Lib.Observer();
	fn.success={};
	fn.failure={};
	fn.end={};
	return fn;
}

//********** VM CODE ******************

var VM2 = function(){
	
	
	this.OnSave = function(){
		
		
	}
	
}

var VM = function() {
	
	this.childVM = new VM2();
	BindObserverSet(this.EditConcept, childVM.Save);
	
	//case 1:
	this.OnGetConcept = createFunction(function (id)
	{
		execFunction(this.OnGetConcept, function(sc,fc){sc();});
	});
	
	
	this.EditConcept = {};
	
	
	//case 2:
	//this.OnGetForEditConcept = function(id){
		//1. construct vm for popup.
		//1.1 register for vm.Save event.
		//1.2 on vm.Save -> this.EditConcept.Success();
		//2. give vm to the view:
		//this.GetForEditConcept.Success(vm);
		//popup is already opened here.
	//};
	//this.GetForEditConcept = new observerSet();
	
	//...
	//this.EditConcept = new observerSet();
}

//**** View

View = function(vm){
	
	//**before:
	vm.GetConcept.Start.RegisterHandler(function(){});
	//...
	vm.OnGetConcept(id);
	
	//**after
	vm.OnGetConcept.Start.RegisterHandler(function(){});
	//...
	vm.OnGetConcept(id);
	
	
}


