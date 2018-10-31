<?php

/* default/template/extension/module/featured.twig */
class __TwigTemplate_245e6fab6d1ca426e9804d3c31839655ecf880785022b55197aa4db3a12a4ad3 extends Twig_Template
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
        echo "<h3>";
        echo ($context["heading_title"] ?? null);
        echo "</h3>
<div class=\"row\">
  ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 4
            echo "    <div class=\"product-layout col-lg-3 col-md-3 col-sm-6 col-12\">
      <div class=\"product-thumb transition\">
        <div class=\"image\"><a href=\"";
            // line 6
            echo twig_get_attribute($this->env, $this->source, $context["product"], "href", array());
            echo "\"><img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", array());
            echo "\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", array());
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", array());
            echo "\" class=\"img-fluid\"/></a></div>
        <div class=\"caption\">
          <h4><a href=\"";
            // line 8
            echo twig_get_attribute($this->env, $this->source, $context["product"], "href", array());
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", array());
            echo "</a></h4>
          <p>";
            // line 9
            echo twig_get_attribute($this->env, $this->source, $context["product"], "description", array());
            echo "</p>
          ";
            // line 10
            if (twig_get_attribute($this->env, $this->source, $context["product"], "rating", array())) {
                // line 11
                echo "            <div class=\"rating\">
              ";
                // line 12
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(5);
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 13
                    echo "                ";
                    if ((twig_get_attribute($this->env, $this->source, $context["product"], "rating", array()) < $context["i"])) {
                        // line 14
                        echo "                  <span class=\"fas fa-stack\"><i class=\"fas fa-star-o fa-stack-2x\"></i></span>
                ";
                    } else {
                        // line 16
                        echo "                  <span class=\"fas fa-stack\"><i class=\"fas fa-star fa-stack-2x\"></i><i class=\"fas fa-star-o fa-stack-2x\"></i></span>
                ";
                    }
                    // line 18
                    echo "              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 19
                echo "            </div>
          ";
            }
            // line 21
            echo "          ";
            if (twig_get_attribute($this->env, $this->source, $context["product"], "price", array())) {
                // line 22
                echo "            <p class=\"price\">
              ";
                // line 23
                if ( !twig_get_attribute($this->env, $this->source, $context["product"], "special", array())) {
                    // line 24
                    echo "                ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", array());
                    echo "
              ";
                } else {
                    // line 26
                    echo "                <span class=\"price-new\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "special", array());
                    echo "</span> <span class=\"price-old\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", array());
                    echo "</span>
              ";
                }
                // line 28
                echo "              ";
                if (twig_get_attribute($this->env, $this->source, $context["product"], "tax", array())) {
                    // line 29
                    echo "                <span class=\"price-tax\">";
                    echo ($context["text_tax"] ?? null);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "tax", array());
                    echo "</span>
              ";
                }
                // line 31
                echo "            </p>
          ";
            }
            // line 33
            echo "        </div>
        <div class=\"button-group\">
          <button type=\"button\" onclick=\"cart.add('";
            // line 35
            echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", array());
            echo "');\"><i class=\"fas fa-shopping-cart\"></i> <span class=\"d-none d-lg-inline\">";
            echo ($context["button_cart"] ?? null);
            echo "</span></button>
          <button type=\"button\" data-toggle=\"tooltip\" title=\"";
            // line 36
            echo ($context["button_wishlist"] ?? null);
            echo "\" onclick=\"wishlist.add('";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", array());
            echo "');\"><i class=\"fas fa-heart\"></i></button>
          <button type=\"button\" data-toggle=\"tooltip\" title=\"";
            // line 37
            echo ($context["button_compare"] ?? null);
            echo "\" onclick=\"compare.add('";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", array());
            echo "');\"><i class=\"fas fa-exchange-alt\"></i></button>
        </div>
      </div>
    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "default/template/extension/module/featured.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 42,  141 => 37,  135 => 36,  129 => 35,  125 => 33,  121 => 31,  113 => 29,  110 => 28,  102 => 26,  96 => 24,  94 => 23,  91 => 22,  88 => 21,  84 => 19,  78 => 18,  74 => 16,  70 => 14,  67 => 13,  63 => 12,  60 => 11,  58 => 10,  54 => 9,  48 => 8,  37 => 6,  33 => 4,  29 => 3,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/template/extension/module/featured.twig", "/home/opencart/3000.mycncart.com/catalog/view/theme/default/template/extension/module/featured.twig");
    }
}
