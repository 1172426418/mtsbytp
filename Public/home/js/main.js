$(document).ready(function(){
	maphover();
	// contTop(".content");
	
});

function maphover(){
	var self = "";
	$(".city").hover(
		function(){
			self = $(this);
			self.addClass("hover").children("div").show();
		},
		function(){
			self = $(this);
			self.children("div").hide();
			self.removeClass("hover");
		}
	);
	$(".city").click(
		function(){
			self = $(this);
			self.addClass("hover").children("div").show();
		},
		function(){
			self = $(this);
			self.children("div").hide();
			self.removeClass("hover");
		}
	);
		
};

// function contTop(selecr){
// 	var $dom = $(selecr);
// 	$('html,body').stop().animate({scrollTop:$dom.offset().top},0); 
// }