<?php

/* install/step_3.twig */
class __TwigTemplate_de92b2758653b64e336f2fa4e19548ba71318da921e4fe6fdf1332817dcd4434 extends Twig_Template
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
        echo ($context["header"] ?? null);
        echo "
<div class=\"container\">
  <header>
    <div class=\"row\">
      <div class=\"col-sm-6\">
        <h1 class=\"pull-left\">3
          <small>/4</small>
        </h1>
        <h3>";
        // line 9
        echo ($context["heading_title"] ?? null);
        echo "
          <br>
          <small>";
        // line 11
        echo ($context["text_step_3"] ?? null);
        echo "</small>
        </h3>
      </div>
      <div class=\"col-sm-6\">
        <div id=\"logo\" class=\"pull-right hidden-xs\"><img src=\"view/image/logo.png\" alt=\"OpenCart\" title=\"OpenCart\"/></div>
      </div>
    </div>
  </header>
  ";
        // line 19
        if (($context["error_warning"] ?? null)) {
            // line 20
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
  ";
        }
        // line 24
        echo "  <div class=\"row\">
    <div class=\"col-sm-9\">
      <form action=\"";
        // line 26
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal\">
        <p>";
        // line 27
        echo ($context["text_db_connection"] ?? null);
        echo "</p>
        <fieldset>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-db-driver\">";
        // line 30
        echo ($context["entry_db_driver"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"db_driver\" id=\"input-db-driver\" class=\"form-control\">
                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["drivers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["driver"]) {
            // line 34
            echo "                  ";
            if ((($context["db_driver"] ?? null) == twig_get_attribute($this->env, $this->source, $context["driver"], "value", array()))) {
                // line 35
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["driver"], "value", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["driver"], "text", array());
                echo "</option>
                  ";
            } else {
                // line 37
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["driver"], "value", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["driver"], "text", array());
                echo "</option>
                  ";
            }
            // line 39
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['driver'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "              </select>
              ";
        // line 41
        if (($context["error_db_driver"] ?? null)) {
            // line 42
            echo "                <div class=\"text-danger\">";
            echo ($context["error_db_driver"] ?? null);
            echo "</div>
              ";
        }
        // line 44
        echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-db-hostname\">";
        // line 47
        echo ($context["entry_db_hostname"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"db_hostname\" value=\"";
        // line 49
        echo ($context["db_hostname"] ?? null);
        echo "\" id=\"input-db-hostname\" class=\"form-control\"/>
              ";
        // line 50
        if (($context["error_db_hostname"] ?? null)) {
            // line 51
            echo "                <div class=\"text-danger\">";
            echo ($context["error_db_hostname"] ?? null);
            echo "</div>
              ";
        }
        // line 53
        echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-db-username\">";
        // line 56
        echo ($context["entry_db_username"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"db_username\" value=\"";
        // line 58
        echo ($context["db_username"] ?? null);
        echo "\" id=\"input-db-username\" class=\"form-control\"/>
              ";
        // line 59
        if (($context["error_db_username"] ?? null)) {
            // line 60
            echo "                <div class=\"text-danger\">";
            echo ($context["error_db_username"] ?? null);
            echo "</div>
              ";
        }
        // line 62
        echo "            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-db-password\">";
        // line 65
        echo ($context["entry_db_password"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"password\" name=\"db_password\" value=\"";
        // line 67
        echo ($context["db_password"] ?? null);
        echo "\" id=\"input-db-password\" class=\"form-control\"/>
            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-db-database\">";
        // line 71
        echo ($context["entry_db_database"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"db_database\" value=\"";
        // line 73
        echo ($context["db_database"] ?? null);
        echo "\" id=\"input-db-database\" class=\"form-control\"/>
              ";
        // line 74
        if (($context["error_db_database"] ?? null)) {
            // line 75
            echo "                <div class=\"text-danger\">";
            echo ($context["error_db_database"] ?? null);
            echo "</div>
              ";
        }
        // line 77
        echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-db-port\">";
        // line 80
        echo ($context["entry_db_port"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"db_port\" value=\"";
        // line 82
        echo ($context["db_port"] ?? null);
        echo "\" id=\"input-db-port\" class=\"form-control\"/>
              ";
        // line 83
        if (($context["error_db_port"] ?? null)) {
            // line 84
            echo "                <div class=\"text-danger\">";
            echo ($context["error_db_port"] ?? null);
            echo "</div>
              ";
        }
        // line 86
        echo "            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-db-prefix\">";
        // line 89
        echo ($context["entry_db_prefix"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"db_prefix\" value=\"";
        // line 91
        echo ($context["db_prefix"] ?? null);
        echo "\" id=\"input-db-prefix\" class=\"form-control\"/>
              ";
        // line 92
        if (($context["error_db_prefix"] ?? null)) {
            // line 93
            echo "                <div class=\"text-danger\">";
            echo ($context["error_db_prefix"] ?? null);
            echo "</div>
              ";
        }
        // line 95
        echo "            </div>
          </div>
        </fieldset>
        <p>";
        // line 98
        echo ($context["text_db_administration"] ?? null);
        echo "</p>
        <fieldset>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-username\">";
        // line 101
        echo ($context["entry_username"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"username\" value=\"";
        // line 103
        echo ($context["username"] ?? null);
        echo "\" id=\"input-username\" class=\"form-control\"/>
              ";
        // line 104
        if (($context["error_username"] ?? null)) {
            // line 105
            echo "                <div class=\"text-danger\">";
            echo ($context["error_username"] ?? null);
            echo "</div>
              ";
        }
        // line 107
        echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-password\">";
        // line 110
        echo ($context["entry_password"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"password\" value=\"";
        // line 112
        echo ($context["password"] ?? null);
        echo "\" id=\"input-password\" class=\"form-control\"/>
              ";
        // line 113
        if (($context["error_password"] ?? null)) {
            // line 114
            echo "                <div class=\"text-danger\">";
            echo ($context["error_password"] ?? null);
            echo "</div>
              ";
        }
        // line 116
        echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-email\">";
        // line 119
        echo ($context["entry_email"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"email\" value=\"";
        // line 121
        echo ($context["email"] ?? null);
        echo "\" id=\"input-email\" class=\"form-control\"/>
              ";
        // line 122
        if (($context["error_email"] ?? null)) {
            // line 123
            echo "                <div class=\"text-danger\">";
            echo ($context["error_email"] ?? null);
            echo "</div>
              ";
        }
        // line 125
        echo "            </div>
          </div>
        </fieldset>
        <div class=\"buttons\">
          <div class=\"pull-left\"><a href=\"";
        // line 129
        echo ($context["back"] ?? null);
        echo "\" class=\"btn btn-default\">";
        echo ($context["button_back"] ?? null);
        echo "</a></div>
          <div class=\"pull-right\">
            <input type=\"submit\" value=\"";
        // line 131
        echo ($context["button_continue"] ?? null);
        echo "\" class=\"btn btn-primary\"/>
          </div>
        </div>
      </form>
    </div>
    <div class=\"col-sm-3\">";
        // line 136
        echo ($context["column_left"] ?? null);
        echo "</div>
  </div>
</div>
";
        // line 139
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "install/step_3.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  341 => 139,  335 => 136,  327 => 131,  320 => 129,  314 => 125,  308 => 123,  306 => 122,  302 => 121,  297 => 119,  292 => 116,  286 => 114,  284 => 113,  280 => 112,  275 => 110,  270 => 107,  264 => 105,  262 => 104,  258 => 103,  253 => 101,  247 => 98,  242 => 95,  236 => 93,  234 => 92,  230 => 91,  225 => 89,  220 => 86,  214 => 84,  212 => 83,  208 => 82,  203 => 80,  198 => 77,  192 => 75,  190 => 74,  186 => 73,  181 => 71,  174 => 67,  169 => 65,  164 => 62,  158 => 60,  156 => 59,  152 => 58,  147 => 56,  142 => 53,  136 => 51,  134 => 50,  130 => 49,  125 => 47,  120 => 44,  114 => 42,  112 => 41,  109 => 40,  103 => 39,  95 => 37,  87 => 35,  84 => 34,  80 => 33,  74 => 30,  68 => 27,  64 => 26,  60 => 24,  52 => 20,  50 => 19,  39 => 11,  34 => 9,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "install/step_3.twig", "/home/opencart/3000.mycncart.com/install/view/template/install/step_3.twig");
    }
}
