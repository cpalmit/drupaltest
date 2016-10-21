var $ = jQuery;
var slider = Object({
	current:0,
	auto:true,
	slider:null,
	initialize:function(_selector){
		slider.slider = $(_selector);
		slider.slider.wrap('<div class="albright-slider-wrapper">');
		$(".albright-slider-wrapper").css({'position':"relative", 'overflow':'hidden', 'width':'825px', 'height':'450px'}); /*controls how much of the image you see*/
		slider.slider.css({"position":"absolute", "width":10000, "left":0});
		slider.slider.find(".img").css({'float':'left', 'margin-right':15});
		//RH
		$("#slideshow-prev").css({'display':'none'});
		$("#slideshow-next").css({'display':'none'});
		//end RH
		slider.slider.find(".img").each(function(){
			$(".albright-nav").append('<a href=#>&bull;</a>');
		});
		
		$("img").addClass('img-responsive');
		

		var last = slider.slider.find(".img:last").clone();
		var first = slider.slider.find(".img:first").clone();

		slider.slider.prepend(last);
		slider.slider.append(first);

		slider.slider.find(".img").click(function(){
			slider.auto = false;
			var i = $(".albright-slider-wrapper .img").index($(this));
			slider.show(i - 1);
			//console.log("showing: " + i - 1);
		});

		$(".albright-nav a").hover(function(){
			slider.auto = false;
		}, function(){
			slider.auto = true; //RH
		});

		$(".albright-nav a").click(function(){
			var i = $(".albright-nav a").index($(this));
			slider.show(i);
			//console.log("showing: " + i);
			return false;
		});

		$(".albright-nav a:eq(0)").click();
		setTimeout(slider.autonext, 6000);

		//RH nav arrow functionality
		$(function() {
			$('#slideshow-next').click(function() {
					slider.show(slider.current);
					var _i = slider.current;
					//console.log("showing: " + (_i - 1));
					slider.auto = false;
			})
		})
		$(function() {
			$('#slideshow-prev').click(function() {
					slider.auto = false;
					var _i = slider.current;
					slider.show(_i - 2);
					//console.log("showing: " + (_i - 2));
			})
		})

		//RH nav arrow rollover behaviors
		$(".albright-slider").hover(function() {
  			$("#slideshow-prev").css({"display":"block"});
  			$("#slideshow-next").css({"display":"block"});
		}, function() {
			 $("#slideshow-prev").css({"display":"none"});
			 $("#slideshow-next").css({"display":"none"});
		});

		$("#slideshow-prev").hover(function() {
  			$("#slideshow-prev").css({"display":"block"});
  			$("#slideshow-next").css({"display":"block"});
		});
		$("#slideshow-next").hover(function() {
  			$("#slideshow-prev").css({"display":"block"});
  			$("#slideshow-next").css({"display":"block"});
		});
		//end RH

	},
	start:function(){
		$(".albright-nav a:eq(0)").click();
		slider.autonext();
	},
	autonext:function(){
		if(slider.auto){
			slider.show(slider.current);
			var _i = slider.current;
			//console.log("showing: " + (_i - 1));
			setTimeout(slider.autonext, 6000);
		}
	},
	show:function(_i){

		var size = slider.slider.find(".img").size()-2;

		if(_i == -1) // when going backwards, skip to 3 after 0
			_i = size-1;

		if(_i == (size)) // when going forwards, skip to 0 after 3
			_i = 0;

		_i++;

		slider.current = _i;
		var current = slider.slider.find(".img:eq("+_i+")");
		if(current.hasClass("current")){
			if(current.find("a").size()>0){
				window.location.href = current.find("a:first").attr("href");
			}
			return false;
		}

		$("div.caption").hide();
		slider.slider.find(".img").removeClass("current");

		$(".albright-nav").find("a").removeClass("active");

		$(".albright-nav").find("a:eq("+(_i-1)+")").addClass("active");
		var left = current.position().left;
		var width = current.width();
		slider.slider.find(".img:eq("+_i+")").addClass("current");

		slider.slider.stop().animate({"left":-(left-400+width/2)}, function(){ /*moves images left or right*/
			current.find("div.caption").fadeIn(300);
		});
	}


});

slider.initialize(".albright-slider");
