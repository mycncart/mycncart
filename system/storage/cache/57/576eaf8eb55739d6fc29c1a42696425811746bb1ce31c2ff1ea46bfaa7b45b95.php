<?php

/* extension/dashboard/chart_info.twig */
class __TwigTemplate_02cbf1e4a1e35ed3c12cc428c5788b987656cc7c871c6880f27597a0505d4033 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"panel panel-default\">
  <div class=\"panel-heading\">
    <div class=\"pull-right\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-calendar\"></i> <i class=\"caret\"></i></a>
      <ul id=\"range\" class=\"dropdown-menu dropdown-menu-right\">
        <li><a href=\"day\">";
        // line 5
        echo (isset($context["text_day"]) ? $context["text_day"] : null);
        echo "</a></li>
        <li><a href=\"week\">";
        // line 6
        echo (isset($context["text_week"]) ? $context["text_week"] : null);
        echo "</a></li>
        <li class=\"active\"><a href=\"month\">";
        // line 7
        echo (isset($context["text_month"]) ? $context["text_month"] : null);
        echo "</a></li>
        <li><a href=\"year\">";
        // line 8
        echo (isset($context["text_year"]) ? $context["text_year"] : null);
        echo "</a></li>
      </ul>
    </div>
    <h3 class=\"panel-title\"><i class=\"fa fa-bar-chart-o\"></i> ";
        // line 11
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h3>
  </div>
  <div class=\"panel-body\">
    <div id=\"chart-sale\" style=\"width: 100%; height: 260px;\"></div>
  </div>
</div>
<script type=\"text/javascript\" src=\"view/javascript/jquery/flot/jquery.flot.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/jquery/flot/jquery.flot.resize.min.js\"></script>
<script type=\"text/javascript\"><!--
\$('#range a').on('click', function(e) {
\te.preventDefault();
\t
\t\$(this).parent().parent().find('li').removeClass('active');
\t
\t\$(this).parent().addClass('active');
\t
\t\$.ajax({
\t\ttype: 'get',
\t\turl: 'index.php?route=extension/dashboard/chart/chart&user_token=";
        // line 29
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "&range=' + \$(this).attr('href'),
\t\tdataType: 'json',
\t\tsuccess: function(json) {
            if (typeof json['order'] == 'undefined') { return false; }
\t\t\t
\t\t\tvar option = {\t
\t\t\t\tshadowSize: 0,
\t\t\t\tcolors: ['#9FD5F1', '#1065D2'],
\t\t\t\tbars: { 
\t\t\t\t\tshow: true,
\t\t\t\t\tfill: true,
\t\t\t\t\tlineWidth: 1
\t\t\t\t},
\t\t\t\tgrid: {
\t\t\t\t\tbackgroundColor: '#FFFFFF',
\t\t\t\t\thoverable: true
\t\t\t\t},
\t\t\t\tpoints: {
\t\t\t\t\tshow: false
\t\t\t\t},
\t\t\t\txaxis: {
\t\t\t\t\tshow: true,
            \t\tticks: json['xaxis']
\t\t\t\t}
\t\t\t}
\t\t\t
\t\t\t\$.plot('#chart-sale', [json['order'], json['customer']], option);\t
\t\t\t\t\t
\t\t\t\$('#chart-sale').bind('plothover', function(event, pos, item) {
\t\t\t\t\$('.tooltip').remove();
\t\t\t  
\t\t\t\tif (item) {
\t\t\t\t\t\$('<div id=\"tooltip\" class=\"tooltip top in\"><div class=\"tooltip-arrow\"></div><div class=\"tooltip-inner\">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');
\t\t\t\t\t
\t\t\t\t\t\$('#tooltip').css({
\t\t\t\t\t\tposition: 'absolute',
\t\t\t\t\t\tleft: item.pageX - (\$('#tooltip').outerWidth() / 2),
\t\t\t\t\t\ttop: item.pageY - \$('#tooltip').outerHeight(),
\t\t\t\t\t\tpointer: 'cusror'
\t\t\t\t\t}).fadeIn('slow');\t
\t\t\t\t\t
\t\t\t\t\t\$('#chart-sale').css('cursor', 'pointer');\t\t
\t\t\t  \t} else {
\t\t\t\t\t\$('#chart-sale').css('cursor', 'auto');
\t\t\t\t}
\t\t\t});
\t\t},
        error: function(xhr, ajaxOptions, thrownError) {
           alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
        }
\t});
});

\$('#range .active a').trigger('click');
//--></script> ";
    }

    public function getTemplateName()
    {
        return "extension/dashboard/chart_info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 29,  43 => 11,  37 => 8,  33 => 7,  29 => 6,  25 => 5,  19 => 1,);
    }
}
/* <div class="panel panel-default">*/
/*   <div class="panel-heading">*/
/*     <div class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>*/
/*       <ul id="range" class="dropdown-menu dropdown-menu-right">*/
/*         <li><a href="day">{{ text_day }}</a></li>*/
/*         <li><a href="week">{{ text_week }}</a></li>*/
/*         <li class="active"><a href="month">{{ text_month }}</a></li>*/
/*         <li><a href="year">{{ text_year }}</a></li>*/
/*       </ul>*/
/*     </div>*/
/*     <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> {{ heading_title }}</h3>*/
/*   </div>*/
/*   <div class="panel-body">*/
/*     <div id="chart-sale" style="width: 100%; height: 260px;"></div>*/
/*   </div>*/
/* </div>*/
/* <script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.js"></script> */
/* <script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.resize.min.js"></script>*/
/* <script type="text/javascript"><!--*/
/* $('#range a').on('click', function(e) {*/
/* 	e.preventDefault();*/
/* 	*/
/* 	$(this).parent().parent().find('li').removeClass('active');*/
/* 	*/
/* 	$(this).parent().addClass('active');*/
/* 	*/
/* 	$.ajax({*/
/* 		type: 'get',*/
/* 		url: 'index.php?route=extension/dashboard/chart/chart&user_token={{ user_token }}&range=' + $(this).attr('href'),*/
/* 		dataType: 'json',*/
/* 		success: function(json) {*/
/*             if (typeof json['order'] == 'undefined') { return false; }*/
/* 			*/
/* 			var option = {	*/
/* 				shadowSize: 0,*/
/* 				colors: ['#9FD5F1', '#1065D2'],*/
/* 				bars: { */
/* 					show: true,*/
/* 					fill: true,*/
/* 					lineWidth: 1*/
/* 				},*/
/* 				grid: {*/
/* 					backgroundColor: '#FFFFFF',*/
/* 					hoverable: true*/
/* 				},*/
/* 				points: {*/
/* 					show: false*/
/* 				},*/
/* 				xaxis: {*/
/* 					show: true,*/
/*             		ticks: json['xaxis']*/
/* 				}*/
/* 			}*/
/* 			*/
/* 			$.plot('#chart-sale', [json['order'], json['customer']], option);	*/
/* 					*/
/* 			$('#chart-sale').bind('plothover', function(event, pos, item) {*/
/* 				$('.tooltip').remove();*/
/* 			  */
/* 				if (item) {*/
/* 					$('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');*/
/* 					*/
/* 					$('#tooltip').css({*/
/* 						position: 'absolute',*/
/* 						left: item.pageX - ($('#tooltip').outerWidth() / 2),*/
/* 						top: item.pageY - $('#tooltip').outerHeight(),*/
/* 						pointer: 'cusror'*/
/* 					}).fadeIn('slow');	*/
/* 					*/
/* 					$('#chart-sale').css('cursor', 'pointer');		*/
/* 			  	} else {*/
/* 					$('#chart-sale').css('cursor', 'auto');*/
/* 				}*/
/* 			});*/
/* 		},*/
/*         error: function(xhr, ajaxOptions, thrownError) {*/
/*            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);*/
/*         }*/
/* 	});*/
/* });*/
/* */
/* $('#range .active a').trigger('click');*/
/* //--></script> */
