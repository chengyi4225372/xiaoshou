<?php if (!defined('THINK_PATH')) exit();?>
<?php if(is_array($list)): foreach($list as $key=>$v): $cates = explode(",",$v['cateids']); if($v['btype'] == 1){ $cArr = $_mhStore; }else{ $cArr = $_xsStore; } foreach($cates as $k=>$val){ if($k<=1){ $arr_catename = "<label class='tag'>".$cArr[$val]."</label>"; } else { $arr_catename .= "<label class='tag' style='margin-left:4px;'>".$cArr[$val]."</label>"; } } ?>
<li class="section-block">	
	<?php if($v['btype'] == 3): ?><a href="<?php echo U('Index/stInfo',array('id'=>$v['id']));?>" class="client-url section-data">

	<?php else: ?>
		<a href="<?php echo U('Index/info',array('id'=>$v['id']));?>" class="client-url section-data"><?php endif; ?>				
			
		<div class="r_img"><img alt="<?php echo ($v["title"]); ?>" src="/Public/home/img/icon/default_img.png" data-original="<?php echo ($v["coverpic"]); ?>"><?php if(($v["isfw"]) == "2"): ?><strong>限免</strong><?php endif; ?></div>						
		<div class="r_img_text">							
			<h3><?php echo ($v["title"]); ?></h3>							
			<p><?php echo ($v["remark"]); ?></p>							
			<div class="i_images_txt_other"><strong><i style="color: #ffc701;"><?php echo ($v['status']==1?连载中:已完结); ?></i><b><?php echo ($arr_catename); ?></b></strong><em>0人在追</em></div>						
		</div>					
	</a>				
</li><?php endforeach; endif; ?>