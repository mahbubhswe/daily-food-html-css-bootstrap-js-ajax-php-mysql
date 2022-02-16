changeContent('showAllItems');
function changeContent(contentName){

//tag all html tag class with content
let htmlDom = document.getElementsByClassName('content');

//hide all html tag which has class named content 
for (var i = 0; i < htmlDom.length; i++) {
	htmlDom[i].style.display="none";
}

//show one content
document.getElementById(contentName).style.display = "block";

}


//button enabled after fill up all input fiels
addFoodForm.addEventListener('input',()=>{
    if(category.value.length>0 && price.value.length>0 && img.value.length>0) {
    	addFoodBtn.removeAttribute("disabled"); 
    }else{
    	addFoodBtn.setAttribute("disabled",true);
    }
})



function saveDisCountBtn(){

	let btn = document.getElementById("disCountBtn");
	let checkInput = document.getElementById("getDiscountPrice").value;

	if(checkInput.length>0)
	{
      btn.removeAttribute("disabled");
    }else{
    	btn.setAttribute("disabled",true);
    }

}


function login(){
    
}
