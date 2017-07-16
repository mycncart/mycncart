<?php

/* install/step_2.twig */
class __TwigTemplate_4e17aad322125e99bc7ace7cc573e93f722026e32d22e6ea873da97390b23d16 extends Twig_Template
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
<div class=\"container\">
  <header>
    <div class=\"row\">
      <div class=\"col-sm-6\">
        <h1 class=\"pull-left\">2<small>/4</small></h1>
        <h3>";
        // line 7
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "<br>
          <small>";
        // line 8
        echo (isset($context["text_step_2"]) ? $context["text_step_2"] : null);
        echo "</small></h3>
      </div>
      <div class=\"col-sm-6\">
        <div id=\"logo\" class=\"pull-right hidden-xs\"><img src=\"view/image/logo.png\" alt=\"OpenCart\" title=\"OpenCart\" /></div>
      </div>
    </div>
  </header>
  ";
        // line 15
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 16
            echo "  <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 20
        echo "  <div class=\"row\">
    <div class=\"col-sm-9\">
      <form action=\"";
        // line 22
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
        <p>";
        // line 23
        echo (isset($context["text_install_php"]) ? $context["text_install_php"] : null);
        echo "</p>
        <fieldset>
          <table class=\"table\">
            <thead>
              <tr>
                <td width=\"35%\"><b>";
        // line 28
        echo (isset($context["text_setting"]) ? $context["text_setting"] : null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 29
        echo (isset($context["text_current"]) ? $context["text_current"] : null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 30
        echo (isset($context["text_required"]) ? $context["text_required"] : null);
        echo "</b></td>
                <td width=\"15%\" class=\"text-center\"><b>";
        // line 31
        echo (isset($context["text_status"]) ? $context["text_status"] : null);
        echo "</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>";
        // line 36
        echo (isset($context["text_version"]) ? $context["text_version"] : null);
        echo "</td>
                <td>";
        // line 37
        echo (isset($context["php_version"]) ? $context["php_version"] : null);
        echo "</td>
                <td>5.4+</td>
                <td class=\"text-center\">";
        // line 39
        if (((isset($context["php_version"]) ? $context["php_version"] : null) >= "5.4")) {
            // line 40
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 42
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 43
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 46
        echo (isset($context["text_global"]) ? $context["text_global"] : null);
        echo "</td>
                <td>";
        // line 47
        if ((isset($context["register_globals"]) ? $context["register_globals"] : null)) {
            // line 48
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 50
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 51
        echo "</td>
                <td>";
        // line 52
        echo (isset($context["text_off"]) ? $context["text_off"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 53
        if ( !(isset($context["register_globals"]) ? $context["register_globals"] : null)) {
            // line 54
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 56
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 57
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 60
        echo (isset($context["text_magic"]) ? $context["text_magic"] : null);
        echo "</td>
                <td>";
        // line 61
        if ((isset($context["magic_quotes_gpc"]) ? $context["magic_quotes_gpc"] : null)) {
            // line 62
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 64
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 65
        echo "</td>
                <td>";
        // line 66
        echo (isset($context["text_off"]) ? $context["text_off"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 67
        if ( !(isset($context["error_magic_quotes_gpc"]) ? $context["error_magic_quotes_gpc"] : null)) {
            // line 68
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 70
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 71
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 74
        echo (isset($context["text_file_upload"]) ? $context["text_file_upload"] : null);
        echo "</td>
                <td>";
        // line 75
        if ((isset($context["file_uploads"]) ? $context["file_uploads"] : null)) {
            // line 76
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 78
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 79
        echo "</td>
                <td>";
        // line 80
        echo (isset($context["text_on"]) ? $context["text_on"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 81
        if ((isset($context["file_uploads"]) ? $context["file_uploads"] : null)) {
            // line 82
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 84
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 85
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 88
        echo (isset($context["text_session"]) ? $context["text_session"] : null);
        echo "</td>
                <td>";
        // line 89
        if ((isset($context["session_auto_start"]) ? $context["session_auto_start"] : null)) {
            // line 90
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 92
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 93
        echo "</td>
                <td>";
        // line 94
        echo (isset($context["text_off"]) ? $context["text_off"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 95
        if ( !(isset($context["session_auto_start"]) ? $context["session_auto_start"] : null)) {
            // line 96
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 98
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 99
        echo "</td>
              </tr>
            </tbody>
          </table>
        </fieldset>
        <p>";
        // line 104
        echo (isset($context["text_install_extension"]) ? $context["text_install_extension"] : null);
        echo "</p>
        <fieldset>
          <table class=\"table\">
            <thead>
              <tr>
                <td width=\"35%\"><b>";
        // line 109
        echo (isset($context["text_extension"]) ? $context["text_extension"] : null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 110
        echo (isset($context["text_current"]) ? $context["text_current"] : null);
        echo "</b></td>
                <td width=\"25%\"><b>";
        // line 111
        echo (isset($context["text_required"]) ? $context["text_required"] : null);
        echo "</b></td>
                <td width=\"15%\" class=\"text-center\"><b>";
        // line 112
        echo (isset($context["text_status"]) ? $context["text_status"] : null);
        echo "</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>";
        // line 117
        echo (isset($context["text_db"]) ? $context["text_db"] : null);
        echo "</td>
                <td>";
        // line 118
        if ((isset($context["db"]) ? $context["db"] : null)) {
            // line 119
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 121
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 122
        echo "</td>
                <td>";
        // line 123
        echo (isset($context["text_on"]) ? $context["text_on"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 124
        if ((isset($context["db"]) ? $context["db"] : null)) {
            // line 125
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 127
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 128
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 131
        echo (isset($context["text_gd"]) ? $context["text_gd"] : null);
        echo "</td>
                <td>";
        // line 132
        if ((isset($context["gd"]) ? $context["gd"] : null)) {
            // line 133
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 135
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 136
        echo "</td>
                <td>";
        // line 137
        echo (isset($context["text_on"]) ? $context["text_on"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 138
        if ((isset($context["gd"]) ? $context["gd"] : null)) {
            // line 139
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 141
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 142
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 145
        echo (isset($context["text_curl"]) ? $context["text_curl"] : null);
        echo "</td>
                <td>";
        // line 146
        if ((isset($context["curl"]) ? $context["curl"] : null)) {
            // line 147
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 149
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 150
        echo "</td>
                <td>";
        // line 151
        echo (isset($context["text_on"]) ? $context["text_on"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 152
        if ((isset($context["curl"]) ? $context["curl"] : null)) {
            // line 153
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 155
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 156
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 159
        echo (isset($context["text_openssl"]) ? $context["text_openssl"] : null);
        echo "</td>
                <td>";
        // line 160
        if ((isset($context["openssl"]) ? $context["openssl"] : null)) {
            // line 161
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 163
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 164
        echo "</td>
                <td>";
        // line 165
        echo (isset($context["text_on"]) ? $context["text_on"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 166
        if ((isset($context["openssl"]) ? $context["openssl"] : null)) {
            // line 167
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 169
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 170
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 173
        echo (isset($context["text_zlib"]) ? $context["text_zlib"] : null);
        echo "</td>
                <td>";
        // line 174
        if ((isset($context["zlib"]) ? $context["zlib"] : null)) {
            // line 175
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 177
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 178
        echo "</td>
                <td>";
        // line 179
        echo (isset($context["text_on"]) ? $context["text_on"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 180
        if ((isset($context["zlib"]) ? $context["zlib"] : null)) {
            // line 181
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 183
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 184
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 187
        echo (isset($context["text_zip"]) ? $context["text_zip"] : null);
        echo "</td>
                <td>";
        // line 188
        if ((isset($context["zip"]) ? $context["zip"] : null)) {
            // line 189
            echo "                  ";
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "
                  ";
        } else {
            // line 191
            echo "                  ";
            echo (isset($context["text_off"]) ? $context["text_off"] : null);
            echo "
                  ";
        }
        // line 192
        echo "</td>
                <td>";
        // line 193
        echo (isset($context["text_on"]) ? $context["text_on"] : null);
        echo "</td>
                <td class=\"text-center\">";
        // line 194
        if ((isset($context["zip"]) ? $context["zip"] : null)) {
            // line 195
            echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
        } else {
            // line 197
            echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
        }
        // line 198
        echo "</td>
              </tr>
              ";
        // line 200
        if ( !(isset($context["iconv"]) ? $context["iconv"] : null)) {
            // line 201
            echo "              <tr>
                <td>";
            // line 202
            echo (isset($context["text_mbstring"]) ? $context["text_mbstring"] : null);
            echo "</td>
                <td>";
            // line 203
            if ((isset($context["mbstring"]) ? $context["mbstring"] : null)) {
                // line 204
                echo "                  ";
                echo (isset($context["text_on"]) ? $context["text_on"] : null);
                echo "
                  ";
            } else {
                // line 206
                echo "                  ";
                echo (isset($context["text_off"]) ? $context["text_off"] : null);
                echo "
                  ";
            }
            // line 207
            echo "</td>
                <td>";
            // line 208
            echo (isset($context["text_on"]) ? $context["text_on"] : null);
            echo "</td>
                <td class=\"text-center\">";
            // line 209
            if ((isset($context["mbstring"]) ? $context["mbstring"] : null)) {
                // line 210
                echo "                  <span class=\"text-success\"><i class=\"fa fa-check-circle\"></i></span>
                  ";
            } else {
                // line 212
                echo "                  <span class=\"text-danger\"><i class=\"fa fa-minus-circle\"></i></span>
                  ";
            }
            // line 213
            echo "</td>
              </tr>
              ";
        }
        // line 216
        echo "            </tbody>
          </table>
        </fieldset>
        <p>";
        // line 219
        echo (isset($context["text_install_file"]) ? $context["text_install_file"] : null);
        echo "</p>
        <fieldset>
          <table class=\"table\">
            <thead>
              <tr>
                <td><b>";
        // line 224
        echo (isset($context["text_file"]) ? $context["text_file"] : null);
        echo "</b></td>
                <td><b>";
        // line 225
        echo (isset($context["text_status"]) ? $context["text_status"] : null);
        echo "</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>";
        // line 230
        echo (isset($context["catalog_config"]) ? $context["catalog_config"] : null);
        echo "</td>
                <td>";
        // line 231
        if ( !(isset($context["error_catalog_config"]) ? $context["error_catalog_config"] : null)) {
            // line 232
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 234
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_catalog_config"]) ? $context["error_catalog_config"] : null);
            echo "</span>
                  ";
        }
        // line 235
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 238
        echo (isset($context["admin_config"]) ? $context["admin_config"] : null);
        echo "</td>
                <td>";
        // line 239
        if ( !(isset($context["error_admin_config"]) ? $context["error_admin_config"] : null)) {
            // line 240
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 242
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_admin_config"]) ? $context["error_admin_config"] : null);
            echo "</span>
                  ";
        }
        // line 243
        echo "</td>
              </tr>
            </tbody>
          </table>
        </fieldset>
        <p>";
        // line 248
        echo (isset($context["text_install_directory"]) ? $context["text_install_directory"] : null);
        echo "</p>
        <fieldset>
          <table class=\"table\">
            <thead>
              <tr>
                <td align=\"left\"><b>";
        // line 253
        echo (isset($context["text_directory"]) ? $context["text_directory"] : null);
        echo "</b></td>
                <td align=\"left\"><b>";
        // line 254
        echo (isset($context["text_status"]) ? $context["text_status"] : null);
        echo "</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>";
        // line 259
        echo (isset($context["image"]) ? $context["image"] : null);
        echo "/</td>
                <td>";
        // line 260
        if ( !(isset($context["error_image"]) ? $context["error_image"] : null)) {
            // line 261
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 263
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_image"]) ? $context["error_image"] : null);
            echo "</span>
                  ";
        }
        // line 264
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 267
        echo (isset($context["image_cache"]) ? $context["image_cache"] : null);
        echo "/</td>
                <td>";
        // line 268
        if ( !(isset($context["error_image_cache"]) ? $context["error_image_cache"] : null)) {
            // line 269
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 271
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_image_cache"]) ? $context["error_image_cache"] : null);
            echo "</span>
                  ";
        }
        // line 272
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 275
        echo (isset($context["image_catalog"]) ? $context["image_catalog"] : null);
        echo "/</td>
                <td>";
        // line 276
        if ( !(isset($context["error_image_catalog"]) ? $context["error_image_catalog"] : null)) {
            // line 277
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 279
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_image_catalog"]) ? $context["error_image_catalog"] : null);
            echo "</span>
                  ";
        }
        // line 280
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 283
        echo (isset($context["cache"]) ? $context["cache"] : null);
        echo "/</td>
                <td>";
        // line 284
        if ( !(isset($context["error_cache"]) ? $context["error_cache"] : null)) {
            // line 285
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 287
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_cache"]) ? $context["error_cache"] : null);
            echo "</span>
                  ";
        }
        // line 288
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 291
        echo (isset($context["logs"]) ? $context["logs"] : null);
        echo "/</td>
                <td>";
        // line 292
        if ( !(isset($context["error_logs"]) ? $context["error_logs"] : null)) {
            // line 293
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 295
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_logs"]) ? $context["error_logs"] : null);
            echo "</span>
                  ";
        }
        // line 296
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 299
        echo (isset($context["download"]) ? $context["download"] : null);
        echo "/</td>
                <td>";
        // line 300
        if ( !(isset($context["error_download"]) ? $context["error_download"] : null)) {
            // line 301
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 303
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_download"]) ? $context["error_download"] : null);
            echo "</span>
                  ";
        }
        // line 304
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 307
        echo (isset($context["upload"]) ? $context["upload"] : null);
        echo "/</td>
                <td>";
        // line 308
        if ( !(isset($context["error_upload"]) ? $context["error_upload"] : null)) {
            // line 309
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 311
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_upload"]) ? $context["error_upload"] : null);
            echo "</span>
                  ";
        }
        // line 312
        echo "</td>
              </tr>
              <tr>
                <td>";
        // line 315
        echo (isset($context["modification"]) ? $context["modification"] : null);
        echo "/</td>
                <td>";
        // line 316
        if ( !(isset($context["error_modification"]) ? $context["error_modification"] : null)) {
            // line 317
            echo "                  <span class=\"text-success\">";
            echo (isset($context["text_writable"]) ? $context["text_writable"] : null);
            echo "</span>
                  ";
        } else {
            // line 319
            echo "                  <span class=\"text-danger\">";
            echo (isset($context["error_modification"]) ? $context["error_modification"] : null);
            echo "</span>
                  ";
        }
        // line 320
        echo "</td>
              </tr>
            </tbody>
          </table>
        </fieldset>
        <div class=\"buttons\">
          <div class=\"pull-left\"><a href=\"";
        // line 326
        echo (isset($context["back"]) ? $context["back"] : null);
        echo "\" class=\"btn btn-default\">";
        echo (isset($context["button_back"]) ? $context["button_back"] : null);
        echo "</a></div>
          <div class=\"pull-right\">
            <input type=\"submit\" value=\"";
        // line 328
        echo (isset($context["button_continue"]) ? $context["button_continue"] : null);
        echo "\" class=\"btn btn-primary\" />
          </div>
        </div>
      </form>
    </div>
    <div class=\"col-sm-3\">";
        // line 333
        echo (isset($context["column_left"]) ? $context["column_left"] : null);
        echo "</div>
  </div>
</div>
";
        // line 336
        echo (isset($context["footer"]) ? $context["footer"] : null);
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
        return array (  887 => 336,  881 => 333,  873 => 328,  866 => 326,  858 => 320,  852 => 319,  846 => 317,  844 => 316,  840 => 315,  835 => 312,  829 => 311,  823 => 309,  821 => 308,  817 => 307,  812 => 304,  806 => 303,  800 => 301,  798 => 300,  794 => 299,  789 => 296,  783 => 295,  777 => 293,  775 => 292,  771 => 291,  766 => 288,  760 => 287,  754 => 285,  752 => 284,  748 => 283,  743 => 280,  737 => 279,  731 => 277,  729 => 276,  725 => 275,  720 => 272,  714 => 271,  708 => 269,  706 => 268,  702 => 267,  697 => 264,  691 => 263,  685 => 261,  683 => 260,  679 => 259,  671 => 254,  667 => 253,  659 => 248,  652 => 243,  646 => 242,  640 => 240,  638 => 239,  634 => 238,  629 => 235,  623 => 234,  617 => 232,  615 => 231,  611 => 230,  603 => 225,  599 => 224,  591 => 219,  586 => 216,  581 => 213,  577 => 212,  573 => 210,  571 => 209,  567 => 208,  564 => 207,  558 => 206,  552 => 204,  550 => 203,  546 => 202,  543 => 201,  541 => 200,  537 => 198,  533 => 197,  529 => 195,  527 => 194,  523 => 193,  520 => 192,  514 => 191,  508 => 189,  506 => 188,  502 => 187,  497 => 184,  493 => 183,  489 => 181,  487 => 180,  483 => 179,  480 => 178,  474 => 177,  468 => 175,  466 => 174,  462 => 173,  457 => 170,  453 => 169,  449 => 167,  447 => 166,  443 => 165,  440 => 164,  434 => 163,  428 => 161,  426 => 160,  422 => 159,  417 => 156,  413 => 155,  409 => 153,  407 => 152,  403 => 151,  400 => 150,  394 => 149,  388 => 147,  386 => 146,  382 => 145,  377 => 142,  373 => 141,  369 => 139,  367 => 138,  363 => 137,  360 => 136,  354 => 135,  348 => 133,  346 => 132,  342 => 131,  337 => 128,  333 => 127,  329 => 125,  327 => 124,  323 => 123,  320 => 122,  314 => 121,  308 => 119,  306 => 118,  302 => 117,  294 => 112,  290 => 111,  286 => 110,  282 => 109,  274 => 104,  267 => 99,  263 => 98,  259 => 96,  257 => 95,  253 => 94,  250 => 93,  244 => 92,  238 => 90,  236 => 89,  232 => 88,  227 => 85,  223 => 84,  219 => 82,  217 => 81,  213 => 80,  210 => 79,  204 => 78,  198 => 76,  196 => 75,  192 => 74,  187 => 71,  183 => 70,  179 => 68,  177 => 67,  173 => 66,  170 => 65,  164 => 64,  158 => 62,  156 => 61,  152 => 60,  147 => 57,  143 => 56,  139 => 54,  137 => 53,  133 => 52,  130 => 51,  124 => 50,  118 => 48,  116 => 47,  112 => 46,  107 => 43,  103 => 42,  99 => 40,  97 => 39,  92 => 37,  88 => 36,  80 => 31,  76 => 30,  72 => 29,  68 => 28,  60 => 23,  56 => 22,  52 => 20,  44 => 16,  42 => 15,  32 => 8,  28 => 7,  19 => 1,);
    }
}
/* {{ header }}*/
/* <div class="container">*/
/*   <header>*/
/*     <div class="row">*/
/*       <div class="col-sm-6">*/
/*         <h1 class="pull-left">2<small>/4</small></h1>*/
/*         <h3>{{ heading_title }}<br>*/
/*           <small>{{ text_step_2 }}</small></h3>*/
/*       </div>*/
/*       <div class="col-sm-6">*/
/*         <div id="logo" class="pull-right hidden-xs"><img src="view/image/logo.png" alt="OpenCart" title="OpenCart" /></div>*/
/*       </div>*/
/*     </div>*/
/*   </header>*/
/*   {% if error_warning %}*/
/*   <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*     <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*   </div>*/
/*   {% endif %}*/
/*   <div class="row">*/
/*     <div class="col-sm-9">*/
/*       <form action="{{ action }}" method="post" enctype="multipart/form-data">*/
/*         <p>{{ text_install_php }}</p>*/
/*         <fieldset>*/
/*           <table class="table">*/
/*             <thead>*/
/*               <tr>*/
/*                 <td width="35%"><b>{{ text_setting }}</b></td>*/
/*                 <td width="25%"><b>{{ text_current }}</b></td>*/
/*                 <td width="25%"><b>{{ text_required }}</b></td>*/
/*                 <td width="15%" class="text-center"><b>{{ text_status }}</b></td>*/
/*               </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*               <tr>*/
/*                 <td>{{ text_version }}</td>*/
/*                 <td>{{ php_version }}</td>*/
/*                 <td>5.4+</td>*/
/*                 <td class="text-center">{% if php_version >= '5.4' %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_global }}</td>*/
/*                 <td>{% if register_globals %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_off }}</td>*/
/*                 <td class="text-center">{% if not register_globals %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_magic }}</td>*/
/*                 <td>{% if magic_quotes_gpc %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_off }}</td>*/
/*                 <td class="text-center">{% if not error_magic_quotes_gpc %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_file_upload }}</td>*/
/*                 <td>{% if file_uploads %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if file_uploads %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_session }}</td>*/
/*                 <td>{% if session_auto_start %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_off }}</td>*/
/*                 <td class="text-center">{% if not session_auto_start %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*             </tbody>*/
/*           </table>*/
/*         </fieldset>*/
/*         <p>{{ text_install_extension }}</p>*/
/*         <fieldset>*/
/*           <table class="table">*/
/*             <thead>*/
/*               <tr>*/
/*                 <td width="35%"><b>{{ text_extension }}</b></td>*/
/*                 <td width="25%"><b>{{ text_current }}</b></td>*/
/*                 <td width="25%"><b>{{ text_required }}</b></td>*/
/*                 <td width="15%" class="text-center"><b>{{ text_status }}</b></td>*/
/*               </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*               <tr>*/
/*                 <td>{{ text_db }}</td>*/
/*                 <td>{% if db %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if db %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_gd }}</td>*/
/*                 <td>{% if gd %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if gd %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_curl }}</td>*/
/*                 <td>{% if curl %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if curl %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_openssl }}</td>*/
/*                 <td>{% if openssl %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if openssl %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_zlib }}</td>*/
/*                 <td>{% if zlib %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if zlib %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ text_zip }}</td>*/
/*                 <td>{% if zip %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if zip %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               {% if not iconv %}*/
/*               <tr>*/
/*                 <td>{{ text_mbstring }}</td>*/
/*                 <td>{% if mbstring %}*/
/*                   {{ text_on }}*/
/*                   {% else %}*/
/*                   {{ text_off }}*/
/*                   {% endif %}</td>*/
/*                 <td>{{ text_on }}</td>*/
/*                 <td class="text-center">{% if mbstring %}*/
/*                   <span class="text-success"><i class="fa fa-check-circle"></i></span>*/
/*                   {% else %}*/
/*                   <span class="text-danger"><i class="fa fa-minus-circle"></i></span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               {% endif %}*/
/*             </tbody>*/
/*           </table>*/
/*         </fieldset>*/
/*         <p>{{ text_install_file }}</p>*/
/*         <fieldset>*/
/*           <table class="table">*/
/*             <thead>*/
/*               <tr>*/
/*                 <td><b>{{ text_file }}</b></td>*/
/*                 <td><b>{{ text_status }}</b></td>*/
/*               </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*               <tr>*/
/*                 <td>{{ catalog_config }}</td>*/
/*                 <td>{% if not error_catalog_config %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_catalog_config }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ admin_config }}</td>*/
/*                 <td>{% if not error_admin_config %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_admin_config }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*             </tbody>*/
/*           </table>*/
/*         </fieldset>*/
/*         <p>{{ text_install_directory }}</p>*/
/*         <fieldset>*/
/*           <table class="table">*/
/*             <thead>*/
/*               <tr>*/
/*                 <td align="left"><b>{{ text_directory }}</b></td>*/
/*                 <td align="left"><b>{{ text_status }}</b></td>*/
/*               </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*               <tr>*/
/*                 <td>{{ image }}/</td>*/
/*                 <td>{% if not error_image %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_image }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ image_cache }}/</td>*/
/*                 <td>{% if not error_image_cache %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_image_cache }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ image_catalog }}/</td>*/
/*                 <td>{% if not error_image_catalog %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_image_catalog }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ cache }}/</td>*/
/*                 <td>{% if not error_cache %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_cache }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ logs }}/</td>*/
/*                 <td>{% if not error_logs %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_logs }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ download }}/</td>*/
/*                 <td>{% if not error_download %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_download }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ upload }}/</td>*/
/*                 <td>{% if not error_upload %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_upload }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*               <tr>*/
/*                 <td>{{ modification }}/</td>*/
/*                 <td>{% if not error_modification %}*/
/*                   <span class="text-success">{{ text_writable }}</span>*/
/*                   {% else %}*/
/*                   <span class="text-danger">{{ error_modification }}</span>*/
/*                   {% endif %}</td>*/
/*               </tr>*/
/*             </tbody>*/
/*           </table>*/
/*         </fieldset>*/
/*         <div class="buttons">*/
/*           <div class="pull-left"><a href="{{ back }}" class="btn btn-default">{{ button_back }}</a></div>*/
/*           <div class="pull-right">*/
/*             <input type="submit" value="{{ button_continue }}" class="btn btn-primary" />*/
/*           </div>*/
/*         </div>*/
/*       </form>*/
/*     </div>*/
/*     <div class="col-sm-3">{{ column_left }}</div>*/
/*   </div>*/
/* </div>*/
/* {{ footer }}*/
