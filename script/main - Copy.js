var i;
var slides = document.getElementsByClassName("slide-page");

var total_slides = slides.length;
//console.log(total_slides);

//slider auto transition.............
var ini_slide = 1;
var intervar = 4000;
var slider_interval = setInterval(auto_slider_timer, intervar);


function auto_slider_timer() {

	var slider_val = ini_slide;
	
	ini_slide++;
	
	if(ini_slide > 2){
		ini_slide=0;
	}
	
	console.log("current : " + slider_val);
	change_dotnav(slider_val);
	
	for(var i=0;i<total_slides;i++){
	
		if(i==slider_val){
			slides[i].style.opacity = 1;
			
		}
		else{
			slides[i].style.opacity = 0;
		}
		
	}
	
	
}

// nav button ................................................................................

var prev_butt = document.getElementById("prev");
var next_butt = document.getElementById("next");

prev_butt.addEventListener("mouseover", stop_slider_transition, false);
prev_butt.addEventListener("mouseout", start_slider_transition, false);

next_butt.addEventListener("mouseover", stop_slider_transition, false);
next_butt.addEventListener("mouseout", start_slider_transition, false);

function start_slider_transition(){
	
	slider_interval = setInterval(auto_slider_timer, intervar);
}
		
function stop_slider_transition(){
	
	clearInterval(slider_interval);
}



prev_butt.addEventListener("click", function() {
	
	//calculate current page.......
	var crnt_slide_page = calculate_prev(ini_slide);
	// console.log("before : " + crnt_slide_page);
	
	//calculate prev page
	new_slide_page = calculate_prev(crnt_slide_page);
	// console.log("after : " + new_slide_page);
	
	console.log("current : " + new_slide_page);
	change_dotnav(new_slide_page);
	
	for(var i=0;i<total_slides;i++){
	
		if(i==new_slide_page){
			slides[i].style.opacity = 1;
		}
		else{
			slides[i].style.opacity = 0;
		}
	}
	ini_slide = calculate_next(new_slide_page);
	
});

next_butt.addEventListener("click", function() {
	
	//calculate current page.......
	var crnt_slide_page = calculate_prev(ini_slide);
	// console.log("before : " + crnt_slide_page);
	
	//calculate prev page
	new_slide_page = calculate_next(crnt_slide_page);
	// console.log("after : " + new_slide_page);
	
	console.log("current : " + new_slide_page);
	change_dotnav(new_slide_page);
	
	for(var i=0;i<total_slides;i++){
	
		if(i==new_slide_page){
			slides[i].style.opacity = 1;
		}
		else{
			slides[i].style.opacity = 0;
		}
	}
	
	//calculate current page again ....
	ini_slide = calculate_next(new_slide_page);
	
});





//rotator functions............................
function calculate_prev(val){
	
	if(val == 0){
		val=total_slides-1;
	}
	else{
		val--;
	}
	return val;
}

function calculate_next(val){

	if(val == total_slides-1){
		val=0;
	}
	else{
		val++;
	}
	return val;
}



//active dots...................................................................
var nav_dotts = document.getElementsByClassName("dot-nav");

change_dotnav(0);

function change_dotnav(val){
	
	for(var i=0;i<total_slides;i++){
	
		if(i==val){
			nav_dotts[i].style.opacity = 1;
		}
		else{
			nav_dotts[i].style.opacity = .3;
		}
	}
}

















