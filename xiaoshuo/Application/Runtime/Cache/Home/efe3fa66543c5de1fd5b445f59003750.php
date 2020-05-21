<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): foreach($list as $key=>$v): ?><div class="item recharge">
	<div class="title">
		<?php if($type == 1): ?>充值
		<?php elseif($type == 2): ?>
			签到
		<?php else: ?>
			分享<span style="margin-left:20px;color:red">(<?php echo ($v["nickname"]); ?>)</span><?php endif; ?>
	</div>
	<div class="body">
		<div class="typo-orange">
			<?php if($type == 1): echo ($v['money']); ?>	元（+<?php echo ($v['money']*$v['lv']+$v['smoney']*$v['lv']); ?>	书币）
			<?php elseif($type == 2): ?>
				+<?php echo ($v["money"]); ?> 书币
			<?php else: ?>
				+<?php echo ($v["money"]); ?> 书币<?php endif; ?>
			
		</div>
		<div class="typo-gray">
			<?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?>
		</div>
	</div>
</div><?php endforeach; endif; ?>