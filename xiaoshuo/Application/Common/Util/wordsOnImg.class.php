<?php
namespace Common\Util;

/**
 * PHP实现文字写入图片
 */
class wordsOnImg {
 
    public $config = null;
 
    /**
     * @param  $config 传入参数
     * @param  $config['file'] 图片文件
     * @param  $config['size'] 文字大小
     * @param  $config['angle'] 文字的水平角度
     * @param  $config['fontfile'] 字体文件路径
     * @param  $config['width'] 预先设置的宽度
     * @param  $config['x'] 开始写入时的横坐标
     * @param  $config['y'] 开始写入时的纵坐标
     */
    public function __construct($config=null){
        if(empty($config)){
            return 'must be config';
        }
		if(!is_dir($config['path'])){
			mkdir($config['path'], 0777,1);
		}
		$config['file_name'] = $config['path'].$config['file_name'];
        $config['file_ext'] = "png";
        $this->config = $config;
    }

   
	/*
	 * 绘图文字分行函数
	 * by COoL
	 * - 输入：
	 * str: 原字符串
	 * fontFamily: 字体
	 * fontSize: 字号
	 * charset: 字符编码
	 * width: 限制每行宽度(px)
	 * - 输出：
	 * 分行后的字符串数组
	 */
	function autoLineSplit ($str, $width) {
		$result = [];

		$len = (strlen($str) + mb_strlen($str, "utf8")) / 2;

		// 计算总占宽
		$dimensions = imagettfbbox($this->config['size'], 0, $this->config['fontfile'], $str);
		$textWidth = abs($dimensions[4] - $dimensions[0]);

		// 计算每个字符的长度
		$singleW = $this->config['size'];

		$w = $width ;
		
		
		// 计算每行最多容纳多少个字符
		$maxCount = floor($w / $singleW);

		while ($len > $maxCount) {
			// 成功取得一行
			$hang[] = mb_strimwidth($str, 0, $maxCount, '', "utf8");
			// 移除上一行的字符
			$str = str_replace($hang[count($hang) - 1], '', $str);
			// 重新计算长度
			$len = (strlen($str) + mb_strlen($str, "utf8")) / 2;
		}
		$hang[] = $str;
		return $hang;

	}
	
	
	
    /**
     * 实现写入图片
     * @param  $text 要写入的文字
     */
    public function writeWordsToImg($text){
        if(empty($this->config)){
            return 'must be config';
        }
		
		$words_text = $this->autoLineSplit($text,$this->config['width']);
		foreach($words_text as $v){
			$string.= $v."\n";
		}
		
		$wh = $this->TextWh($string);

		$im = imagecreate( $wh['w'] + ($this->config['x']*2), $wh['h'] + ($this->config['y']*2) );
		
		//图片背景颜色并填充
		$bg = imagecolorallocate($im, 255, 255, 255);
		//设定文字颜色
		$color = imagecolorallocate($im, 0, 0, 0);
		
        imagettftext($im, $this->config['size'], $this->config['angle'], $this->config['x'], $this->config['y'], $color, $this->config['fontfile'], $string);
        imagepng($im,$this->config['file_name'].".".$this->config['file_ext']);
        imagedestroy($im);
    }
	
	
	//获取文本的宽度和高度
	public function TextWh ($text) {
		$box = imagettfbbox($this->config['size'], 0,  $this->config['fontfile'], $text);
		$w = $box[4] - $box[6];
		$h = $box[3] - $box[5];
		return array(
			"w"=>$w,
			"h"=>$h,
		);
	}
	
	
}
?>

