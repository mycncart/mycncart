<?php
//echo $telephone.'<br>';
//echo $image.'<br>';
//print_r($qqs);
?>
<link href="catalog/view/theme/default/stylesheet/kefu.css" rel="stylesheet" type="text/css" />
<div id="rightArrow"><a href="javascript:;" title="<?php echo $text_online; ?>"></a></div>
<div id="floatDivBoxs">
	<div class="floatDtt"><?php echo $text_online; ?></div>
    <div class="floatShadow">
        <?php if ($qqs) { ?>
        <ul class="floatDqq">
        	<?php foreach ($qqs as $qq) { ?>
            <li style="padding-left:0px;"><a target="_blank" href="tencent://message/?uin=<?php echo $qq['qq_number']; ?>&Menu=yes"><img src="catalog/view/theme/default/image/kefu/qq.png" align="absmiddle" title="<?php echo $qq['qq_name']; ?>" alt="<?php echo $qq['qq_name']; ?>">&nbsp;&nbsp;<?php echo $qq['qq_name']; ?></a></li>
            <?php } ?>
        </ul>
        <?php } ?>
        <div class="floatDtxt"><?php echo $text_telephone; ?></div>
        <div class="floatDtel"><?php echo $telephone; ?></div>
        <div class="floatDtxt"><?php echo $image_title; ?></div>
        <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="<?php echo $image; ?>"></div>
    </div>
    <div class="floatDbg"></div>
</div>

<script type="text/javascript"><!--
var flag=1;
$('#rightArrow').click(function(){
	if(flag==1){
		$("#floatDivBoxs").animate({right: '-175px'},300);
		$(this).animate({right: '-5px'},300);
		$(this).css('background-position','-50px 0');
		flag=0;
	}else{
		$("#floatDivBoxs").animate({right: '0'},300);
		$(this).animate({right: '170px'},300);
		$(this).css('background-position','0px 0');
		flag=1;
	}
});
//--></script>