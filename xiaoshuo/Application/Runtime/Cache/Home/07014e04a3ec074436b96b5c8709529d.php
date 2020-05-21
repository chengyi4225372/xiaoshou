<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): foreach($list as $key=>$v): ?><li sbid = "<?php echo ($v['anid']); ?>">
<a href="<?php echo U('Index/readAnime',array('anid'=>$v['anid'],'chaps'=>$v['chaps']));?>">
	<div class="r_img">
		<img src="/Public/home/img/icon/default_img.png" data-original=" <?php echo ($v["coverpic"]); ?>" />
		<span></span>
	</div>
	<div class="r_img_text">
		<h3><?php echo ($v["title"]); ?></h3>
		<div class="r_img_chaptername">上次读到：第 <?php echo ($v["chaps"]); ?> 章</div>
		<div class="r_img_chaptername">更新至：第 <?php echo ($v["allchapter"]); ?> 章</div>
	</div>
</a>
</li><?php endforeach; endif; ?>
<script type="text/javascript">
 $(function () {
		$('img').picLazyLoad({
		effect : "fadeIn"
		});
		})
	</script>