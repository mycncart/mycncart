<?php

/* extension/dashboard/activity_info.twig */
class __TwigTemplate_4ec417d14a2d72fa5a04acc2af7cdc0522ee408c277d7abdfe16b01a83657d58 extends Twig_Template
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
    <h3 class=\"panel-title\"><i class=\"fa fa-calendar\"></i> ";
        // line 3
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h3>
  </div>
  <ul class=\"list-group\">
    ";
        // line 6
        if ((isset($context["activities"]) ? $context["activities"] : null)) {
            // line 7
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["activities"]) ? $context["activities"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["activity"]) {
                // line 8
                echo "    <li class=\"list-group-item\">";
                echo $this->getAttribute($context["activity"], "comment", array());
                echo "<br />
      <small class=\"text-muted\"><i class=\"fa fa-clock-o\"></i> ";
                // line 9
                echo $this->getAttribute($context["activity"], "date_added", array());
                echo "</small></li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['activity'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 11
            echo "    ";
        } else {
            // line 12
            echo "    <li class=\"list-group-item text-center\">";
            echo (isset($context["text_no_results"]) ? $context["text_no_results"] : null);
            echo "</li>
    ";
        }
        // line 14
        echo "  </ul>
</div>";
    }

    public function getTemplateName()
    {
        return "extension/dashboard/activity_info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 14,  52 => 12,  49 => 11,  41 => 9,  36 => 8,  31 => 7,  29 => 6,  23 => 3,  19 => 1,);
    }
}
/* <div class="panel panel-default">*/
/*   <div class="panel-heading">*/
/*     <h3 class="panel-title"><i class="fa fa-calendar"></i> {{ heading_title }}</h3>*/
/*   </div>*/
/*   <ul class="list-group">*/
/*     {% if activities %}*/
/*     {% for activity in activities %}*/
/*     <li class="list-group-item">{{ activity.comment }}<br />*/
/*       <small class="text-muted"><i class="fa fa-clock-o"></i> {{ activity.date_added }}</small></li>*/
/*     {% endfor %}*/
/*     {% else %}*/
/*     <li class="list-group-item text-center">{{ text_no_results }}</li>*/
/*     {% endif %}*/
/*   </ul>*/
/* </div>*/
