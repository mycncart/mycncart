<?php

/* extension/dashboard/map_info.twig */
class __TwigTemplate_500eb5052f0679b7a1a23f3185fae9d7f64f1ee491a3082d674ddbd231ab85d7 extends Twig_Template
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
    <h3 class=\"panel-title\"><i class=\"fa fa-globe\"></i> ";
        // line 3
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h3>
  </div>
  <div class=\"panel-body\">
    <div id=\"vmap\" style=\"width: 100%; height: 260px;\"></div>
  </div>
</div>
<link type=\"text/css\" href=\"view/javascript/jquery/jqvmap/jqvmap.css\" rel=\"stylesheet\" media=\"screen\" />
<script type=\"text/javascript\" src=\"view/javascript/jquery/jqvmap/jquery.vmap.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/jquery/jqvmap/maps/jquery.vmap.world.js\"></script> 
<script type=\"text/javascript\"><!--
\$(document).ready(function() {
\t\$.ajax({
\t\turl: 'index.php?route=extension/dashboard/map/map&user_token=";
        // line 15
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "',
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tdata = [];
\t\t\t\t\t\t
\t\t\tfor (i in json) {
\t\t\t\tdata[i] = json[i]['total'];
\t\t\t}
\t\t\t\t\t
\t\t\t\$('#vmap').vectorMap({
\t\t\t\tmap: 'world_en',
\t\t\t\tbackgroundColor: '#FFFFFF',
\t\t\t\tborderColor: '#FFFFFF',
\t\t\t\tcolor: '#9FD5F1',
\t\t\t\thoverOpacity: 0.7,
\t\t\t\tselectedColor: '#666666',
\t\t\t\tenableZoom: true,
\t\t\t\tshowTooltip: true,
\t\t\t\tvalues: data,
\t\t\t\tnormalizeFunction: 'polynomial',
\t\t\t\tonLabelShow: function(event, label, code) {
\t\t\t\t\tif (json[code]) {
\t\t\t\t\t\tlabel.html('<strong>' + label.text() + '</strong><br />' + '";
        // line 37
        echo (isset($context["text_order"]) ? $context["text_order"] : null);
        echo " ' + json[code]['total'] + '<br />' + '";
        echo (isset($context["text_sale"]) ? $context["text_sale"] : null);
        echo " ' + json[code]['amount']);
\t\t\t\t\t}
\t\t\t\t}
\t\t\t});\t\t\t
\t\t},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
        }
\t});\t\t\t
});
//--></script> ";
    }

    public function getTemplateName()
    {
        return "extension/dashboard/map_info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 37,  38 => 15,  23 => 3,  19 => 1,);
    }
}
/* <div class="panel panel-default">*/
/*   <div class="panel-heading">*/
/*     <h3 class="panel-title"><i class="fa fa-globe"></i> {{ heading_title }}</h3>*/
/*   </div>*/
/*   <div class="panel-body">*/
/*     <div id="vmap" style="width: 100%; height: 260px;"></div>*/
/*   </div>*/
/* </div>*/
/* <link type="text/css" href="view/javascript/jquery/jqvmap/jqvmap.css" rel="stylesheet" media="screen" />*/
/* <script type="text/javascript" src="view/javascript/jquery/jqvmap/jquery.vmap.js"></script> */
/* <script type="text/javascript" src="view/javascript/jquery/jqvmap/maps/jquery.vmap.world.js"></script> */
/* <script type="text/javascript"><!--*/
/* $(document).ready(function() {*/
/* 	$.ajax({*/
/* 		url: 'index.php?route=extension/dashboard/map/map&user_token={{ user_token }}',*/
/* 		dataType: 'json',*/
/* 		success: function(json) {*/
/* 			data = [];*/
/* 						*/
/* 			for (i in json) {*/
/* 				data[i] = json[i]['total'];*/
/* 			}*/
/* 					*/
/* 			$('#vmap').vectorMap({*/
/* 				map: 'world_en',*/
/* 				backgroundColor: '#FFFFFF',*/
/* 				borderColor: '#FFFFFF',*/
/* 				color: '#9FD5F1',*/
/* 				hoverOpacity: 0.7,*/
/* 				selectedColor: '#666666',*/
/* 				enableZoom: true,*/
/* 				showTooltip: true,*/
/* 				values: data,*/
/* 				normalizeFunction: 'polynomial',*/
/* 				onLabelShow: function(event, label, code) {*/
/* 					if (json[code]) {*/
/* 						label.html('<strong>' + label.text() + '</strong><br />' + '{{ text_order }} ' + json[code]['total'] + '<br />' + '{{ text_sale }} ' + json[code]['amount']);*/
/* 					}*/
/* 				}*/
/* 			});			*/
/* 		},*/
/*         error: function(xhr, ajaxOptions, thrownError) {*/
/*             alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);*/
/*         }*/
/* 	});			*/
/* });*/
/* //--></script> */
