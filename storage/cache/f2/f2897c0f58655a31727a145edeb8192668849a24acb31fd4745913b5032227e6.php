<?php

/* common/column_left.twig */
class __TwigTemplate_0591434578297aa9924b6a00deafbbba5c812a6d31837fc51c4a30ec3f9abd80 extends Twig_Template
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
        echo "<ul class=\"list-group\">
  ";
        // line 2
        if ((twig_slice($this->env, ($context["route"] ?? null), 0, 8) != "upgrade/")) {
            // line 3
            echo "  ";
            if ((($context["route"] ?? null) == "install/step_1")) {
                // line 4
                echo "  <li class=\"list-group-item\"><b>";
                echo ($context["text_license"] ?? null);
                echo "</b></li>
  ";
            } else {
                // line 6
                echo "  <li class=\"list-group-item\">";
                echo ($context["text_license"] ?? null);
                echo "</li>
  ";
            }
            // line 8
            echo "  ";
            if ((($context["route"] ?? null) == "install/step_2")) {
                // line 9
                echo "  <li class=\"list-group-item\"><b>";
                echo ($context["text_installation"] ?? null);
                echo "</b></li>
  ";
            } else {
                // line 11
                echo "  <li class=\"list-group-item\">";
                echo ($context["text_installation"] ?? null);
                echo "</li>
  ";
            }
            // line 13
            echo "  ";
            if ((($context["route"] ?? null) == "install/step_3")) {
                // line 14
                echo "  <li class=\"list-group-item\"><b>";
                echo ($context["text_configuration"] ?? null);
                echo "</b></li>
  ";
            } else {
                // line 16
                echo "  <li class=\"list-group-item\">";
                echo ($context["text_configuration"] ?? null);
                echo "</li>
  ";
            }
            // line 18
            echo "  ";
        } else {
            // line 19
            echo "  ";
            if ((($context["route"] ?? null) == "upgrade/upgrade")) {
                // line 20
                echo "  <li class=\"list-group-item\"><b>";
                echo ($context["text_upgrade"] ?? null);
                echo "</b></li>
  ";
            } else {
                // line 22
                echo "  <li class=\"list-group-item\">";
                echo ($context["text_upgrade"] ?? null);
                echo "</li>
  ";
            }
            // line 24
            echo "  ";
            if ((($context["route"] ?? null) == "upgrade/upgrade/success")) {
                // line 25
                echo "  <li class=\"list-group-item\"><b>";
                echo ($context["text_finished"] ?? null);
                echo "</b></li>
  ";
            } else {
                // line 27
                echo "  <li class=\"list-group-item\">";
                echo ($context["text_finished"] ?? null);
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
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"language\">
  <ul class=\"list-group\">
    <li class=\"list-group-item\">
      <div class=\"dropdown\">
        <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">";
        // line 35
        echo ($context["text_language"] ?? null);
        echo " <span class=\"caret\"></span></button>
        <ul class=\"dropdown-menu\">
          ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 38
            echo "          <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "value", array());
            echo "\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "value", array());
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "value", array());
            echo ".png\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "text", array());
            echo "</a></li>
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
        echo ($context["redirect"] ?? null);
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
        return array (  150 => 45,  143 => 40,  128 => 38,  124 => 37,  119 => 35,  112 => 31,  109 => 30,  106 => 29,  100 => 27,  94 => 25,  91 => 24,  85 => 22,  79 => 20,  76 => 19,  73 => 18,  67 => 16,  61 => 14,  58 => 13,  52 => 11,  46 => 9,  43 => 8,  37 => 6,  31 => 4,  28 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "common/column_left.twig", "/home/opencart/3000.mycncart.com/install/view/template/common/column_left.twig");
    }
}
