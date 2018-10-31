<?php

/* extension/dashboard/recent_info.twig */
class __TwigTemplate_d16af70b08ebd3afe1dffee655c429c2165082571c89137d2ca272bc7531de16 extends Twig_Template
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
        echo "<div class=\"card mb-3\">
  <div class=\"card-header\"><i class=\"fas fa-shopping-cart\"></i> ";
        // line 2
        echo ($context["heading_title"] ?? null);
        echo "</div>
  <div class=\"table-responsive\">
    <table class=\"table\">
      <thead>
        <tr>
          <td class=\"text-right\">";
        // line 7
        echo ($context["column_order_id"] ?? null);
        echo "</td>
          <td>";
        // line 8
        echo ($context["column_customer"] ?? null);
        echo "</td>
          <td>";
        // line 9
        echo ($context["column_status"] ?? null);
        echo "</td>
          <td>";
        // line 10
        echo ($context["column_date_added"] ?? null);
        echo "</td>
          <td class=\"text-right\">";
        // line 11
        echo ($context["column_total"] ?? null);
        echo "</td>
          <td class=\"text-right\">";
        // line 12
        echo ($context["column_action"] ?? null);
        echo "</td>
        </tr>
      </thead>
      <tbody>
        ";
        // line 16
        if (($context["orders"] ?? null)) {
            // line 17
            echo "          ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 18
                echo "            <tr>
              <td class=\"text-right\">";
                // line 19
                echo twig_get_attribute($this->env, $this->source, $context["order"], "order_id", array());
                echo "</td>
              <td>";
                // line 20
                echo twig_get_attribute($this->env, $this->source, $context["order"], "customer", array());
                echo "</td>
              <td>";
                // line 21
                echo twig_get_attribute($this->env, $this->source, $context["order"], "status", array());
                echo "</td>
              <td>";
                // line 22
                echo twig_get_attribute($this->env, $this->source, $context["order"], "date_added", array());
                echo "</td>
              <td class=\"text-right\">";
                // line 23
                echo twig_get_attribute($this->env, $this->source, $context["order"], "total", array());
                echo "</td>
              <td class=\"text-right\"><a href=\"";
                // line 24
                echo twig_get_attribute($this->env, $this->source, $context["order"], "view", array());
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_view"] ?? null);
                echo "\" class=\"btn btn-info\"><i class=\"fas fa-eye\"></i></a></td>
            </tr>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "        ";
        } else {
            // line 28
            echo "          <tr>
            <td class=\"text-center\" colspan=\"6\">";
            // line 29
            echo ($context["text_no_results"] ?? null);
            echo "</td>
          </tr>
        ";
        }
        // line 32
        echo "      </tbody>
    </table>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "extension/dashboard/recent_info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 32,  108 => 29,  105 => 28,  102 => 27,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  75 => 20,  71 => 19,  68 => 18,  63 => 17,  61 => 16,  54 => 12,  50 => 11,  46 => 10,  42 => 9,  38 => 8,  34 => 7,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "extension/dashboard/recent_info.twig", "F:\\wamp64\\www\\mycncart\\admin\\view\\template\\extension\\dashboard\\recent_info.twig");
    }
}
