var i;
var slides = document.getElementsByClassName("slide-page");

var total_slides = slides.length;
//console.log(total_slides);

//slider auto transition.............
var ini_slide = 1;
var intervar = 10000;
var slider_interval = setInterval(auto_slider_timer, intervar);


function auto_slider_timer() {

	var slider_val = ini_slide;
	
	ini_slide++;
	
	if(ini_slide > total_slides-1){
		ini_slide=0;
	}
	
	// console.log("current : " + slider_val);
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

// prev_butt.addEventListener("mouseover", stop_slider_transition, false);
// prev_butt.addEventListener("mouseout", start_slider_transition, false);

// next_butt.addEventListener("mouseover", stop_slider_transition, false);
// next_butt.addEventListener("mouseout", start_slider_transition, false);

// function start_slider_transition(){
	
	// slider_interval = setInterval(auto_slider_timer, intervar);
// }
		
// function stop_slider_transition(){
	
	// clearInterval(slider_interval);
// }



prev_butt.addEventListener("click", function() {
	
	//calculate current page.......
	var crnt_slide_page = calculate_prev(ini_slide);
	// console.log("before : " + crnt_slide_page);
	
	//calculate prev page
	new_slide_page = calculate_prev(crnt_slide_page);
	// console.log("after : " + new_slide_page);
	
	// console.log("current : " + new_slide_page);
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
	
	// console.log("current : " + new_slide_page);
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



// active dots...................................................................
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


//Search button javascript...................................................................
var search_icon = document.getElementById("search_icon");
var search = document.getElementById("search");
var social_icons = document.getElementById("social_icons");
var social_icons_2 = document.getElementById("social_icons_2");

var focused = 0;

search_icon.addEventListener("mouseover", expand_search_area, false);
search_icon.addEventListener("mouseout", disclose_search_area, false);

var search_area_width = document.getElementById("search_area").offsetWidth;
var src_poss_expand = search_area_width - 20 - 106 - 36;
var Scl_icon_mar = src_poss_expand + 36 + 10;

var mini_display = false;
// console.log(src_poss_expand);


window.addEventListener('resize', function(event){
	// console.log("re");
	search_area_width = document.getElementById("search_area").offsetWidth;
	src_poss_expand = search_area_width - 20 - 106 - 36;
	Scl_icon_mar = src_poss_expand + 36 + 10;

	if(src_poss_expand < 100){
	
		mini_display = true;
		social_icons.setAttribute("style", "display:none");
		social_icons_2.setAttribute("style", "display:block");
	}
	else{
		
		mini_display = false;
		social_icons_2.setAttribute("style", "display:none");
		social_icons.setAttribute("style", "display:block");
	}
});




if(src_poss_expand < 100){
	
	mini_display = true;
	social_icons.setAttribute("style", "display:none");
	social_icons_2.setAttribute("style", "display:block");
}
else{
	
	mini_display = false;
	social_icons_2.setAttribute("style", "display:none");
	social_icons.setAttribute("style", "display:block");
}


//social icons
function expand_search_area(){
	
	// console.log("Expand");
	// console.log(window.innerWidth);
	if(mini_display == false){
		
		if(576 <= window.innerWidth && window.innerWidth < 768){
		
			social_icons.setAttribute("style", "margin-right:"+(Scl_icon_mar + parseInt(15))+"px;transition:all 0.5s;");
			search.setAttribute("style", "visibility: visible; opacity:1; width:"+(src_poss_expand + parseInt(25)) +"px;transition:all 0.5s;");
		}
		else if(768 <= window.innerWidth && window.innerWidth < 1500){
			social_icons.setAttribute("style", "margin-right:"+(Scl_icon_mar - parseInt(2))+"px;transition:all 0.5s;");
			search.setAttribute("style", "visibility: visible; opacity:1; width:"+(src_poss_expand - parseInt(0)) +"px;transition:all 0.5s;");
		}
		else if(window.innerWidth > 1500){
			social_icons.setAttribute("style", "margin-right:"+(Scl_icon_mar - parseInt(23))+"px;transition:all 0.5s;");
			search.setAttribute("style", "visibility: visible; opacity:1; width:"+(src_poss_expand - parseInt(20)) +"px;transition:all 0.5s;");
		}
		
	}
	else{
		
		// social_icons.setAttribute("style", "margin-right:"+(Scl_icon_mar + parseInt(15))+"px;transition:all 0.5s;");
		search.setAttribute("style", "visibility: visible; opacity:1; width:"+(src_poss_expand + parseInt(120)) +"px;transition:all 0.5s;");
	}
	
	
}
		
function disclose_search_area(){
	
	// console.log("Disclose");
	// console.log(focused);
	if(mini_display == false){
		
		if(focused == 0 && search.value.length == 0){
			if(576 <= window.innerWidth && window.innerWidth < 768){
				social_icons.setAttribute("style", "margin-right:30px;transition:all 0.5s;");
				search.setAttribute("style", "visibility: Hidden; opacity:0; width:0px;transition:all 0.5s;");
			}
			else if(768 <= window.innerWidth && window.innerWidth < 1500){
				social_icons.setAttribute("style", "margin-right:35px;transition:all 0.5s;");
				search.setAttribute("style", "visibility: Hidden; opacity:0; width:0px;transition:all 0.5s;");
			}
			else if(window.innerWidth > 1500){
				social_icons.setAttribute("style", "margin-right:40px;transition:all 0.5s;");
				search.setAttribute("style", "visibility: Hidden; opacity:0; width:0px;transition:all 0.5s;");
			}
		}
	}
	else{
		
		search.setAttribute("style", "visibility: Hidden; opacity:0; width:0px;transition:all 0.5s;");
	}
	
}


search.addEventListener("focus", searchFocusFunction, true);
search.addEventListener("blur", searchBlurFunction, true);

function searchFocusFunction(){
	
	// console.log("Focus");
	
	focused = 1;
	// console.log(window.innerWidth);
	if(mini_display == false){
		if(576 <= window.innerWidth && window.innerWidth < 768){
			social_icons.setAttribute("style", "margin-right:"+(Scl_icon_mar + parseInt(15))+"px;transition:all 0.5s;");
			search.setAttribute("style", "visibility: visible; opacity:1; width:"+(src_poss_expand + parseInt(25)) +"px;transition:all 0.5s;");
		}
		else if(768 <= window.innerWidth && window.innerWidth < 1500){
			social_icons.setAttribute("style", "margin-right:"+(Scl_icon_mar - parseInt(2))+"px;transition:all 0.5s;");
			search.setAttribute("style", "visibility: visible; opacity:1; width:"+(src_poss_expand - parseInt(0)) +"px;transition:all 0.5s;");
		}
		else if(window.innerWidth > 1500){
			social_icons.setAttribute("style", "margin-right:"+(Scl_icon_mar - parseInt(23))+"px;transition:all 0.5s;");
			search.setAttribute("style", "visibility: visible; opacity:1; width:"+(src_poss_expand - parseInt(20)) +"px;transition:all 0.5s;");
		}
	}
}
		
function searchBlurFunction(){
	
	// console.log("Blur");
	focused = 0;
	
	if(mini_display == false){	
		if(search.value.length == 0){
			if(576 <= window.innerWidth && window.innerWidth < 768){
				social_icons.setAttribute("style", "margin-right:30px;transition:all 0.5s;");
				search.setAttribute("style", "visibility: Hidden; opacity:0; width:0px;transition:all 0.5s;");
			}
			else if(768 <= window.innerWidth && window.innerWidth < 1500){
				social_icons.setAttribute("style", "margin-right:35px;transition:all 0.5s;");
				search.setAttribute("style", "visibility: Hidden; opacity:0; width:0px;transition:all 0.5s;");
			}
			else if(window.innerWidth > 1500){
				social_icons.setAttribute("style", "margin-right:40px;transition:all 0.5s;");
				search.setAttribute("style", "visibility: Hidden; opacity:0; width:0px;transition:all 0.5s;");
			}
		}
	}
		
}











