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
	//������
	day = Math.floor(time/86400);
	//����Сʱ
	i=time%86400;
	hour = Math.floor(i/3600);
	//�������
	i=i%3600;
	minute = Math.floor(i/60);
	//������
	second = i%60;
	};
//	if(time==0) $('#remainTime').html('�Ź�����');	
	i='';
	if(day!=0){i+='<span>'+day+'</span>��';}
	if(hour!=0){i+='<span>'+hour+'</span>Сʱ';}
	if(minute!=0){i+='<span>'+minute+'</span>��';}
	if(second!=0){i+='<span>'+second+'</span>��';}
	if(time<=0 && is_seckill==1){
		if(start){
			i='��ɱ��ʼ';
			$('#TimeText').html('����TA��ֻʣ��');
			document.getElementById("TimeStart").href='@mod=index&code=buy&id='+id;
			time=last;
			showtime();
		}else{
			i='��ɱ����';
		}
	}
	if(time<=0 && is_seckill==0){i='�Ź�����';}
	$('#remainTime').html(i);
	time--;
}