var day;
var hour;
var minute;
var second;
var i;

$(document).ready(function() {
	showtime();				   
	setInterval(showtime,1000);
}); 

function showtime(){
	if(time>0){
	//计算天
	day = Math.floor(time/86400);
	//计算小时
	i=time%86400;
	hour = Math.floor(i/3600);
	//计算分钟
	i=i%3600;
	minute = Math.floor(i/60);
	//计算秒
	second = i%60;
	};
//	if(time==0) $('#remainTime').html('团购结束');	
	i='';
	if(day!=0){i+='<span>'+day+'</span>天';}
	if(hour!=0){i+='<span>'+hour+'</span>小时';}
	if(minute!=0){i+='<span>'+minute+'</span>分';}
	if(second!=0){i+='<span>'+second+'</span>秒';}
	if(time<=0 && is_seckill==1){
		if(start){
			i='秒杀开始';
			$('#TimeText').html('快秒TA，只剩下');
			document.getElementById("TimeStart").href='@mod=index&code=buy&id='+id;
			time=last;
			showtime();
		}else{
			i='秒杀结束';
		}
	}
	if(time<=0 && is_seckill==0){i='团购结束';}
	$('#remainTime').html(i);
	time--;
}