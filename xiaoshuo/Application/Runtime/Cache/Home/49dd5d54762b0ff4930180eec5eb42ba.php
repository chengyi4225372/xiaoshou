<?php if (!defined('THINK_PATH')) exit();?>			<?php if(is_array($list)): foreach($list as $key=>$v): ?><li class="section-block" >
				<?php if($v['btype'] == 3): ?><a href="<?php echo U('Index/stInfo',array('id'=>$v['id']));?>">
						<div class="w-bookPic">
							<img src="<?php echo ($v["coverpic"]); ?>" style="object-fit: cover;"/>
							<div class="classifly-chapter"></div>
						</div>
						<div class="w-bookName"><?php echo ($v["title"]); ?></div>
					</a>
			    <?php else: ?>
					<a href="<?php echo U('Index/info',array('id'=>$v['id']));?>" class="section-data">
						<div class="r_img">
							<img src="/Public/home/img/icon/default_img.png" data-original="<?php echo ($v["selectpic"]); ?>"/>
						</div>
						<div class="r_img_text">
								<h3><?php echo ($v["title"]); ?></h3>
								<p><?php echo ($v["remark"]); ?></p>
								<div class="i_images_txt_other">
									<strong>
									<?php if($v['iswz'] == 2): ?><i>已完结</i>
									<?php else: ?>
									<i style="color: #ffc701;">连载中</i><?php endif; ?>
									<b><?php echo ($mtitle); ?></b>
									</strong>
									<em>人在追</em>
								</div>
						</div>
					</a><?php endif; ?>

			</li><?php endforeach; endif; ?>
<script>
    $(function () {
		$('img').picLazyLoad({
			effect : "fadeIn"
		});
	})
</script>