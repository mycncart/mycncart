<?php

/* extension/dashboard/recent_info.twig */
class __TwigTemplate_2ded99869725386f6d3f09b08c4202b0d044ae3282e7866e01624cab706188b9 extends Twig_Template
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
    <h3 class=\"panel-title\"><i class=\"fa fa-shopping-cart\"></i> ";
        // line 3
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h3>
  </div>
  <div class=\"table-responsive\">
    <table class=\"table\">
      <thead>
        <tr>
          <td class=\"text-right\">";
        // line 9
        echo (isset($context["column_order_id"]) ? $context["column_order_id"] : null);
        echo "</td>
          <td>";
        // line 10
        echo (isset($context["column_customer"]) ? $context["column_customer"] : null);
        echo "</td>
          <td>";
        // line 11
        echo (isset($context["column_status"]) ? $context["column_status"] : null);
        echo "</td>
          <td>";
        // line 12
        echo (isset($context["column_date_added"]) ? $context["column_date_added"] : null);
        echo "</td>
          <td class=\"text-right\">";
        // line 13
        echo (isset($context["column_total"]) ? $context["column_total"] : null);
        echo "</td>
          <td class=\"text-right\">";
        // line 14
        echo (isset($context["column_action"]) ? $context["column_action"] : null);
        echo "</td>
        </tr>
      </thead>
      <tbody>
        ";
        // line 18
        if ((isset($context["orders"]) ? $context["orders"] : null)) {
            // line 19
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["orders"]) ? $context["orders"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 20
                echo "        <tr>
          <td class=\"text-right\">";
                // line 21
                echo $this->getAttribute($context["order"], "order_id", array());
                echo "</td>
          <td>";
                // line 22
                echo $this->getAttribute($context["order"], "customer", array());
                echo "</td>
          <td>";
                // line 23
                echo $this->getAttribute($context["order"], "status", array());
                echo "</td>
          <td>";
                // line 24
                echo $this->getAttribute($context["order"], "date_added", array());
                echo "</td>
          <td class=\"text-right\">";
                // line 25
                echo $this->getAttribute($context["order"], "total", array());
                echo "</td>
          <td class=\"text-right\"><a href=\"";
                // line 26
                echo $this->getAttribute($context["order"], "view", array());
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_view"]) ? $context["button_view"] : null);
                echo "\" class=\"btn btn-info\"><i class=\"fa fa-eye\"></i></a></td>
        </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 29
            echo "        ";
        } else {
            // line 30
            echo "        <tr>
          <td class=\"text-center\" colspan=\"6\">";
            // line 31
            echo (isset($context["text_no_results"]) ? $context["text_no_results"] : null);
            echo "</td>
        </tr>
        ";
        }
        // line 34
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
        return array (  112 => 34,  106 => 31,  103 => 30,  100 => 29,  89 => 26,  85 => 25,  81 => 24,  77 => 23,  73 => 22,  69 => 21,  66 => 20,  61 => 19,  59 => 18,  52 => 14,  48 => 13,  44 => 12,  40 => 11,  36 => 10,  32 => 9,  23 => 3,  19 => 1,);
    }
}
/* <div class="panel panel-default">*/
/*   <div class="panel-heading">*/
/*     <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> {{ heading_title }}</h3>*/
/*   </div>*/
/*   <div class="table-responsive">*/
/*     <table class="table">*/
/*       <thead>*/
/*         <tr>*/
/*           <td class="text-right">{{ column_order_id }}</td>*/
/*           <td>{{ column_customer }}</td>*/
/*           <td>{{ column_status }}</td>*/
/*           <td>{{ column_date_added }}</td>*/
/*           <td class="text-right">{{ column_total }}</td>*/
/*           <td class="text-right">{{ column_action }}</td>*/
/*         </tr>*/
/*       </thead>*/
/*       <tbody>*/
/*         {% if orders %}*/
/*         {% for order in orders %}*/
/*         <tr>*/
/*           <td class="text-right">{{ order.order_id }}</td>*/
/*           <td>{{ order.customer }}</td>*/
/*           <td>{{ order.status }}</td>*/
/*           <td>{{ order.date_added }}</td>*/
/*           <td class="text-right">{{ order.total }}</td>*/
/*           <td class="text-right"><a href="{{ order.view }}" data-toggle="tooltip" title="{{ button_view }}" class="btn btn-info"><i class="fa fa-eye"></i></a></td>*/
/*         </tr>*/
/*         {% endfor %}*/
/*         {% else %}*/
/*         <tr>*/
/*           <td class="text-center" colspan="6">{{ text_no_results }}</td>*/
/*         </tr>*/
/*         {% endif %}*/
/*       </tbody>*/
/*     </table>*/
/*   </div>*/
/* </div>*/
/* */
