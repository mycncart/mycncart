<?php

/* install/step_2.twig */
class __TwigTemplate_36d81875193ba465262cdf3bf76addec5fc579ec6262e879228275f8dc5df132 extends Twig_Template
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
        <h1 class=\"pull-left\">2
          <small>/4</small>
        </h1>
        <h3>";
        // line 9
        echo ($context["heading_title"] ?? null);
        echo "
          <br>
          <small>";
        // line 11
        echo ($context["text_step_2"] ?? null);
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
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
        <p>";
        // line 27
        echo ($context["text_install_php"] ?? null);
        echo "</p>
        <fieldset>
          <table class=\"table\">
            <thead>
              <tr>
                <td width=\"35%\"><b>";
        // line 32
        echo ($context["text_setting"] ?? null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 33
        echo ($context["text_current"] ?? null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 34
        echo ($context["text_required"] ?? null);
        echo "</b></td>
                <td width=\"15%\" class=\"text-center\"><b>";
        // line 35
        echo ($context["text_status"] ?? null);
        echo "</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>";
        // line 40
        echo ($context["text_version"] ?? null);
        echo "</td>
                <td>";
        // line 41
        echo ($context["php_version"] ?? null);
        echo "</td>
                <td>5.6+</td>
                <td class=\"text-center\">
                  ";
        // line 44
        if (($context["version"] ?? null)) {
            // line 45
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 47
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 48
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 51
        echo ($context["text_global"] ?? null);
        echo "</td>
                <td>";
        // line 52
        if (($context["register_globals"] ?? null)) {
            // line 53
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 55
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 56
        echo "</td>
                <td>";
        // line 57
        echo ($context["text_off"] ?? null);
        echo "</td>
                <td class=\"text-center\">
                  ";
        // line 59
        if ( !($context["register_globals"] ?? null)) {
            // line 60
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 62
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 63
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 66
        echo ($context["text_magic"] ?? null);
        echo "</td>
                <td>";
        // line 67
        if (($context["magic_quotes_gpc"] ?? null)) {
            // line 68
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 70
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 71
        echo "</td>
                <td>";
        // line 72
        echo ($context["text_off"] ?? null);
        echo "</td>
                <td class=\"text-center\">
                  ";
        // line 74
        if ( !($context["error_magic_quotes_gpc"] ?? null)) {
            // line 75
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 77
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 78
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 81
        echo ($context["text_file_upload"] ?? null);
        echo "</td>
                <td>";
        // line 82
        if (($context["file_uploads"] ?? null)) {
            // line 83
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 85
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 86
        echo "</td>
                <td>";
        // line 87
        echo ($context["text_on"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 88
        if (($context["file_uploads"] ?? null)) {
            // line 89
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 91
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 92
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 95
        echo ($context["text_session"] ?? null);
        echo "</td>
                <td>";
        // line 96
        if (($context["session_auto_start"] ?? null)) {
            // line 97
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 99
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 100
        echo "</td>
                <td>";
        // line 101
        echo ($context["text_off"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 102
        if ( !($context["session_auto_start"] ?? null)) {
            // line 103
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 105
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 106
        echo "</td>
              </tr>
            </tbody>
          </table>
        </fieldset>
        <p>";
        // line 111
        echo ($context["text_install_extension"] ?? null);
        echo "</p>
        <fieldset>
          <table class=\"table\">
            <thead>
              <tr>
                <td width=\"35%\"><b>";
        // line 116
        echo ($context["text_extension"] ?? null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 117
        echo ($context["text_current"] ?? null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 118
        echo ($context["text_required"] ?? null);
        echo "</b></td>
                <td width=\"15%\" class=\"text-center\"><b>";
        // line 119
        echo ($context["text_status"] ?? null);
        echo "</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>";
        // line 124
        echo ($context["text_db"] ?? null);
        echo "</td>
                <td>";
        // line 125
        if (($context["db"] ?? null)) {
            // line 126
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 128
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 129
        echo "</td>
                <td>";
        // line 130
        echo ($context["text_on"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 131
        if (($context["db"] ?? null)) {
            // line 132
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 134
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 135
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 138
        echo ($context["text_gd"] ?? null);
        echo "</td>
                <td>";
        // line 139
        if (($context["gd"] ?? null)) {
            // line 140
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 142
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 143
        echo "</td>
                <td>";
        // line 144
        echo ($context["text_on"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 145
        if (($context["gd"] ?? null)) {
            // line 146
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 148
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 149
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 152
        echo ($context["text_curl"] ?? null);
        echo "</td>
                <td>";
        // line 153
        if (($context["curl"] ?? null)) {
            // line 154
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 156
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 157
        echo "</td>
                <td>";
        // line 158
        echo ($context["text_on"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 159
        if (($context["curl"] ?? null)) {
            // line 160
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 162
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 163
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 166
        echo ($context["text_openssl"] ?? null);
        echo "</td>
                <td>";
        // line 167
        if (($context["openssl"] ?? null)) {
            // line 168
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 170
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 171
        echo "</td>
                <td>";
        // line 172
        echo ($context["text_on"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 173
        if (($context["openssl"] ?? null)) {
            // line 174
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 176
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 177
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 180
        echo ($context["text_zlib"] ?? null);
        echo "</td>
                <td>";
        // line 181
        if (($context["zlib"] ?? null)) {
            // line 182
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 184
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 185
        echo "</td>
                <td>";
        // line 186
        echo ($context["text_on"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 187
        if (($context["zlib"] ?? null)) {
            // line 188
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 190
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 191
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 194
        echo ($context["text_zip"] ?? null);
        echo "</td>
                <td>";
        // line 195
        if (($context["zip"] ?? null)) {
            // line 196
            echo "                    ";
            echo ($context["text_on"] ?? null);
            echo "
                  ";
        } else {
            // line 198
            echo "                    ";
            echo ($context["text_off"] ?? null);
            echo "
                  ";
        }
        // line 199
        echo "</td>
                <td>";
        // line 200
        echo ($context["text_on"] ?? null);
        echo "</td>
                <td class=\"text-center\">";
        // line 201
        if (($context["zip"] ?? null)) {
            // line 202
            echo "                    <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 204
            echo "                    <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 205
        echo "</td>
              </tr>
              ";
        // line 207
        if ( !($context["iconv"] ?? null)) {
            // line 208
            echo "                <tr>
                  <td>";
            // line 209
            echo ($context["text_mbstring"] ?? null);
            echo "</td>
                  <td>";
            // line 210
            if (($context["mbstring"] ?? null)) {
                // line 211
                echo "                      ";
                echo ($context["text_on"] ?? null);
                echo "
                    ";
            } else {
                // line 213
                echo "                      ";
                echo ($context["text_off"] ?? null);
                echo "
                    ";
            }
            // line 214
            echo "</td>
                  <td>";
            // line 215
            echo ($context["text_on"] ?? null);
            echo "</td>
                  <td class=\"text-center\">";
            // line 216
            if (($context["mbstring"] ?? null)) {
                // line 217
                echo "                      <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                    ";
            } else {
                // line 219
                echo "                      <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                    ";
            }
            // line 220
            echo "</td>
                </tr>
              ";
        }
        // line 223
        echo "            </tbody>
          </table>
        </fieldset>
        <p>";
        // line 226
        echo ($context["text_install_file"] ?? null);
        echo "</p>
        <fieldset>
          <table class=\"table\">
            <thead>
              <tr>
                <td><b>";
        // line 231
        echo ($context["text_file"] ?? null);
        echo "</b></td>
                <td><b>";
        // line 232
        echo ($context["text_status"] ?? null);
        echo "</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>";
        // line 237
        echo ($context["catalog_config"] ?? null);
        echo "</td>
                <td>";
        // line 238
        if ( !($context["error_catalog_config"] ?? null)) {
            // line 239
            echo "                    <span class=\"text-success\">";
            echo ($context["text_writable"] ?? null);
            echo "</span>
                  ";
        } else {
            // line 241
            echo "                    <span class=\"text-danger\">";
            echo ($context["error_catalog_config"] ?? null);
            echo "</span>
                  ";
        }
        // line 242
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 245
        echo ($context["admin_config"] ?? null);
        echo "</td>
                <td>";
        // line 246
        if ( !($context["error_admin_config"] ?? null)) {
            // line 247
            echo "                    <span class=\"text-success\">";
            echo ($context["text_writable"] ?? null);
            echo "</span>
                  ";
        } else {
            // line 249
            echo "                    <span class=\"text-danger\">";
            echo ($context["error_admin_config"] ?? null);
            echo "</span>
                  ";
        }
        // line 250
        echo "</td>
              </tr>
            </tbody>
          </table>
        </fieldset>
        <div class=\"buttons\">
          <div class=\"pull-left\"><a href=\"";
        // line 256
        echo ($context["back"] ?? null);
        echo "\" class=\"btn btn-default\">";
        echo ($context["button_back"] ?? null);
        echo "</a></div>
          <div class=\"pull-right\">
            <input type=\"submit\" value=\"";
        // line 258
        echo ($context["button_continue"] ?? null);
        echo "\" class=\"btn btn-primary\"/>
          </div>
        </div>
      </form>
    </div>
    <div class=\"col-sm-3\">";
        // line 263
        echo ($context["column_left"] ?? null);
        echo "</div>
  </div>
</div>
";
        // line 266
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "install/step_2.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  692 => 266,  686 => 263,  678 => 258,  671 => 256,  663 => 250,  657 => 249,  651 => 247,  649 => 246,  645 => 245,  640 => 242,  634 => 241,  628 => 239,  626 => 238,  622 => 237,  614 => 232,  610 => 231,  602 => 226,  597 => 223,  592 => 220,  588 => 219,  584 => 217,  582 => 216,  578 => 215,  575 => 214,  569 => 213,  563 => 211,  561 => 210,  557 => 209,  554 => 208,  552 => 207,  548 => 205,  544 => 204,  540 => 202,  538 => 201,  534 => 200,  531 => 199,  525 => 198,  519 => 196,  517 => 195,  513 => 194,  508 => 191,  504 => 190,  500 => 188,  498 => 187,  494 => 186,  491 => 185,  485 => 184,  479 => 182,  477 => 181,  473 => 180,  468 => 177,  464 => 176,  460 => 174,  458 => 173,  454 => 172,  451 => 171,  445 => 170,  439 => 168,  437 => 167,  433 => 166,  428 => 163,  424 => 162,  420 => 160,  418 => 159,  414 => 158,  411 => 157,  405 => 156,  399 => 154,  397 => 153,  393 => 152,  388 => 149,  384 => 148,  380 => 146,  378 => 145,  374 => 144,  371 => 143,  365 => 142,  359 => 140,  357 => 139,  353 => 138,  348 => 135,  344 => 134,  340 => 132,  338 => 131,  334 => 130,  331 => 129,  325 => 128,  319 => 126,  317 => 125,  313 => 124,  305 => 119,  301 => 118,  297 => 117,  293 => 116,  285 => 111,  278 => 106,  274 => 105,  270 => 103,  268 => 102,  264 => 101,  261 => 100,  255 => 99,  249 => 97,  247 => 96,  243 => 95,  238 => 92,  234 => 91,  230 => 89,  228 => 88,  224 => 87,  221 => 86,  215 => 85,  209 => 83,  207 => 82,  203 => 81,  198 => 78,  194 => 77,  190 => 75,  188 => 74,  183 => 72,  180 => 71,  174 => 70,  168 => 68,  166 => 67,  162 => 66,  157 => 63,  153 => 62,  149 => 60,  147 => 59,  142 => 57,  139 => 56,  133 => 55,  127 => 53,  125 => 52,  121 => 51,  116 => 48,  112 => 47,  108 => 45,  106 => 44,  100 => 41,  96 => 40,  88 => 35,  84 => 34,  80 => 33,  76 => 32,  68 => 27,  64 => 26,  60 => 24,  52 => 20,  50 => 19,  39 => 11,  34 => 9,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "install/step_2.twig", "/home/opencart/3000.mycncart.com/install/view/template/install/step_2.twig");
    }
}
