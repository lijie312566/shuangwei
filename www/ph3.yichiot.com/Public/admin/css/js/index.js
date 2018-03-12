
$(function () {

	$(".table tr td:first-child img").click(function(){
		$(this).attr('src',$(this).attr('src')=='img/square.png'?'img/square2.png':'img/square.png');
	});

	/*楼层编辑*/
	$(".input_lcedit i .down").click(function(){

	var x = $('.input_lcedit').find('.val').val();
		if (x>1) {
			x--;
			$(this).siblings('.val').val(x);
		}
	})
	$(".input_lcedit i .up").click(function(){
		
	var x = $('.input_lcedit').find('.val').val();
			x++;
			$(this).siblings('.val').val(x);
	})
	/*库区编辑*/
	$(".input_kqedit i .down").click(function(){

	var x = $('.input_kqedit').find('.val').val();
		if (x>1) {
			x--;
			$(this).siblings('.val').val(x);
		}
	})
	$(".input_kqedit i .up").click(function(){
		
	var x = $('.input_kqedit').find('.val').val();
			x++;
			$(this).siblings('.val').val(x);
	})







	
	
	$('.titles li').each(function (i,e) {
		$(this).parents('.titles').siblings().find('.one').eq(0).show().siblings().hide();
		$(e).find('a').click(function () {
		    $(this).addClass('actives').parent().siblings().find('a').removeClass('actives');
		    $(this).parents('.titles').siblings().find('.one').eq(i).show().siblings().hide();
	    });
	});
	
	
	//楼层
	var n = $('.up_down_top').find('.val').val();
	var m1 = 0,m2=0,m3=0,m4=0,m5=0;
	$('.up_down_top').find('.down').click(function () {
		if (n>1) {
			n--;
			$(this).siblings('.val').val(n);
			var newHeight = (n-1)*85.5 + 94 + 'px';
			$('.map_l_t').height(newHeight);
			
			if (n==1) {
	        	$('.up_down_bottom').find('.val').val(m1);
	        	$('.map_l_one').nextAll().css('display','none');
	        }if (n==2) {
	        	$('.up_down_bottom').find('.val').val(m2);
	        	$('.map_l_two').nextAll().css('display','none');
	        }if (n==3) {
	        	$('.up_down_bottom').find('.val').val(m3);
	        	$('.map_l_three').nextAll().css('display','none');
	        }if (n==4) {
	        	$('.up_down_bottom').find('.val').val(m4);
	        	$('.map_l_four').nextAll().css('display','none');
	        }if (n==5) {
	        	$('.up_down_bottom').find('.val').val(m5);
	        }
		}
		
	});
	$('.up_down_top').find('.up').click(function () {
		if (n<5) {
			var newHeight = n*85.5 + 94 + 'px';
	        $('.map_l_t').height(newHeight);
			n ++;
	        $(this).siblings('.val').val(n);
	        
	        if (n==1) {
	        	$('.up_down_bottom').find('.val').val(m1);
	        	$('.map_l_one').css('display','block');
	        }if (n==2) {
	        	$('.up_down_bottom').find('.val').val(m2);
	        	$('.map_l_two').css('display','block');
	        }if (n==3) {
	        	$('.up_down_bottom').find('.val').val(m3);
	        	$('.map_l_three').css('display','block');
	        }if (n==4) {
	        	$('.up_down_bottom').find('.val').val(m4);
	        	$('.map_l_four').css('display','block');
	        }if (n==5) {
	        	$('.up_down_bottom').find('.val').val(m5);
	        	$('.map_l_five').css('display','block');
	        }
		}
	});
	//库区
	var m = $('.up_down_bottom').find('.val').val();
	var t;
	$('.up_down_bottom').find('.down').click(function () {
		t = 49 + 85.5*(n-1) + 'px';
		if (t == '49px') {
			if (m1>0) {
				m1--;
				$(this).siblings('.val').val(m1);
				if (m1<8) {
					$('.map_l_t .map_l_one').find('img').last().remove();
				}
			}
			
		}if (t == '134.5px') {
			if (m2>0) {
				m2--;
				$(this).siblings('.val').val(m2);
				if (m2<8) {
					$('.map_l_t .map_l_two').find('img').last().remove();
				}
			}
			
		}if (t == '220px') {
			if (m3>0) {
				m3--;
				$(this).siblings('.val').val(m3);
				if (m3<8) {
					$('.map_l_t .map_l_three').find('img').last().remove();
				}
			}
			
		}if (t == '305.5px') {
			if (m4>0) {
				m4--;
				$(this).siblings('.val').val(m4);
				if (m4<8) {
					$('.map_l_t .map_l_four').find('img').last().remove();
				}
			}
			
		}if (t == '391px') {
			if (m5>0) {
				m5--;
				$(this).siblings('.val').val(m5);
				if (m5<8) {
					$('.map_l_t .map_l_five').find('img').last().remove();
				}
			}
		}
		
	});
	$('.up_down_bottom').find('.up').click(function () {
		
		t = 49 + 85.5*(n-1) + 'px';
		if (t == '49px') {
			if (m1<20) {
				m1 ++;
		        $(this).siblings('.val').val(m1);
		        if (m1<=8) {
		        	var ahtml = $('.map_l_t .map_l_one').html();
		        	if (m1<=4) {
		        		var l = 6.5 + 9.5*(m1-1)+'%';
		        	} else{
		        		var l = 57.5 + 9.5*(m1-5)+'%';
		        	}
		        	var t = 49 + 85.5*(n-1) + 'px';
		        	$('.map_l_t .map_l_one').html(ahtml + '<img src="img/position_blue.png"/>');
		        	$('.map_l_t .map_l_one').find('img').eq(m1-1).css({'left':l,'top':t});
		        }
			}
			
		}if (t == '134.5px') {
			if (m2<20) {
				m2 ++;
		        $(this).siblings('.val').val(m2);
		        if (m2<=8) {
		        	var ahtml = $('.map_l_t .map_l_two').html();
		        	if (m2<=4) {
		        		var l = 6.5 + 9.5*(m2-1)+'%';
		        	} else{
		        		var l = 57.5 + 9.5*(m2-5)+'%';
		        	}
		        	var t = 49 + 85.5*(n-1) + 'px';
		        	$('.map_l_t .map_l_two').html(ahtml + '<img src="img/position_blue.png"/>');
		        	$('.map_l_t .map_l_two').find('img').eq(m2-1).css({'left':l,'top':t});
		        }
			}
			
		}if (t == '220px') {
			if (m3<20) {
				m3 ++;
		        $(this).siblings('.val').val(m3);
		        if (m3<=8) {
		        	var ahtml = $('.map_l_t .map_l_three').html();
		        	if (m3<=4) {
		        		var l = 6.5 + 9.5*(m3-1)+'%';
		        	} else{
		        		var l = 57.5 + 9.5*(m3-5)+'%';
		        	}
		        	var t = 49 + 85.5*(n-1) + 'px';
		        	$('.map_l_t .map_l_three').html(ahtml + '<img src="img/position_blue.png"/>');
		        	$('.map_l_t .map_l_three').find('img').eq(m3-1).css({'left':l,'top':t});
		        }
			}
			
		}if (t == '305.5px') {
			if (m4<20) {
				m4 ++;
		        $(this).siblings('.val').val(m4);
		        if (m4<=8) {
		        	var ahtml = $('.map_l_t .map_l_four').html();
		        	if (m4<=4) {
		        		var l = 6.5 + 9.5*(m4-1)+'%';
		        	} else{
		        		var l = 57.5 + 9.5*(m4-5)+'%';
		        	}
		        	var t = 49 + 85.5*(n-1) + 'px';
		        	$('.map_l_t .map_l_four').html(ahtml + '<img src="img/position_blue.png"/>');
		        	$('.map_l_t .map_l_four').find('img').eq(m4-1).css({'left':l,'top':t});
		        }
			}
		}if (t == '391px') {
			if (m5<20) {
				m5 ++;
		        $(this).siblings('.val').val(m5);
		        if (m5<=8) {
		        	var ahtml = $('.map_l_t .map_l_five').html();
		        	if (m5<=4) {
		        		var l = 6.5 + 9.5*(m5-1)+'%';
		        	} else{
		        		var l = 57.5 + 9.5*(m5-5)+'%';
		        	}
		        	var t = 49 + 85.5*(n-1) + 'px';
		        	$('.map_l_t .map_l_five').html(ahtml + '<img src="img/position_blue.png"/>');
		        	$('.map_l_t .map_l_five').find('img').eq(m5-1).css({'left':l,'top':t});
		        }
			}
		}
		
	});
		
	
	
	
});

//弹窗
function alertClick () {
	$('.alert_out').show();
	$('.alert_del').click(function () {
		$('.alert_out').hide();
	});
	$('.cancel').click(function () {
		$('.alert_out').hide();
	});
	$('.update').click(function () {
		console.log(1)
		$('.file').click();
	});
}



