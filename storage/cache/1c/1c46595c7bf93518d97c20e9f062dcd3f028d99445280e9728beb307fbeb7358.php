<?php

/* common/pagination.twig */
class __TwigTemplate_b4cc3329f786e1a4e7f92dd39ad2d7f4843641042c83396eefa3d5e0ce0f29e7 extends Twig_Template
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
        echo "<ul class=\"pagination\">
  ";
        // line 2
        if (($context["first"] ?? null)) {
            // line 3
            echo "    <li class=\"page-item\"><a href=\"";
            echo ($context["first"] ?? null);
            echo "\" class=\"page-link\">|&lt;</a></li>
  ";
        }
        // line 5
        echo "  ";
        if (($context["prev"] ?? null)) {
            // line 6
            echo "    <li class=\"page-item\"><a href=\"";
            echo ($context["prev"] ?? null);
            echo "\" class=\"page-link\">&lt;</a></li>
  ";
        }
        // line 8
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 9
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, $context["link"], "page", array()) == ($context["page"] ?? null))) {
                // line 10
                echo "      <li class=\"page-item active\"><span class=\"page-link\">";
                echo twig_get_attribute($this->env, $this->source, $context["link"], "page", array());
                echo "</span></li>
    ";
            } else {
                // line 12
                echo "      <li class=\"page-item\"><a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["link"], "href", array());
                echo "\" class=\"page-link\">";
                echo twig_get_attribute($this->env, $this->source, $context["link"], "page", array());
                echo "</a></li>
    ";
            }
            // line 14
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "  ";
        if (($context["next"] ?? null)) {
            // line 16
            echo "    <li class=\"page-item\"><a href=\"";
            echo ($context["next"] ?? null);
            echo "\" class=\"page-link\">&gt;</a></li>
  ";
        }
        // line 18
        echo "  ";
        if (($context["last"] ?? null)) {
            // line 19
            echo "    <li class=\"page-item\"><a href=\"";
            echo ($context["last"] ?? null);
            echo "\" class=\"page-link\">&gt;|</a></li>
  ";
        }
        // line 21
        echo "</ul>";
    }

    public function getTemplateName()
    {
        return "common/pagination.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 21,  83 => 19,  80 => 18,  74 => 16,  71 => 15,  65 => 14,  57 => 12,  51 => 10,  48 => 9,  43 => 8,  37 => 6,  34 => 5,  28 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "common/pagination.twig", "F:\\wamp64\\www\\mycncart\\admin\\view\\template\\common\\pagination.twig");
    }
}
