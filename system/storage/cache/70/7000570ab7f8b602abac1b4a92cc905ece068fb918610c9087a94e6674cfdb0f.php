<?php

/* extension/dashboard/online_info.twig */
class __TwigTemplate_92cda39d286b59ca04e4b9c05673842b47d9dc28a9ce97500dc394848fb69130 extends Twig_Template
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
        echo "</div>
  <div class=\"tile-body\"><i class=\"fa fa-users\"></i>
    <h2 class=\"pull-right\">";
        // line 4
        echo (isset($context["total"]) ? $context["total"] : null);
        echo "</h2>
  </div>
  <div class=\"tile-footer\"><a href=\"";
        // line 6
        echo (isset($context["online"]) ? $context["online"] : null);
        echo "\">";
        echo (isset($context["text_view"]) ? $context["text_view"] : null);
        echo "</a></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "extension/dashboard/online_info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 6,  27 => 4,  22 => 2,  19 => 1,);
    }
}
/* <div class="tile tile-primary">*/
/*   <div class="tile-heading">{{ heading_title }}</div>*/
/*   <div class="tile-body"><i class="fa fa-users"></i>*/
/*     <h2 class="pull-right">{{ total }}</h2>*/
/*   </div>*/
/*   <div class="tile-footer"><a href="{{ online }}">{{ text_view }}</a></div>*/
/* </div>*/
/* */
