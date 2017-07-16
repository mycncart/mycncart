<?php

/* common/column_left.twig */
class __TwigTemplate_dd59fd1892f7d5aa65063fde2247bf88b9135754eb3a2c333f1b891a03123c93 extends Twig_Template
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
        echo "<nav id=\"column-left\">
  <div id=\"navigation\"><span class=\"fa fa-bars\"></span> ";
        // line 2
        echo (isset($context["text_navigation"]) ? $context["text_navigation"] : null);
        echo "</div>
  <ul id=\"menu\">
    ";
        // line 4
        $context["i"] = 0;
        // line 5
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["menus"]) ? $context["menus"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
            // line 6
            echo "    <li id=\"";
            echo $this->getAttribute($context["menu"], "id", array());
            echo "\">";
            if ($this->getAttribute($context["menu"], "href", array())) {
                echo "<a href=\"";
                echo $this->getAttribute($context["menu"], "href", array());
                echo "\"><i class=\"fa ";
                echo $this->getAttribute($context["menu"], "icon", array());
                echo " fw\"></i> ";
                echo $this->getAttribute($context["menu"], "name", array());
                echo "</a>";
            } else {
                echo "<a href=\"#collapse";
                echo (isset($context["i"]) ? $context["i"] : null);
                echo "\" data-toggle=\"collapse\" class=\"parent collapsed\"><i class=\"fa ";
                echo $this->getAttribute($context["menu"], "icon", array());
                echo " fw\"></i> ";
                echo $this->getAttribute($context["menu"], "name", array());
                echo "</a>";
            }
            // line 7
            echo "      ";
            if ($this->getAttribute($context["menu"], "children", array())) {
                // line 8
                echo "      <ul id=\"collapse";
                echo (isset($context["i"]) ? $context["i"] : null);
                echo "\" class=\"collapse\">
        ";
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["menu"], "children", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["children_1"]) {
                    // line 10
                    echo "        <li>";
                    if ($this->getAttribute($context["children_1"], "href", array())) {
                        echo "<a href=\"";
                        echo $this->getAttribute($context["children_1"], "href", array());
                        echo "\">";
                        echo $this->getAttribute($context["children_1"], "name", array());
                        echo "</a>";
                    } else {
                        echo "<a href=\"#collapse";
                        echo (isset($context["i"]) ? $context["i"] : null);
                        echo "\" data-toggle=\"collapse\" class=\"parent collapsed\">";
                        echo $this->getAttribute($context["children_1"], "name", array());
                        echo "</a>";
                    }
                    // line 11
                    echo "          ";
                    if ($this->getAttribute($context["children_1"], "children", array())) {
                        // line 12
                        echo "          <ul id=\"collapse";
                        echo (isset($context["i"]) ? $context["i"] : null);
                        echo "\" class=\"collapse\">
            ";
                        // line 13
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["children_1"], "children", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["children_2"]) {
                            // line 14
                            echo "            <li>";
                            if ($this->getAttribute($context["children_2"], "href", array())) {
                                echo "<a href=\"";
                                echo $this->getAttribute($context["children_2"], "href", array());
                                echo "\">";
                                echo $this->getAttribute($context["children_2"], "name", array());
                                echo "</a>";
                            } else {
                                echo "<a href=\"#collapse";
                                echo (isset($context["i"]) ? $context["i"] : null);
                                echo "\" data-toggle=\"collapse\" class=\"parent collapsed\">";
                                echo $this->getAttribute($context["children_2"], "name", array());
                                echo "</a>";
                            }
                            // line 15
                            echo "              ";
                            if ($this->getAttribute($context["children_2"], "children", array())) {
                                // line 16
                                echo "              <ul id=\"collapse";
                                echo (isset($context["i"]) ? $context["i"] : null);
                                echo "\" class=\"collapse\">
                ";
                                // line 17
                                $context['_parent'] = $context;
                                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["children_2"], "children", array()));
                                foreach ($context['_seq'] as $context["_key"] => $context["children_3"]) {
                                    // line 18
                                    echo "                <li><a href=\"";
                                    echo $this->getAttribute($context["children_3"], "href", array());
                                    echo "\">";
                                    echo $this->getAttribute($context["children_3"], "name", array());
                                    echo "</a></li>
                ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['children_3'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 20
                                echo "              </ul>
              ";
                            }
                            // line 21
                            echo " </li>
            ";
                            // line 22
                            $context["i"] = ((isset($context["i"]) ? $context["i"] : null) + 1);
                            // line 23
                            echo "            
            ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['children_2'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 25
                        echo "          </ul>
          ";
                    }
                    // line 26
                    echo "</li>
        ";
                    // line 27
                    $context["i"] = ((isset($context["i"]) ? $context["i"] : null) + 1);
                    // line 28
                    echo "        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['children_1'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "      </ul>
      ";
            }
            // line 30
            echo "</li>
    ";
            // line 31
            $context["i"] = ((isset($context["i"]) ? $context["i"] : null) + 1);
            // line 32
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "  </ul>
  <div id=\"stats\">
    <ul>
      <li>
        <div>";
        // line 37
        echo (isset($context["text_complete_status"]) ? $context["text_complete_status"] : null);
        echo " <span class=\"pull-right\">";
        echo (isset($context["complete_status"]) ? $context["complete_status"] : null);
        echo "%</span></div>
        <div class=\"progress\">
          <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"";
        // line 39
        echo (isset($context["complete_status"]) ? $context["complete_status"] : null);
        echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ";
        echo (isset($context["complete_status"]) ? $context["complete_status"] : null);
        echo "%\"> <span class=\"sr-only\">";
        echo (isset($context["complete_status"]) ? $context["complete_status"] : null);
        echo "%</span></div>
        </div>
      </li>
      <li>
        <div>";
        // line 43
        echo (isset($context["text_processing_status"]) ? $context["text_processing_status"] : null);
        echo " <span class=\"pull-right\">";
        echo (isset($context["processing_status"]) ? $context["processing_status"] : null);
        echo "%</span></div>
        <div class=\"progress\">
          <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"";
        // line 45
        echo (isset($context["processing_status"]) ? $context["processing_status"] : null);
        echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ";
        echo (isset($context["processing_status"]) ? $context["processing_status"] : null);
        echo "%\"> <span class=\"sr-only\">";
        echo (isset($context["processing_status"]) ? $context["processing_status"] : null);
        echo "%</span></div>
        </div>
      </li>
      <li>
        <div>";
        // line 49
        echo (isset($context["text_other_status"]) ? $context["text_other_status"] : null);
        echo " <span class=\"pull-right\">";
        echo (isset($context["other_status"]) ? $context["other_status"] : null);
        echo "%</span></div>
        <div class=\"progress\">
          <div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"";
        // line 51
        echo (isset($context["other_status"]) ? $context["other_status"] : null);
        echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ";
        echo (isset($context["other_status"]) ? $context["other_status"] : null);
        echo "%\"> <span class=\"sr-only\">";
        echo (isset($context["other_status"]) ? $context["other_status"] : null);
        echo "%</span></div>
        </div>
      </li>
    </ul>
  </div>
</nav>
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
        return array (  227 => 51,  220 => 49,  209 => 45,  202 => 43,  191 => 39,  184 => 37,  178 => 33,  172 => 32,  170 => 31,  167 => 30,  163 => 29,  157 => 28,  155 => 27,  152 => 26,  148 => 25,  141 => 23,  139 => 22,  136 => 21,  132 => 20,  121 => 18,  117 => 17,  112 => 16,  109 => 15,  94 => 14,  90 => 13,  85 => 12,  82 => 11,  67 => 10,  63 => 9,  58 => 8,  55 => 7,  34 => 6,  29 => 5,  27 => 4,  22 => 2,  19 => 1,);
    }
}
/* <nav id="column-left">*/
/*   <div id="navigation"><span class="fa fa-bars"></span> {{ text_navigation }}</div>*/
/*   <ul id="menu">*/
/*     {% set i = 0 %}*/
/*     {% for menu in menus %}*/
/*     <li id="{{ menu.id }}">{% if menu.href %}<a href="{{ menu.href }}"><i class="fa {{ menu.icon }} fw"></i> {{ menu.name }}</a>{% else %}<a href="#collapse{{ i }}" data-toggle="collapse" class="parent collapsed"><i class="fa {{ menu.icon }} fw"></i> {{ menu.name }}</a>{% endif %}*/
/*       {% if menu.children %}*/
/*       <ul id="collapse{{ i }}" class="collapse">*/
/*         {% for children_1 in menu.children %}*/
/*         <li>{% if children_1.href %}<a href="{{ children_1.href }}">{{ children_1.name }}</a>{% else %}<a href="#collapse{{ i }}" data-toggle="collapse" class="parent collapsed">{{ children_1.name }}</a>{% endif %}*/
/*           {% if children_1.children %}*/
/*           <ul id="collapse{{ i }}" class="collapse">*/
/*             {% for children_2 in children_1.children %}*/
/*             <li>{% if children_2.href %}<a href="{{ children_2.href }}">{{ children_2.name }}</a>{% else %}<a href="#collapse{{ i }}" data-toggle="collapse" class="parent collapsed">{{ children_2.name }}</a>{% endif %}*/
/*               {% if children_2.children %}*/
/*               <ul id="collapse{{ i }}" class="collapse">*/
/*                 {% for children_3 in children_2.children %}*/
/*                 <li><a href="{{ children_3.href }}">{{ children_3.name }}</a></li>*/
/*                 {% endfor %}*/
/*               </ul>*/
/*               {% endif %} </li>*/
/*             {% set i = i + 1 %}*/
/*             */
/*             {% endfor %}*/
/*           </ul>*/
/*           {% endif %}</li>*/
/*         {% set i = i + 1 %}*/
/*         {% endfor %}*/
/*       </ul>*/
/*       {% endif %}</li>*/
/*     {% set i = i + 1 %}*/
/*     {% endfor %}*/
/*   </ul>*/
/*   <div id="stats">*/
/*     <ul>*/
/*       <li>*/
/*         <div>{{ text_complete_status }} <span class="pull-right">{{ complete_status }}%</span></div>*/
/*         <div class="progress">*/
/*           <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ complete_status }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ complete_status }}%"> <span class="sr-only">{{ complete_status }}%</span></div>*/
/*         </div>*/
/*       </li>*/
/*       <li>*/
/*         <div>{{ text_processing_status }} <span class="pull-right">{{ processing_status }}%</span></div>*/
/*         <div class="progress">*/
/*           <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ processing_status }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ processing_status }}%"> <span class="sr-only">{{ processing_status }}%</span></div>*/
/*         </div>*/
/*       </li>*/
/*       <li>*/
/*         <div>{{ text_other_status }} <span class="pull-right">{{ other_status }}%</span></div>*/
/*         <div class="progress">*/
/*           <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ other_status }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ other_status }}%"> <span class="sr-only">{{ other_status }}%</span></div>*/
/*         </div>*/
/*       </li>*/
/*     </ul>*/
/*   </div>*/
/* </nav>*/
/* */
