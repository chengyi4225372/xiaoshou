
//定义提交按钮事件
$('#ajaxBtn').click(function(){
	var data = $("form").serialize();
		url = $("form").attr("action");
	$.post(url,data,function(d){
		if(d){
			if(d.status){
				if(d.url){
					layer.alert(d.info,function(){
						location.href=d.url;
					});
				}else{
					layer.alert(d.info,function(){
						location.reload();
					});
				}
			}else{
				layer.alert(d.info);
			}
		}else{
			layer.alert('请求失败');
		}
	});
});


//代理通用删除功能
function deleteMchTables($table,$id){
	if($table && $id){
		layer.confirm("确定是否要删除？",function(){
			layer.load(2);
			$.post("./mch.php?=m=&=Index&a=delTableByid",{table:$table,id:$id},function(d){
				if(d){
					layer.closeAll();
					if(d.status){
						layer.alert(d.info,function(){
							location.href=d.url;
						});
					}else{
						layer.alert(d.info);
					}
				}else{
					layer.closeAll();
					layer.alert('请求失败');
				}
			})
		})
	}
}

//总后台通用删除功能
function deleteAmTables($table,$id){
	if($table && $id){
		layer.confirm("确定是否要删除？",function(){
			layer.load(2);
			$.post("./admin.php?=m=&=Index&a=delTableByid",{table:$table,id:$id},function(d){
				if(d){
					layer.closeAll();
					if(d.status){
						layer.alert(d.info,function(){
							location.href=d.url;
						});
					}else{
						layer.alert(d.info);
					}
				}else{
					layer.closeAll();
					layer.alert('请求失败');
				}
			})
		})
	}
}
