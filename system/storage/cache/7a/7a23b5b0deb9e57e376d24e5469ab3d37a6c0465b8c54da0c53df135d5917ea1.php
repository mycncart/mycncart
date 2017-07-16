<?php

/* extension/dashboard/order_info.twig */
class __TwigTemplate_cd1c6d491ac1ba0a96d633c210ef03212efb70748e1aee67d797c9bdbdceacc8 extends Twig_Template
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
        echo "<div class=\"tile tile-primary\">
  <div class=\"tile-heading\">";
        // line 2
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo " <span class=\"pull-right\">
    ";
        // line 3
        if (((isset($context["percentage"]) ? $context["percentage"] : null) > 0)) {
            echo " 
    <i class=\"fa fa-caret-up\"></i>
    ";
        } elseif ((        // line 5
(isset($context["percentage"]) ? $context["percentage"] : null) < 0)) {
            // line 6
            echo "    <i class=\"fa fa-caret-down\"></i>
    ";
        }
        // line 8
        echo "    ";
        echo (isset($context["percentage"]) ? $context["percentage"] : null);
        echo "%</span></div>
  <div class=\"tile-body\"><i class=\"fa fa-shopping-cart\"></i>
    <h2 class=\"pull-right\">";
        // line 10
        echo (isset($context["total"]) ? $context["total"] : null);
        echo "</h2>
  </div>
  <div class=\"tile-footer\"><a href=\"";
        // line 12
        echo (isset($context["order"]) ? $context["order"] : null);
        echo "\">";
        echo (isset($context["text_view"]) ? $context["text_view"] : null);
        echo "</a></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "extension/dashboard/order_info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 12,  43 => 10,  37 => 8,  33 => 6,  31 => 5,  26 => 3,  22 => 2,  19 => 1,);
    }
}
/* <div class="tile tile-primary">*/
/*   <div class="tile-heading">{{ heading_title }} <span class="pull-right">*/
/*     {% if percentage > 0 %} */
/*     <i class="fa fa-caret-up"></i>*/
/*     {% elseif percentage < 0 %}*/
/*     <i class="fa fa-caret-down"></i>*/
/*     {% endif %}*/
/*     {{ percentage }}%</span></div>*/
/*   <div class="tile-body"><i class="fa fa-shopping-cart"></i>*/
/*     <h2 class="pull-right">{{ total }}</h2>*/
/*   </div>*/
/*   <div class="tile-footer"><a href="{{ order }}">{{ text_view }}</a></div>*/
/* </div>*/
/* */
