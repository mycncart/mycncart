<?php

/* common/login.twig */
class __TwigTemplate_77f6f36b35a7b9592361e0be78c29b0f06eb1207aef30925d481e32b1dfe7f5f extends Twig_Template
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
        echo (isset($context["header"]) ? $context["header"] : null);
        echo "
<div id=\"content\">
  <div class=\"container-fluid\"><br />
    <br />
    <div class=\"row\">
      <div class=\"col-sm-offset-4 col-sm-4\">
        <div class=\"panel panel-default\">
          <div class=\"panel-heading\">
            <h1 class=\"panel-title\"><i class=\"fa fa-lock\"></i> ";
        // line 9
        echo (isset($context["text_login"]) ? $context["text_login"] : null);
        echo "</h1>
          </div>
          <div class=\"panel-body\">
            ";
        // line 12
        if ((isset($context["success"]) ? $context["success"] : null)) {
            // line 13
            echo "            <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo (isset($context["success"]) ? $context["success"] : null);
            echo "
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            </div>
            ";
        }
        // line 17
        echo "            ";
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 18
            echo "            <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            </div>
            ";
        }
        // line 22
        echo "            <form action=\"";
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
              <div class=\"form-group\">
                <label for=\"input-username\">";
        // line 24
        echo (isset($context["entry_username"]) ? $context["entry_username"] : null);
        echo "</label>
                <div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-user\"></i></span>
                  <input type=\"text\" name=\"username\" value=\"";
        // line 26
        echo (isset($context["username"]) ? $context["username"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_username"]) ? $context["entry_username"] : null);
        echo "\" id=\"input-username\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"input-password\">";
        // line 30
        echo (isset($context["entry_password"]) ? $context["entry_password"] : null);
        echo "</label>
                <div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-lock\"></i></span>
                  <input type=\"password\" name=\"password\" value=\"";
        // line 32
        echo (isset($context["password"]) ? $context["password"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_password"]) ? $context["entry_password"] : null);
        echo "\" id=\"input-password\" class=\"form-control\" />
                </div>
                ";
        // line 34
        if ((isset($context["forgotten"]) ? $context["forgotten"] : null)) {
            // line 35
            echo "                <span class=\"help-block\"><a href=\"";
            echo (isset($context["forgotten"]) ? $context["forgotten"] : null);
            echo "\">";
            echo (isset($context["text_forgotten"]) ? $context["text_forgotten"] : null);
            echo "</a></span>
                ";
        }
        // line 37
        echo "              </div>
              <div class=\"text-right\">
                <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fa fa-key\"></i> ";
        // line 39
        echo (isset($context["button_login"]) ? $context["button_login"] : null);
        echo "</button>
              </div>
              ";
        // line 41
        if ((isset($context["redirect"]) ? $context["redirect"] : null)) {
            // line 42
            echo "              <input type=\"hidden\" name=\"redirect\" value=\"";
            echo (isset($context["redirect"]) ? $context["redirect"] : null);
            echo "\" />
              ";
        }
        // line 44
        echo "            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
";
        // line 51
        echo (isset($context["footer"]) ? $context["footer"] : null);
    }

    public function getTemplateName()
    {
        return "common/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 51,  116 => 44,  110 => 42,  108 => 41,  103 => 39,  99 => 37,  91 => 35,  89 => 34,  82 => 32,  77 => 30,  68 => 26,  63 => 24,  57 => 22,  49 => 18,  46 => 17,  38 => 13,  36 => 12,  30 => 9,  19 => 1,);
    }
}
/* {{ header }}*/
/* <div id="content">*/
/*   <div class="container-fluid"><br />*/
/*     <br />*/
/*     <div class="row">*/
/*       <div class="col-sm-offset-4 col-sm-4">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-heading">*/
/*             <h1 class="panel-title"><i class="fa fa-lock"></i> {{ text_login }}</h1>*/
/*           </div>*/
/*           <div class="panel-body">*/
/*             {% if success %}*/
/*             <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> {{ success }}*/
/*               <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*             </div>*/
/*             {% endif %}*/
/*             {% if error_warning %}*/
/*             <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*               <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*             </div>*/
/*             {% endif %}*/
/*             <form action="{{ action }}" method="post" enctype="multipart/form-data">*/
/*               <div class="form-group">*/
/*                 <label for="input-username">{{ entry_username }}</label>*/
/*                 <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>*/
/*                   <input type="text" name="username" value="{{ username }}" placeholder="{{ entry_username }}" id="input-username" class="form-control" />*/
/*                 </div>*/
/*               </div>*/
/*               <div class="form-group">*/
/*                 <label for="input-password">{{ entry_password }}</label>*/
/*                 <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>*/
/*                   <input type="password" name="password" value="{{ password }}" placeholder="{{ entry_password }}" id="input-password" class="form-control" />*/
/*                 </div>*/
/*                 {% if forgotten %}*/
/*                 <span class="help-block"><a href="{{ forgotten }}">{{ text_forgotten }}</a></span>*/
/*                 {% endif %}*/
/*               </div>*/
/*               <div class="text-right">*/
/*                 <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> {{ button_login }}</button>*/
/*               </div>*/
/*               {% if redirect %}*/
/*               <input type="hidden" name="redirect" value="{{ redirect }}" />*/
/*               {% endif %}*/
/*             </form>*/
/*           </div>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* {{ footer }}*/
