
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








