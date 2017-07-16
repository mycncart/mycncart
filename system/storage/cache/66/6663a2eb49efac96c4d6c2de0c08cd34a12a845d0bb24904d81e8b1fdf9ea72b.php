<?php

/* common/column_left.twig */
class __TwigTemplate_1051f2f5a170ae143c805cc3768bf36b0b29584d8c87047ae226f304af5c790e extends Twig_Template
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
        echo "<ul class=\"list-group\">
  ";
        // line 2
        if ((twig_slice($this->env, (isset($context["route"]) ? $context["route"] : null), 0, 8) != "upgrade/")) {
            // line 3
            echo "  ";
            if (((isset($context["route"]) ? $context["route"] : null) == "install/step_1")) {
                // line 4
                echo "  <li class=\"list-group-item\"><b>";
                echo (isset($context["text_license"]) ? $context["text_license"] : null);
                echo "</b></li>
  ";
            } else {
                // line 6
                echo "  <li class=\"list-group-item\">";
                echo (isset($context["text_license"]) ? $context["text_license"] : null);
                echo "</li>
  ";
            }
            // line 8
            echo "  ";
            if (((isset($context["route"]) ? $context["route"] : null) == "install/step_2")) {
                // line 9
                echo "  <li class=\"list-group-item\"><b>";
                echo (isset($context["text_installation"]) ? $context["text_installation"] : null);
                echo "</b></li>
  ";
            } else {
                // line 11
                echo "  <li class=\"list-group-item\">";
                echo (isset($context["text_installation"]) ? $context["text_installation"] : null);
                echo "</li>
  ";
            }
            // line 13
            echo "  ";
            if (((isset($context["route"]) ? $context["route"] : null) == "install/step_3")) {
                // line 14
                echo "  <li class=\"list-group-item\"><b>";
                echo (isset($context["text_configuration"]) ? $context["text_configuration"] : null);
                echo "</b></li>
  ";
            } else {
                // line 16
                echo "  <li class=\"list-group-item\">";
                echo (isset($context["text_configuration"]) ? $context["text_configuration"] : null);
                echo "</li>
  ";
            }
            // line 18
            echo "  ";
        } else {
            // line 19
            echo "  ";
            if (((isset($context["route"]) ? $context["route"] : null) == "upgrade/upgrade")) {
                // line 20
                echo "  <li class=\"list-group-item\"><b>";
                echo (isset($context["text_upgrade"]) ? $context["text_upgrade"] : null);
                echo "</b></li>
  ";
            } else {
                // line 22
                echo "  <li class=\"list-group-item\">";
                echo (isset($context["text_upgrade"]) ? $context["text_upgrade"] : null);
                echo "</li>
  ";
            }
            // line 24
            echo "  ";
            if (((isset($context["route"]) ? $context["route"] : null) == "upgrade/upgrade/success")) {
                // line 25
                echo "  <li class=\"list-group-item\"><b>";
                echo (isset($context["text_finished"]) ? $context["text_finished"] : null);
                echo "</b></li>
  ";
            } else {
                // line 27
                echo "  <li class=\"list-group-item\">";
                echo (isset($context["text_finished"]) ? $context["text_finished"] : null);
                echo "</li>
  ";
            }
            // line 29
            echo "  ";
        }
        // line 30
        echo "</ul>
<form action=\"";
        // line 31
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"language\">
  <ul class=\"list-group\">
    <li class=\"list-group-item\">
      <div class=\"dropdown\">
        <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">";
        // line 35
        echo (isset($context["text_language"]) ? $context["text_language"] : null);
        echo " <span class=\"caret\"></span></button>
        <ul class=\"dropdown-menu\">
          ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["languages"]) ? $context["languages"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 38
            echo "          <li><a href=\"";
            echo $context["language"];
            echo "\"><img src=\"language/";
            echo $context["language"];
            echo "/";
            echo $context["language"];
            echo ".png\" /></a></li>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "        </ul>
      </div>
    </li>
  </ul>
  <input type=\"hidden\" name=\"code\" value=\"\" />
  <input type=\"hidden\" name=\"redirect\" value=\"";
        // line 45
        echo (isset($context["redirect"]) ? $context["redirect"] : null);
        echo "\" />
</form>
<script type=\"text/javascript\"><!--
// Language
\$('#language a').on('click', function(e) {
\te.preventDefault();

\t\$('#language input[name=\\'code\\']').val(\$(this).attr('href'));

\t\$('#language').submit();
});
--></script> 
";
    }

    public function getTemplateName()
    {
        return "common/column_left.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 45,  137 => 40,  124 => 38,  120 => 37,  115 => 35,  108 => 31,  105 => 30,  102 => 29,  96 => 27,  90 => 25,  87 => 24,  81 => 22,  75 => 20,  72 => 19,  69 => 18,  63 => 16,  57 => 14,  54 => 13,  48 => 11,  42 => 9,  39 => 8,  33 => 6,  27 => 4,  24 => 3,  22 => 2,  19 => 1,);
    }
}
/* <ul class="list-group">*/
/*   {% if route|slice(0, 8) != 'upgrade/' %}*/
/*   {% if route == 'install/step_1' %}*/
/*   <li class="list-group-item"><b>{{ text_license }}</b></li>*/
/*   {% else %}*/
/*   <li class="list-group-item">{{ text_license }}</li>*/
/*   {% endif %}*/
/*   {% if route == 'install/step_2' %}*/
/*   <li class="list-group-item"><b>{{ text_installation }}</b></li>*/
/*   {% else %}*/
/*   <li class="list-group-item">{{ text_installation }}</li>*/
/*   {% endif %}*/
/*   {% if route == 'install/step_3' %}*/
/*   <li class="list-group-item"><b>{{ text_configuration }}</b></li>*/
/*   {% else %}*/
/*   <li class="list-group-item">{{ text_configuration }}</li>*/
/*   {% endif %}*/
/*   {% else %}*/
/*   {% if route == 'upgrade/upgrade' %}*/
/*   <li class="list-group-item"><b>{{ text_upgrade }}</b></li>*/
/*   {% else %}*/
/*   <li class="list-group-item">{{ text_upgrade }}</li>*/
/*   {% endif %}*/
/*   {% if route == 'upgrade/upgrade/success' %}*/
/*   <li class="list-group-item"><b>{{ text_finished }}</b></li>*/
/*   {% else %}*/
/*   <li class="list-group-item">{{ text_finished }}</li>*/
/*   {% endif %}*/
/*   {% endif %}*/
/* </ul>*/
/* <form action="{{ action }}" method="post" enctype="multipart/form-data" id="language">*/
/*   <ul class="list-group">*/
/*     <li class="list-group-item">*/
/*       <div class="dropdown">*/
/*         <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{ text_language }} <span class="caret"></span></button>*/
/*         <ul class="dropdown-menu">*/
/*           {% for language in languages %}*/
/*           <li><a href="{{ language }}"><img src="language/{{ language }}/{{ language }}.png" /></a></li>*/
/*           {% endfor %}*/
/*         </ul>*/
/*       </div>*/
/*     </li>*/
/*   </ul>*/
/*   <input type="hidden" name="code" value="" />*/
/*   <input type="hidden" name="redirect" value="{{ redirect }}" />*/
/* </form>*/
/* <script type="text/javascript"><!--*/
/* // Language*/
/* $('#language a').on('click', function(e) {*/
/* 	e.preventDefault();*/
/* */
/* 	$('#language input[name=\'code\']').val($(this).attr('href'));*/
/* */
/* 	$('#language').submit();*/
/* });*/
/* --></script> */
/* */
