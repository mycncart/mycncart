<?php

/* install/step_4.twig */
class __TwigTemplate_eddea6717f7b97c7cdfae30cfb696e2ab0cb161cfa841f91ad81bd771236937d extends Twig_Template
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
        <h1 class=\"pull-left\">4<small>/4</small></h1>
        <h3>";
        // line 7
        echo ($context["heading_title"] ?? null);
        echo "<br>
          <small>";
        // line 8
        echo ($context["text_step_4"] ?? null);
        echo "</small></h3>
      </div>
      <div class=\"col-sm-6\">
        <div id=\"logo\" class=\"pull-right hidden-xs\"><img src=\"view/image/logo.png\" alt=\"OpenCart\" title=\"OpenCart\" /></div>
      </div>
    </div>
  </header>
  ";
        // line 15
        if (($context["success"] ?? null)) {
            // line 16
            echo "  <div class=\"alert alert-success alert-dismissible\">";
            echo ($context["success"] ?? null);
            echo "</div>
  ";
        }
        // line 18
        echo "  <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
        echo ($context["error_warning"] ?? null);
        echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  <div class=\"visit\">
    <div class=\"row\">
      <div class=\"col-sm-5 col-sm-offset-1 text-center\">
        <p><i class=\"fa fa-shopping-cart fa-5x\"></i></p>
        <a href=\"../\" class=\"btn btn-secondary\">";
        // line 25
        echo ($context["text_catalog"] ?? null);
        echo "</a></div>
      <div class=\"col-sm-5 text-center\">
        <p><i class=\"fa fa-cog fa-5x white\"></i></p>
        <a href=\"../admin/\" class=\"btn btn-secondary\">";
        // line 28
        echo ($context["text_admin"] ?? null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"modules\">
    <div class=\"row\">
      <div class=\"col-sm-12 text-center\"><a href=\"https://www.opencart.com/index.php?route=marketplace/extension&utm_source=opencart_install&utm_medium=store_link&utm_campaign=opencart_install\" target=\"_BLANK\" class=\"btn btn-default\">";
        // line 33
        echo ($context["text_extension"] ?? null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"mailing\">
    <div class=\"row\">
      <div class=\"col-sm-12\"><i class=\"fa fa-envelope-o fa-5x\"></i>
        <h3>";
        // line 39
        echo ($context["text_mail"] ?? null);
        echo "<br>
          <small>";
        // line 40
        echo ($context["text_mail_description"] ?? null);
        echo "</small></h3>
        <a href=\"http://newsletter.opencart.com/h/r/B660EBBE4980C85C\" target=\"_BLANK\" class=\"btn btn-secondary\">";
        // line 41
        echo ($context["button_mail"] ?? null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"core-modules\">
    <div class=\"row\">
      <div class=\"col-sm-6 text-center\"><img src=\"view/image/openbay_pro.gif\" />
        <p>";
        // line 47
        echo ($context["text_openbay"] ?? null);
        echo "</p>
        <a class=\"btn btn-primary\" href=\"";
        // line 48
        echo ($context["openbay"] ?? null);
        echo "\">";
        echo ($context["button_setup"] ?? null);
        echo "</a></div>
      <div class=\"col-sm-6 text-center\"><img src=\"view/image/maxmind.gif\" />
        <p>";
        // line 50
        echo ($context["text_maxmind"] ?? null);
        echo "</p>
        <a class=\"btn btn-primary\" href=\"";
        // line 51
        echo ($context["maxmind"] ?? null);
        echo "\">";
        echo ($context["button_setup"] ?? null);
        echo "</a></div>
    </div>
  </div>
  <div class=\"support text-center\">
    <div class=\"row\">
      <div class=\"col-sm-4\"><a href=\"https://www.facebook.com/pages/OpenCart/477182382328323\" class=\"icon transition\"><i class=\"fa fa-facebook fa-4x\"></i></a>
        <h3>";
        // line 57
        echo ($context["text_facebook"] ?? null);
        echo "</h3>
        <p>";
        // line 58
        echo ($context["text_facebook_description"] ?? null);
        echo "</p>
        <a href=\"https://www.facebook.com/pages/OpenCart/477182382328323\">";
        // line 59
        echo ($context["text_facebook_visit"] ?? null);
        echo "</a></div>
      <div class=\"col-sm-4\"><a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" class=\"icon transition\"><i class=\"fa fa-comments fa-4x\"></i></a>
        <h3>";
        // line 61
        echo ($context["text_forum"] ?? null);
        echo "</h3>
        <p>";
        // line 62
        echo ($context["text_forum_description"] ?? null);
        echo "</p>
        <a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\">";
        // line 63
        echo ($context["text_forum_visit"] ?? null);
        echo "</a></div>
      <div class=\"col-sm-4\"><a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" class=\"icon transition\"><i class=\"fa fa-user fa-4x\"></i></a>
        <h3>";
        // line 65
        echo ($context["text_commercial"] ?? null);
        echo "</h3>
        <p>";
        // line 66
        echo ($context["text_commercial_description"] ?? null);
        echo "</p>
        <a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_BLANK\">";
        // line 67
        echo ($context["text_commercial_visit"] ?? null);
        echo "</a></div>
    </div>
  </div>
</div>
";
        // line 71
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "install/step_4.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 71,  165 => 67,  161 => 66,  157 => 65,  152 => 63,  148 => 62,  144 => 61,  139 => 59,  135 => 58,  131 => 57,  120 => 51,  116 => 50,  109 => 48,  105 => 47,  96 => 41,  92 => 40,  88 => 39,  79 => 33,  71 => 28,  65 => 25,  54 => 18,  48 => 16,  46 => 15,  36 => 8,  32 => 7,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "install/step_4.twig", "/home/opencart/3000.mycncart.com/install/view/template/install/step_4.twig");
    }
}
