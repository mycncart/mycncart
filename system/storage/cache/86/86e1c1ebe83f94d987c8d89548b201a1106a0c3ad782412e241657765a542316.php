<?php

/* install/step_4.twig */
class __TwigTemplate_f8237476428c3113daff54710682d9328df8382f5d6d38ee7a95f039b1e7f26c extends Twig_Template
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
        echo (isset($context["header"]) ? $context["header"] : null);
        echo "
<div class=\"container\">
  <header>
    <div class=\"row\">
      <div class=\"col-sm-6\">
        <h1 class=\"pull-left\">4<small>/4</small></h1>
        <h3>";
        // line 7
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "<br>
          <small>";
        // line 8
        echo (isset($context["text_step_4"]) ? $context["text_step_4"] : null);
        echo "</small></h3>
      </div>
      <div class=\"col-sm-6\">
        <div id=\"logo\" class=\"pull-right hidden-xs\"><img src=\"view/image/logo.png\" alt=\"OpenCart\" title=\"OpenCart\" /></div>
      </div>
    </div>
  </header>
  ";
        // line 15
        if ((isset($context["success"]) ? $context["success"] : null)) {
            // line 16
            echo "  <div class=\"alert alert-success alert-dismissible\">";
            echo (isset($context["success"]) ? $context["success"] : null);
            echo "</div>
  ";
        }
        // line 18
        echo "  <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
        echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
        echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  <div class=\"visit\">
    <div class=\"row\">
      <div class=\"col-sm-5 col-sm-offset-1 text-center\">
        <p><i class=\"fa fa-shopping-cart fa-5x\"></i></p>
        <a href=\"../\" class=\"btn btn-secondary\">";
        // line 25
        echo (isset($context["text_catalog"]) ? $context["text_catalog"] : null);
        echo "</a></div>
      <div class=\"col-sm-5 text-center\">
        <p><i class=\"fa fa-cog fa-5x white\"></i></p>
        <a href=\"../admin/\" class=\"btn btn-secondary\">";
        // line 28
        echo (isset($context["text_admin"]) ? $context["text_admin"] : null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"modules\">
    <div class=\"row\" id=\"extension\">
      <h2 class=\"text-center\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> ";
        // line 33
        echo (isset($context["text_loading"]) ? $context["text_loading"] : null);
        echo "</h2>
    </div>
    <div class=\"row\">
      <div class=\"col-sm-12 text-center\"><a href=\"http://www.opencart.com/index.php?route=extension/extension&utm_source=opencart_install&utm_medium=store_link&utm_campaign=opencart_install\" target=\"_BLANK\" class=\"btn btn-default\">";
        // line 36
        echo (isset($context["text_extension"]) ? $context["text_extension"] : null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"mailing\">
    <div class=\"row\">
      <div class=\"col-sm-12\"><i class=\"fa fa-envelope-o fa-5x\"></i>
        <h3>";
        // line 42
        echo (isset($context["text_mail"]) ? $context["text_mail"] : null);
        echo "<br>
          <small>";
        // line 43
        echo (isset($context["text_mail_description"]) ? $context["text_mail_description"] : null);
        echo "</small></h3>
        <a href=\"http://newsletter.opencart.com/h/r/B660EBBE4980C85C\" target=\"_BLANK\" class=\"btn btn-secondary\">";
        // line 44
        echo (isset($context["button_mail"]) ? $context["button_mail"] : null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"core-modules\">
    <div class=\"row\">
      <div class=\"col-sm-6 text-center\"><img src=\"view/image/openbay_pro.gif\" />
        <p>";
        // line 50
        echo (isset($context["text_openbay"]) ? $context["text_openbay"] : null);
        echo "</p>
        <a class=\"btn btn-primary\" href=\"";
        // line 51
        echo (isset($context["openbay"]) ? $context["openbay"] : null);
        echo "\">";
        echo (isset($context["button_setup"]) ? $context["button_setup"] : null);
        echo "</a></div>
      <div class=\"col-sm-6 text-center\"><img src=\"view/image/maxmind.gif\" />
        <p>";
        // line 53
        echo (isset($context["text_maxmind"]) ? $context["text_maxmind"] : null);
        echo "</p>
        <a class=\"btn btn-primary\" href=\"";
        // line 54
        echo (isset($context["maxmind"]) ? $context["maxmind"] : null);
        echo "\">";
        echo (isset($context["button_setup"]) ? $context["button_setup"] : null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"support text-center\">
    <div class=\"row\">
      <div class=\"col-sm-4\"><a href=\"https://www.facebook.com/pages/OpenCart/477182382328323\" class=\"icon transition\"><i class=\"fa fa-facebook fa-4x\"></i></a>
        <h3>";
        // line 60
        echo (isset($context["text_facebook"]) ? $context["text_facebook"] : null);
        echo "</h3>
        <p>";
        // line 61
        echo (isset($context["text_facebook_description"]) ? $context["text_facebook_description"] : null);
        echo "</p>
        <a href=\"https://www.facebook.com/pages/OpenCart/477182382328323\">";
        // line 62
        echo (isset($context["text_facebook_visit"]) ? $context["text_facebook_visit"] : null);
        echo "</a></div>
      <div class=\"col-sm-4\"><a href=\"http://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" class=\"icon transition\"><i class=\"fa fa-comments fa-4x\"></i></a>
        <h3>";
        // line 64
        echo (isset($context["text_forum"]) ? $context["text_forum"] : null);
        echo "</h3>
        <p>";
        // line 65
        echo (isset($context["text_forum_description"]) ? $context["text_forum_description"] : null);
        echo "</p>
        <a href=\"http://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\">";
        // line 66
        echo (isset($context["text_forum_visit"]) ? $context["text_forum_visit"] : null);
        echo "</a></div>
      <div class=\"col-sm-4\"><a href=\"http://www.opencart.com/index.php?route=partner/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" class=\"icon transition\"><i class=\"fa fa-user fa-4x\"></i></a>
        <h3>";
        // line 68
        echo (isset($context["text_commercial"]) ? $context["text_commercial"] : null);
        echo "</h3>
        <p>";
        // line 69
        echo (isset($context["text_commercial_description"]) ? $context["text_commercial_description"] : null);
        echo "</p>
        <a href=\"http://www.opencart.com/index.php?route=partner/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_BLANK\">";
        // line 70
        echo (isset($context["text_commercial_visit"]) ? $context["text_commercial_visit"] : null);
        echo "</a></div>
    </div>
  </div>
</div>
";
        // line 74
        echo (isset($context["footer"]) ? $context["footer"] : null);
        echo "
<script type=\"text/javascript\"><!--
\$(document).ready(function() {
\t\$.ajax({
\t\turl: '";
        // line 78
        echo (isset($context["extension"]) ? $context["extension"] : null);
        echo "',
\t\ttype: 'post',
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif (json['extensions']) {
\t\t\t\thtml  = '';

\t\t\t\tfor (i = 0; i < json['extensions'].length; i++) {
\t\t\t\t\textension = json['extensions'][i];

\t\t\t\t\thtml += '<div class=\"col-sm-6 module\">';
\t\t\t\t\thtml += '  <a class=\"thumbnail pull-left\" href=\"' + extension['href'] + '\"><img src=\"' + extension['image'] + '\" alt=\"' + extension['name'] + '\" /></a>';
\t\t\t\t\thtml += '  <h5>' + extension['name'] + '</h5>';
\t\t\t\t\thtml += '  <p>' + extension['price'] + ' <a target=\"_BLANK\" href=\"' + extension['href'] + '\">";
        // line 91
        echo (isset($context["text_view"]) ? $context["text_view"] : null);
        echo "</a></p>';
\t\t\t\t\thtml += '  <div class=\"clearfix\"></div>';
\t\t\t\t\thtml += '</div>';

\t\t\t\t\ti++;
\t\t\t\t}

\t\t\t\t\$('#extension').html(html);
\t\t\t} else {
\t\t\t\t\$('#extension').fadeOut();
\t\t\t}
\t\t}
\t});
});
//--></script>
";
    }

    public function getTemplateName()
    {
        return "install/step_4.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 91,  181 => 78,  174 => 74,  167 => 70,  163 => 69,  159 => 68,  154 => 66,  150 => 65,  146 => 64,  141 => 62,  137 => 61,  133 => 60,  122 => 54,  118 => 53,  111 => 51,  107 => 50,  98 => 44,  94 => 43,  90 => 42,  81 => 36,  75 => 33,  67 => 28,  61 => 25,  50 => 18,  44 => 16,  42 => 15,  32 => 8,  28 => 7,  19 => 1,);
    }
}
/* {{ header }}*/
/* <div class="container">*/
/*   <header>*/
/*     <div class="row">*/
/*       <div class="col-sm-6">*/
/*         <h1 class="pull-left">4<small>/4</small></h1>*/
/*         <h3>{{ heading_title }}<br>*/
/*           <small>{{ text_step_4 }}</small></h3>*/
/*       </div>*/
/*       <div class="col-sm-6">*/
/*         <div id="logo" class="pull-right hidden-xs"><img src="view/image/logo.png" alt="OpenCart" title="OpenCart" /></div>*/
/*       </div>*/
/*     </div>*/
/*   </header>*/
/*   {% if success %}*/
/*   <div class="alert alert-success alert-dismissible">{{ success }}</div>*/
/*   {% endif %}*/
/*   <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*     <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*   </div>*/
/*   <div class="visit">*/
/*     <div class="row">*/
/*       <div class="col-sm-5 col-sm-offset-1 text-center">*/
/*         <p><i class="fa fa-shopping-cart fa-5x"></i></p>*/
/*         <a href="../" class="btn btn-secondary">{{ text_catalog }}</a></div>*/
/*       <div class="col-sm-5 text-center">*/
/*         <p><i class="fa fa-cog fa-5x white"></i></p>*/
/*         <a href="../admin/" class="btn btn-secondary">{{ text_admin }}</a></div>*/
/*     </div>*/
/*   </div>*/
/*   <div class="modules">*/
/*     <div class="row" id="extension">*/
/*       <h2 class="text-center"><i class="fa fa-circle-o-notch fa-spin"></i> {{ text_loading }}</h2>*/
/*     </div>*/
/*     <div class="row">*/
/*       <div class="col-sm-12 text-center"><a href="http://www.opencart.com/index.php?route=extension/extension&utm_source=opencart_install&utm_medium=store_link&utm_campaign=opencart_install" target="_BLANK" class="btn btn-default">{{ text_extension }}</a></div>*/
/*     </div>*/
/*   </div>*/
/*   <div class="mailing">*/
/*     <div class="row">*/
/*       <div class="col-sm-12"><i class="fa fa-envelope-o fa-5x"></i>*/
/*         <h3>{{ text_mail }}<br>*/
/*           <small>{{ text_mail_description }}</small></h3>*/
/*         <a href="http://newsletter.opencart.com/h/r/B660EBBE4980C85C" target="_BLANK" class="btn btn-secondary">{{ button_mail }}</a></div>*/
/*     </div>*/
/*   </div>*/
/*   <div class="core-modules">*/
/*     <div class="row">*/
/*       <div class="col-sm-6 text-center"><img src="view/image/openbay_pro.gif" />*/
/*         <p>{{ text_openbay }}</p>*/
/*         <a class="btn btn-primary" href="{{ openbay }}">{{ button_setup }}</a></div>*/
/*       <div class="col-sm-6 text-center"><img src="view/image/maxmind.gif" />*/
/*         <p>{{ text_maxmind }}</p>*/
/*         <a class="btn btn-primary" href="{{ maxmind }}">{{ button_setup }}</a></div>*/
/*     </div>*/
/*   </div>*/
/*   <div class="support text-center">*/
/*     <div class="row">*/
/*       <div class="col-sm-4"><a href="https://www.facebook.com/pages/OpenCart/477182382328323" class="icon transition"><i class="fa fa-facebook fa-4x"></i></a>*/
/*         <h3>{{ text_facebook }}</h3>*/
/*         <p>{{ text_facebook_description }}</p>*/
/*         <a href="https://www.facebook.com/pages/OpenCart/477182382328323">{{ text_facebook_visit }}</a></div>*/
/*       <div class="col-sm-4"><a href="http://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install" class="icon transition"><i class="fa fa-comments fa-4x"></i></a>*/
/*         <h3>{{ text_forum }}</h3>*/
/*         <p>{{ text_forum_description }}</p>*/
/*         <a href="http://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install">{{ text_forum_visit }}</a></div>*/
/*       <div class="col-sm-4"><a href="http://www.opencart.com/index.php?route=partner/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install" class="icon transition"><i class="fa fa-user fa-4x"></i></a>*/
/*         <h3>{{ text_commercial }}</h3>*/
/*         <p>{{ text_commercial_description }}</p>*/
/*         <a href="http://www.opencart.com/index.php?route=partner/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install" target="_BLANK">{{ text_commercial_visit }}</a></div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* {{ footer }}*/
/* <script type="text/javascript"><!--*/
/* $(document).ready(function() {*/
/* 	$.ajax({*/
/* 		url: '{{ extension }}',*/
/* 		type: 'post',*/
/* 		dataType: 'json',*/
/* 		success: function(json) {*/
/* 			if (json['extensions']) {*/
/* 				html  = '';*/
/* */
/* 				for (i = 0; i < json['extensions'].length; i++) {*/
/* 					extension = json['extensions'][i];*/
/* */
/* 					html += '<div class="col-sm-6 module">';*/
/* 					html += '  <a class="thumbnail pull-left" href="' + extension['href'] + '"><img src="' + extension['image'] + '" alt="' + extension['name'] + '" /></a>';*/
/* 					html += '  <h5>' + extension['name'] + '</h5>';*/
/* 					html += '  <p>' + extension['price'] + ' <a target="_BLANK" href="' + extension['href'] + '">{{ text_view }}</a></p>';*/
/* 					html += '  <div class="clearfix"></div>';*/
/* 					html += '</div>';*/
/* */
/* 					i++;*/
/* 				}*/
/* */
/* 				$('#extension').html(html);*/
/* 			} else {*/
/* 				$('#extension').fadeOut();*/
/* 			}*/
/* 		}*/
/* 	});*/
/* });*/
/* //--></script>*/
/* */
