<?php

/* extension/dashboard/order_info.twig */
class __TwigTemplate_d349c16f7a70c7fe94ec11d84e2559445174afa01ba0cf6f138be19a043d88a8 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

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
        echo ($context["heading_title"] ?? null);
        echo " <span class=\"float-right\">
    ";
        // line 3
        if ((($context["percentage"] ?? null) > 0)) {
            // line 4
            echo "      <i class=\"fas fa-caret-up\"></i>
    ";
        } elseif ((        // line 5
($context["percentage"] ?? null) < 0)) {
            // line 6
            echo "      <i class=\"fas fa-caret-down\"></i>
    ";
        }
        // line 8
        echo "      ";
        echo ($context["percentage"] ?? null);
        echo "%</span></div>
  <div class=\"tile-body\"><i class=\"fas fa-shopping-cart\"></i>
    <h2 class=\"float-right\">";
        // line 10
        echo ($context["total"] ?? null);
        echo "</h2>
  </div>
  <div class=\"tile-footer\"><a href=\"";
        // line 12
        echo ($context["order"] ?? null);
        echo "\">";
        echo ($context["text_view"] ?? null);
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
        return array (  52 => 12,  47 => 10,  41 => 8,  37 => 6,  35 => 5,  32 => 4,  30 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "extension/dashboard/order_info.twig", "F:\\wamp64\\www\\mycncart\\admin\\view\\template\\extension\\dashboard\\order_info.twig");
    }
}
