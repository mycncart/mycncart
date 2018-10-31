<?php

/* setting/setting.twig */
class __TwigTemplate_2218d306dc4ea0a7c83fa07db5f3950f904cb7bfa226163eac98921630c3855c extends Twig_Template
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
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"float-right\">
        <button type=\"submit\" id=\"button-save\" form=\"form-setting\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" disabled=\"disabled\" class=\"btn btn-primary\"><i class=\"fas fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-light\"><i class=\"fas fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ol class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "          <li class=\"breadcrumb-item\"><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", array());
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", array());
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ol>
    </div>
  </div>
  <div class=\"container-fluid\"> ";
        // line 16
        if (($context["error_warning"] ?? null)) {
            // line 17
            echo "      <div class=\"alert alert-danger alert-dismissible\"><i class=\"fas fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
      </div>
    ";
        }
        // line 21
        echo "    ";
        if (($context["success"] ?? null)) {
            // line 22
            echo "      <div class=\"alert alert-success alert-dismissible\"><i class=\"fas fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
      </div>
    ";
        }
        // line 26
        echo "    <div class=\"card\">
      <div class=\"card-header\"><i class=\"fas fa-pencil-alt\"></i> ";
        // line 27
        echo ($context["text_edit"] ?? null);
        echo "</div>
      <div class=\"card-body\">
        <form action=\"";
        // line 29
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-setting\">
          <ul class=\"nav nav-tabs\">
            <li class=\"nav-item\"><a href=\"#tab-general\" data-toggle=\"tab\" class=\"nav-link active\">";
        // line 31
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-store\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 32
        echo ($context["tab_store"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-local\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 33
        echo ($context["tab_local"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-option\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 34
        echo ($context["tab_option"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-image\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 35
        echo ($context["tab_image"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-mail\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 36
        echo ($context["tab_mail"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-server\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 37
        echo ($context["tab_server"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\">
              <div class=\"form-group row required\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-meta-title\">";
        // line 42
        echo ($context["entry_meta_title"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_meta_title\" value=\"";
        // line 44
        echo ($context["config_meta_title"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_meta_title"] ?? null);
        echo "\" id=\"input-meta-title\" class=\"form-control\"/>
                  ";
        // line 45
        if (($context["error_meta_title"] ?? null)) {
            // line 46
            echo "                    <div class=\"invalid-tooltip\">";
            echo ($context["error_meta_title"] ?? null);
            echo "</div>
                  ";
        }
        // line 47
        echo "</div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-meta-description\">";
        // line 50
        echo ($context["entry_meta_description"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_meta_description\" rows=\"5\" placeholder=\"";
        // line 52
        echo ($context["entry_meta_description"] ?? null);
        echo "\" id=\"input-meta-description\" class=\"form-control\">";
        echo ($context["config_meta_description"] ?? null);
        echo "</textarea>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-meta-keyword\">";
        // line 56
        echo ($context["entry_meta_keyword"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_meta_keyword\" rows=\"5\" placeholder=\"";
        // line 58
        echo ($context["entry_meta_keyword"] ?? null);
        echo "\" id=\"input-meta-keyword\" class=\"form-control\">";
        echo ($context["config_meta_keyword"] ?? null);
        echo "</textarea>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-theme\">";
        // line 62
        echo ($context["entry_theme"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_theme\" id=\"input-theme\" class=\"form-control\">
                    ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["themes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 66
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["theme"], "value", array()) == ($context["config_theme"] ?? null))) {
                // line 67
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "value", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "text", array());
                echo "</option>
                      ";
            } else {
                // line 69
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "value", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "text", array());
                echo "</option>
                      ";
            }
            // line 71
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "                  </select>
                  <br/>
                  <img src=\"\" alt=\"\" id=\"theme\" class=\"img-thumbnail\"/></div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-layout\">";
        // line 77
        echo ($context["entry_layout"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_layout_id\" id=\"input-layout\" class=\"form-control\">
                    ";
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layouts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout"]) {
            // line 81
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", array()) == ($context["config_layout_id"] ?? null))) {
                // line 82
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", array());
                echo "</option>
                      ";
            } else {
                // line 84
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", array());
                echo "</option>
                      ";
            }
            // line 86
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "                  </select>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-store\">
              <div class=\"form-group row required\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-name\">";
        // line 93
        echo ($context["entry_name"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_name\" value=\"";
        // line 95
        echo ($context["config_name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\"/>
                  ";
        // line 96
        if (($context["error_name"] ?? null)) {
            // line 97
            echo "                    <div class=\"invalid-tooltip\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
                  ";
        }
        // line 98
        echo "</div>
              </div>
              <div class=\"form-group row required\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-owner\">";
        // line 101
        echo ($context["entry_owner"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_owner\" value=\"";
        // line 103
        echo ($context["config_owner"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_owner"] ?? null);
        echo "\" id=\"input-owner\" class=\"form-control\"/>
                  ";
        // line 104
        if (($context["error_owner"] ?? null)) {
            // line 105
            echo "                    <div class=\"invalid-tooltip\">";
            echo ($context["error_owner"] ?? null);
            echo "</div>
                  ";
        }
        // line 106
        echo "</div>
              </div>
              <div class=\"form-group row required\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-address\">";
        // line 109
        echo ($context["entry_address"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_address\" placeholder=\"";
        // line 111
        echo ($context["entry_address"] ?? null);
        echo "\" rows=\"5\" id=\"input-address\" class=\"form-control\">";
        echo ($context["config_address"] ?? null);
        echo "</textarea>
                  ";
        // line 112
        if (($context["error_address"] ?? null)) {
            // line 113
            echo "                    <div class=\"invalid-tooltip\">";
            echo ($context["error_address"] ?? null);
            echo "</div>
                  ";
        }
        // line 114
        echo "</div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-geocode\">";
        // line 117
        echo ($context["entry_geocode"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_geocode\" value=\"";
        // line 119
        echo ($context["config_geocode"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_geocode"] ?? null);
        echo "\" id=\"input-geocode\" class=\"form-control\"/>
                  <small class=\"form-text text-muted\">";
        // line 120
        echo ($context["help_geocode"] ?? null);
        echo "</small>
                </div>
              </div>
              <div class=\"form-group row required\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-email\">";
        // line 124
        echo ($context["entry_email"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_email\" value=\"";
        // line 126
        echo ($context["config_email"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_email"] ?? null);
        echo "\" id=\"input-email\" class=\"form-control\"/>
                  ";
        // line 127
        if (($context["error_email"] ?? null)) {
            // line 128
            echo "                    <div class=\"invalid-tooltip\">";
            echo ($context["error_email"] ?? null);
            echo "</div>
                  ";
        }
        // line 129
        echo "</div>
              </div>
              <div class=\"form-group row required\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-telephone\">";
        // line 132
        echo ($context["entry_telephone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_telephone\" value=\"";
        // line 134
        echo ($context["config_telephone"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_telephone"] ?? null);
        echo "\" id=\"input-telephone\" class=\"form-control\"/>
                  ";
        // line 135
        if (($context["error_telephone"] ?? null)) {
            // line 136
            echo "                    <div class=\"invalid-tooltip\">";
            echo ($context["error_telephone"] ?? null);
            echo "</div>
                  ";
        }
        // line 137
        echo "</div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-fax\">";
        // line 140
        echo ($context["entry_fax"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_fax\" value=\"";
        // line 142
        echo ($context["config_fax"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_fax"] ?? null);
        echo "\" id=\"input-fax\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-image\">";
        // line 146
        echo ($context["entry_image"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"card image\">
                    <img src=\"";
        // line 149
        echo ($context["thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" id=\"thumb-image\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" class=\"card-img-top\"/> <input type=\"hidden\" name=\"config_image\" value=\"";
        echo ($context["config_image"] ?? null);
        echo "\" id=\"input-image\"/>
                    <div class=\"card-body\">
                      <button type=\"button\" data-toggle=\"image\" data-target=\"#input-image\" data-thumb=\"#thumb-image\" class=\"btn btn-primary btn-sm btn-block\"><i class=\"fas fa-pencil-alt\"></i> ";
        // line 151
        echo ($context["button_edit"] ?? null);
        echo "</button>
                      <button type=\"button\" data-toggle=\"clear\" data-target=\"#input-image\" data-thumb=\"#thumb-image\" class=\"btn btn-warning btn-sm btn-block\"><i class=\"fas fa-trash-alt\"></i> ";
        // line 152
        echo ($context["button_clear"] ?? null);
        echo "</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-open\">";
        // line 158
        echo ($context["entry_open"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_open\" rows=\"5\" placeholder=\"";
        // line 160
        echo ($context["entry_open"] ?? null);
        echo "\" id=\"input-open\" class=\"form-control\">";
        echo ($context["config_open"] ?? null);
        echo "</textarea>
                  <small class=\"form-text text-muted\">";
        // line 161
        echo ($context["help_open"] ?? null);
        echo "</small>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-comment\">";
        // line 165
        echo ($context["entry_comment"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_comment\" rows=\"5\" placeholder=\"";
        // line 167
        echo ($context["entry_comment"] ?? null);
        echo "\" id=\"input-comment\" class=\"form-control\">";
        echo ($context["config_comment"] ?? null);
        echo "</textarea>
                  <small class=\"form-text text-muted\">";
        // line 168
        echo ($context["help_comment"] ?? null);
        echo "</small>
                </div>
              </div>
              ";
        // line 171
        if (($context["locations"] ?? null)) {
            // line 172
            echo "                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
            // line 173
            echo ($context["entry_location"] ?? null);
            echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"form-control\" style=\"height: 150px; overflow: auto;\">
                      ";
            // line 176
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["locations"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["location"]) {
                // line 177
                echo "                        <label class=\"form-check\">
                          ";
                // line 178
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["location"], "location_id", array()), ($context["config_location"] ?? null))) {
                    // line 179
                    echo "                            <input type=\"checkbox\" name=\"config_location[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "location_id", array());
                    echo "\" checked=\"checked\" class=\"form-check-input\"/>
                            ";
                    // line 180
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "name", array());
                    echo "
                          ";
                } else {
                    // line 182
                    echo "                            <input type=\"checkbox\" name=\"config_location[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "location_id", array());
                    echo "\" class=\"form-check-input\"/>
                            ";
                    // line 183
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "name", array());
                    echo "
                          ";
                }
                // line 185
                echo "                        </label>
                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['location'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 187
            echo "                    </div>
                    <small class=\"form-text text-muted\">";
            // line 188
            echo ($context["help_location"] ?? null);
            echo "</small>
                  </div>
                </div>
              ";
        }
        // line 192
        echo "            </div>
            <div class=\"tab-pane\" id=\"tab-local\">
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-country\">";
        // line 195
        echo ($context["entry_country"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_country_id\" id=\"input-country\" class=\"form-control\">
                    ";
        // line 198
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 199
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", array()) == ($context["config_country_id"] ?? null))) {
                // line 200
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", array());
                echo "</option>
                      ";
            } else {
                // line 202
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", array());
                echo "</option>
                      ";
            }
            // line 204
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 205
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-zone\">";
        // line 209
        echo ($context["entry_zone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_zone_id\" id=\"input-zone\" class=\"form-control\"> </select>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-timezone\">";
        // line 215
        echo ($context["entry_timezone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_timezone\" id=\"input-timezone\" class=\"form-control\">
                    ";
        // line 218
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["timezones"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["timezone"]) {
            // line 219
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["timezone"], "value", array()) == ($context["config_timezone"] ?? null))) {
                // line 220
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["timezone"], "value", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["timezone"], "text", array());
                echo "</option>
                      ";
            } else {
                // line 222
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["timezone"], "value", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["timezone"], "text", array());
                echo "</option>
                      ";
            }
            // line 224
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['timezone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 225
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-language\">";
        // line 229
        echo ($context["entry_language"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_language\" id=\"input-language\" class=\"form-control\">
                    ";
        // line 232
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 233
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", array()) == ($context["config_language"] ?? null))) {
                // line 234
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", array());
                echo "</option>
                      ";
            } else {
                // line 236
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", array());
                echo "</option>
                      ";
            }
            // line 238
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 239
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-admin-language\">";
        // line 243
        echo ($context["entry_admin_language"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_admin_language\" id=\"input-admin-language\" class=\"form-control\">
                    ";
        // line 246
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 247
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", array()) == ($context["config_admin_language"] ?? null))) {
                // line 248
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", array());
                echo "</option>
                      ";
            } else {
                // line 250
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", array());
                echo "</option>
                      ";
            }
            // line 252
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 253
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-currency\">";
        // line 257
        echo ($context["entry_currency"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_currency\" id=\"input-currency\" class=\"form-control\">
                    ";
        // line 260
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
            // line 261
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["currency"], "code", array()) == ($context["config_currency"] ?? null))) {
                // line 262
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", array());
                echo "</option>
                      ";
            } else {
                // line 264
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", array());
                echo "</option>
                      ";
            }
            // line 266
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 267
        echo "                  </select>
                  <small class=\"form-text text-muted\">";
        // line 268
        echo ($context["help_currency"] ?? null);
        echo "</small>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-currency-engine\">";
        // line 272
        echo ($context["entry_currency_engine"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_currency_engine\" id=\"input-currency-engine\" class=\"form-control\">
                    ";
        // line 275
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currency_engines"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currency_engine"]) {
            // line 276
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["currency_engine"], "value", array()) == ($context["config_currency_engine"] ?? null))) {
                // line 277
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["currency_engine"], "value", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency_engine"], "text", array());
                echo "</option>
                      ";
            } else {
                // line 279
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["currency_engine"], "value", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency_engine"], "text", array());
                echo "</option>
                      ";
            }
            // line 281
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency_engine'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 282
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\">";
        // line 286
        echo ($context["entry_currency_auto"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                    ";
        // line 289
        if (($context["config_currency_auto"] ?? null)) {
            // line 290
            echo "                      <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_currency_auto\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                      <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_currency_auto\" value=\"0\"/> ";
            // line 291
            echo ($context["text_no"] ?? null);
            echo "</label>
                    ";
        } else {
            // line 293
            echo "                      <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_currency_auto\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                      <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_currency_auto\" value=\"0\" checked=\"checked\"/> ";
            // line 294
            echo ($context["text_no"] ?? null);
            echo "</label>
                    ";
        }
        // line 296
        echo "                  </div>
                  <small class=\"form-text text-muted\">";
        // line 297
        echo ($context["help_currency_auto"] ?? null);
        echo "</small>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-length-class\">";
        // line 301
        echo ($context["entry_length_class"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_length_class_id\" id=\"input-length-class\" class=\"form-control\">
                    ";
        // line 304
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["length_classes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["length_class"]) {
            // line 305
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", array()) == ($context["config_length_class_id"] ?? null))) {
                // line 306
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "title", array());
                echo "</option>
                      ";
            } else {
                // line 308
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "title", array());
                echo "</option>
                      ";
            }
            // line 310
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['length_class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 311
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-weight-class\">";
        // line 315
        echo ($context["entry_weight_class"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_weight_class_id\" id=\"input-weight-class\" class=\"form-control\">
                    ";
        // line 318
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["weight_classes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["weight_class"]) {
            // line 319
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", array()) == ($context["config_weight_class_id"] ?? null))) {
                // line 320
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "title", array());
                echo "</option>
                      ";
            } else {
                // line 322
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "title", array());
                echo "</option>
                      ";
            }
            // line 324
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['weight_class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 325
        echo "                  </select>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-option\">
              <ul class=\"nav nav-tabs\">
                <li class=\"nav-item\"><a href=\"#tab-product\" data-toggle=\"tab\" class=\"nav-link active\">";
        // line 331
        echo ($context["tab_product"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-review\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 332
        echo ($context["tab_review"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-voucher\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 333
        echo ($context["tab_voucher"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-legal\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 334
        echo ($context["tab_legal"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-tax\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 335
        echo ($context["tab_tax"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-account\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 336
        echo ($context["tab_account"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-checkout\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 337
        echo ($context["tab_checkout"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-stock\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 338
        echo ($context["tab_stock"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-affiliate\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 339
        echo ($context["tab_affiliate"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-return\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 340
        echo ($context["tab_return"] ?? null);
        echo "</a></li>
                <li class=\"nav-item\"><a href=\"#tab-captcha\" data-toggle=\"tab\" class=\"nav-link\">";
        // line 341
        echo ($context["tab_captcha"] ?? null);
        echo "</a></li>
              </ul>
              <div class=\"tab-content\">
                <div class=\"tab-pane active\" id=\"tab-product\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 346
        echo ($context["entry_product_count"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 349
        if (($context["config_product_count"] ?? null)) {
            // line 350
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_product_count\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_product_count\" value=\"0\"/> ";
            // line 351
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 353
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_product_count\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_product_count\" value=\"0\" checked=\"checked\"/> ";
            // line 354
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 356
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 357
        echo ($context["help_product_count"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row required\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-admin-limit\">";
        // line 361
        echo ($context["entry_limit_admin"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"config_limit_admin\" value=\"";
        // line 363
        echo ($context["config_limit_admin"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_limit_admin"] ?? null);
        echo "\" id=\"input-admin-limit\" class=\"form-control\"/>
                      <small class=\"form-text text-muted\">";
        // line 364
        echo ($context["help_limit_admin"] ?? null);
        echo "</small>
                      ";
        // line 365
        if (($context["error_limit_admin"] ?? null)) {
            // line 366
            echo "                        <div class=\"invalid-tooltip\">";
            echo ($context["error_limit_admin"] ?? null);
            echo "</div>
                      ";
        }
        // line 367
        echo "</div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-review\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 372
        echo ($context["entry_review_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 375
        if (($context["config_review_status"] ?? null)) {
            // line 376
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_review_status\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_review_status\" value=\"0\"/> ";
            // line 377
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 379
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_review_status\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_review_status\" value=\"0\" checked=\"checked\"/> ";
            // line 380
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 382
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 383
        echo ($context["help_review"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 387
        echo ($context["entry_review_guest"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 390
        if (($context["config_review_guest"] ?? null)) {
            // line 391
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_review_guest\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_review_guest\" value=\"0\"/> ";
            // line 392
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 394
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_review_guest\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_review_guest\" value=\"0\" checked=\"checked\"/> ";
            // line 395
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 397
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 398
        echo ($context["help_review_guest"] ?? null);
        echo "</small>
                    </div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-voucher\">
                  <div class=\"form-group row required\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-voucher-min\">";
        // line 404
        echo ($context["entry_voucher_min"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"config_voucher_min\" value=\"";
        // line 406
        echo ($context["config_voucher_min"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_voucher_min"] ?? null);
        echo "\" id=\"input-voucher-min\" class=\"form-control\"/>
                      <small class=\"form-text text-muted\">";
        // line 407
        echo ($context["help_voucher_min"] ?? null);
        echo "</small>
                      ";
        // line 408
        if (($context["error_voucher_min"] ?? null)) {
            // line 409
            echo "                        <div class=\"invalid-tooltip\">";
            echo ($context["error_voucher_min"] ?? null);
            echo "</div>
                      ";
        }
        // line 410
        echo "</div>
                  </div>
                  <div class=\"form-group row required\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-voucher-max\">";
        // line 413
        echo ($context["entry_voucher_max"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"config_voucher_max\" value=\"";
        // line 415
        echo ($context["config_voucher_max"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_voucher_max"] ?? null);
        echo "\" id=\"input-voucher-max\" class=\"form-control\"/>
                      <small class=\"form-text text-muted\">";
        // line 416
        echo ($context["help_voucher_max"] ?? null);
        echo "</small>
                      ";
        // line 417
        if (($context["error_voucher_max"] ?? null)) {
            // line 418
            echo "                        <div class=\"invalid-tooltip\">";
            echo ($context["error_voucher_max"] ?? null);
            echo "</div>
                      ";
        }
        // line 419
        echo "</div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-legal\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 424
        echo ($context["entry_cookie_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 427
        if (($context["config_cookie_status"] ?? null)) {
            // line 428
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_cookie_status\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_cookie_status\" value=\"0\"/> ";
            // line 429
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 431
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_cookie_status\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_cookie_status\" value=\"0\" checked=\"checked\"/> ";
            // line 432
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 434
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 435
        echo ($context["help_cookie"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 439
        echo ($context["entry_gdpr_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 442
        if (($context["config_gdpr_status"] ?? null)) {
            // line 443
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_gdpr_status\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_gdpr_status\" value=\"0\"/> ";
            // line 444
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 446
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_gdpr_status\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_gdpr_status\" value=\"0\" checked=\"checked\"/> ";
            // line 447
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 449
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 450
        echo ($context["help_gdpr_status"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-gdpr-limit\">";
        // line 454
        echo ($context["entry_gdpr_limit"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"config_gdpr_limit\" value=\"";
        // line 456
        echo ($context["config_gdpr_limit"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_gdpr_limit"] ?? null);
        echo "\" id=\"input-gdpr-limit\" class=\"form-control\"/>
                      <small class=\"form-text text-muted\">";
        // line 457
        echo ($context["help_gdpr_limit"] ?? null);
        echo "</small>
                    </div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-tax\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 463
        echo ($context["entry_tax"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 466
        if (($context["config_tax"] ?? null)) {
            // line 467
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_tax\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_tax\" value=\"0\"/> ";
            // line 468
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 470
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_tax\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_tax\" value=\"0\" checked=\"checked\"/> ";
            // line 471
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 473
        echo "                      </div>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-tax-default\">";
        // line 477
        echo ($context["entry_tax_default"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_tax_default\" id=\"input-tax-default\" class=\"form-control\">
                        <option value=\"\">";
        // line 480
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 481
        if ((($context["config_tax_default"] ?? null) == "shipping")) {
            // line 482
            echo "                          <option value=\"shipping\" selected=\"selected\">";
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                        ";
        } else {
            // line 484
            echo "                          <option value=\"shipping\">";
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                        ";
        }
        // line 486
        echo "                        ";
        if ((($context["config_tax_default"] ?? null) == "payment")) {
            // line 487
            echo "                          <option value=\"payment\" selected=\"selected\">";
            echo ($context["text_payment"] ?? null);
            echo "</option>
                        ";
        } else {
            // line 489
            echo "                          <option value=\"payment\">";
            echo ($context["text_payment"] ?? null);
            echo "</option>
                        ";
        }
        // line 491
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 492
        echo ($context["help_tax_default"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-tax-customer\">";
        // line 496
        echo ($context["entry_tax_customer"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_tax_customer\" id=\"input-tax-customer\" class=\"form-control\">
                        <option value=\"\">";
        // line 499
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 500
        if ((($context["config_tax_customer"] ?? null) == "shipping")) {
            // line 501
            echo "                          <option value=\"shipping\" selected=\"selected\">";
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                        ";
        } else {
            // line 503
            echo "                          <option value=\"shipping\">";
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                        ";
        }
        // line 505
        echo "                        ";
        if ((($context["config_tax_customer"] ?? null) == "payment")) {
            // line 506
            echo "                          <option value=\"payment\" selected=\"selected\">";
            echo ($context["text_payment"] ?? null);
            echo "</option>
                        ";
        } else {
            // line 508
            echo "                          <option value=\"payment\">";
            echo ($context["text_payment"] ?? null);
            echo "</option>
                        ";
        }
        // line 510
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 511
        echo ($context["help_tax_customer"] ?? null);
        echo "</small>
                    </div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-account\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 517
        echo ($context["entry_customer_online"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 520
        if (($context["config_customer_online"] ?? null)) {
            // line 521
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_online\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_online\" value=\"0\"/> ";
            // line 522
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 524
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_online\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_online\" value=\"0\" checked=\"checked\"/> ";
            // line 525
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 527
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 528
        echo ($context["help_customer_online"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 532
        echo ($context["entry_customer_activity"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 535
        if (($context["config_customer_activity"] ?? null)) {
            // line 536
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_activity\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_activity\" value=\"0\"/> ";
            // line 537
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 539
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_activity\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_activity\" value=\"0\" checked=\"checked\"/> ";
            // line 540
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 542
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 543
        echo ($context["help_customer_activity"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 547
        echo ($context["entry_customer_search"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 550
        if (($context["config_customer_search"] ?? null)) {
            // line 551
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_search\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_search\" value=\"0\"/> ";
            // line 552
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 554
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_search\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_search\" value=\"0\" checked=\"checked\"/> ";
            // line 555
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 557
        echo "                      </div>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-customer-group\">";
        // line 561
        echo ($context["entry_customer_group"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_customer_group_id\" id=\"input-customer-group\" class=\"form-control\">
                        ";
        // line 564
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 565
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array()) == ($context["config_customer_group_id"] ?? null))) {
                // line 566
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", array());
                echo "</option>
                          ";
            } else {
                // line 568
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", array());
                echo "</option>
                          ";
            }
            // line 570
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 571
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 572
        echo ($context["help_customer_group"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 576
        echo ($context["entry_customer_group_display"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"form-control\" style=\"height: 150px; overflow: auto;\">
                        ";
        // line 579
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 580
            echo "                          <label class=\"form-check\">";
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array()), ($context["config_customer_group_display"] ?? null))) {
                // line 581
                echo "                              <input type=\"checkbox\" name=\"config_customer_group_display[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array());
                echo "\" checked=\"checked\" class=\"form-check-input\"/>
                              ";
                // line 582
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", array());
                echo "
                            ";
            } else {
                // line 584
                echo "                              <input type=\"checkbox\" name=\"config_customer_group_display[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array());
                echo "\" class=\"form-check-input\"/>
                              ";
                // line 585
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", array());
                echo "
                            ";
            }
            // line 586
            echo "</label>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 588
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 589
        echo ($context["help_customer_group_display"] ?? null);
        echo "</small>
                      ";
        // line 590
        if (($context["error_customer_group_display"] ?? null)) {
            // line 591
            echo "                        <div class=\"invalid-tooltip\">";
            echo ($context["error_customer_group_display"] ?? null);
            echo "</div>
                      ";
        }
        // line 592
        echo "</div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 595
        echo ($context["entry_customer_price"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 598
        if (($context["config_customer_price"] ?? null)) {
            // line 599
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_price\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_price\" value=\"0\"/> ";
            // line 600
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 602
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_customer_price\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_customer_price\" value=\"0\" checked=\"checked\"/> ";
            // line 603
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 605
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 606
        echo ($context["help_customer_price"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-login-attempts\">";
        // line 610
        echo ($context["entry_login_attempts"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"config_login_attempts\" value=\"";
        // line 612
        echo ($context["config_login_attempts"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_login_attempts"] ?? null);
        echo "\" id=\"input-login-attempts\" class=\"form-control\"/>
                      <small class=\"form-text text-muted\">";
        // line 613
        echo ($context["help_login_attempts"] ?? null);
        echo "</small>
                      ";
        // line 614
        if (($context["error_login_attempts"] ?? null)) {
            // line 615
            echo "                        <div class=\"invalid-tooltip\">";
            echo ($context["error_login_attempts"] ?? null);
            echo "</div>
                      ";
        }
        // line 616
        echo "</div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-account\">";
        // line 619
        echo ($context["entry_account"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_account_id\" id=\"input-account\" class=\"form-control\">
                        <option value=\"0\">";
        // line 622
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 623
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 624
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array()) == ($context["config_account_id"] ?? null))) {
                // line 625
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            } else {
                // line 627
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            }
            // line 629
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 630
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 631
        echo ($context["help_account"] ?? null);
        echo "</small>
                    </div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-checkout\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-invoice-prefix\">";
        // line 637
        echo ($context["entry_invoice_prefix"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"config_invoice_prefix\" value=\"";
        // line 639
        echo ($context["config_invoice_prefix"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_invoice_prefix"] ?? null);
        echo "\" id=\"input-invoice-prefix\" class=\"form-control\"/>
                      <small class=\"form-text text-muted\">";
        // line 640
        echo ($context["help_invoice_prefix"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 644
        echo ($context["entry_cart_weight"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 647
        if (($context["config_cart_weight"] ?? null)) {
            // line 648
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_cart_weight\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_cart_weight\" value=\"0\"/> ";
            // line 649
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 651
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_cart_weight\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_cart_weight\" value=\"0\" checked=\"checked\"/> ";
            // line 652
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 654
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 655
        echo ($context["help_cart_weight"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 659
        echo ($context["entry_checkout_guest"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 662
        if (($context["config_checkout_guest"] ?? null)) {
            // line 663
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_checkout_guest\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_checkout_guest\" value=\"0\"/> ";
            // line 664
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 666
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_checkout_guest\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_checkout_guest\" value=\"0\" checked=\"checked\"/> ";
            // line 667
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 669
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 670
        echo ($context["help_checkout_guest"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-checkout\">";
        // line 674
        echo ($context["entry_checkout"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_checkout_id\" id=\"input-checkout\" class=\"form-control\">
                        <option value=\"0\">";
        // line 677
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 678
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 679
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array()) == ($context["config_checkout_id"] ?? null))) {
                // line 680
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            } else {
                // line 682
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            }
            // line 684
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 685
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 686
        echo ($context["help_checkout"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-order-status\">";
        // line 690
        echo ($context["entry_order_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_order_status_id\" id=\"input-order-status\" class=\"form-control\">
                        ";
        // line 693
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 694
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array()) == ($context["config_order_status_id"] ?? null))) {
                // line 695
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "</option>
                          ";
            } else {
                // line 697
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "</option>
                          ";
            }
            // line 699
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 700
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 701
        echo ($context["help_order_status"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-process-status\">";
        // line 705
        echo ($context["entry_processing_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"form-control\" style=\"height: 150px; overflow: auto;\">
                        ";
        // line 708
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 709
            echo "                          <label class=\"form-check\">";
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array()), ($context["config_processing_status"] ?? null))) {
                // line 710
                echo "                              <input type=\"checkbox\" name=\"config_processing_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\" checked=\"checked\" class=\"form-check-input\"/>
                              ";
                // line 711
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "
                            ";
            } else {
                // line 713
                echo "                              <input type=\"checkbox\" name=\"config_processing_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\" class=\"form-check-input\"/>
                              ";
                // line 714
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "
                            ";
            }
            // line 716
            echo "                          </label>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 718
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 719
        echo ($context["help_processing_status"] ?? null);
        echo "</small>
                      ";
        // line 720
        if (($context["error_processing_status"] ?? null)) {
            // line 721
            echo "                        <div class=\"invalid-tooltip\">";
            echo ($context["error_processing_status"] ?? null);
            echo "</div>
                      ";
        }
        // line 723
        echo "                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-complete-status\">";
        // line 726
        echo ($context["entry_complete_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"form-control\" style=\"height: 150px; overflow: auto;\">
                        ";
        // line 729
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 730
            echo "                          <label class=\"form-check\">
                            ";
            // line 731
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array()), ($context["config_complete_status"] ?? null))) {
                // line 732
                echo "                              <input type=\"checkbox\" name=\"config_complete_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\" checked=\"checked\" class=\"form-check-input\"/>
                              ";
                // line 733
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "
                            ";
            } else {
                // line 735
                echo "                              <input type=\"checkbox\" name=\"config_complete_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\" class=\"form-check-input\"/>
                              ";
                // line 736
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "
                            ";
            }
            // line 738
            echo "                          </label>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 740
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 741
        echo ($context["help_complete_status"] ?? null);
        echo "</small>
                      ";
        // line 742
        if (($context["error_complete_status"] ?? null)) {
            // line 743
            echo "                        <div class=\"invalid-tooltip\">";
            echo ($context["error_complete_status"] ?? null);
            echo "</div>
                      ";
        }
        // line 744
        echo "</div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-fraud-status\">";
        // line 747
        echo ($context["entry_fraud_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_fraud_status_id\" id=\"input-fraud-status\" class=\"form-control\">
                        ";
        // line 750
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 751
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array()) == ($context["config_fraud_status_id"] ?? null))) {
                // line 752
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "</option>
                          ";
            } else {
                // line 754
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", array());
                echo "</option>
                          ";
            }
            // line 756
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 757
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 758
        echo ($context["help_fraud_status"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-api\">";
        // line 762
        echo ($context["entry_api"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_api_id\" id=\"input-api\" class=\"form-control\">
                        <option value=\"0\">";
        // line 765
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 766
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["apis"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["api"]) {
            // line 767
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["api"], "api_id", array()) == ($context["config_api_id"] ?? null))) {
                // line 768
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["api"], "api_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["api"], "username", array());
                echo "</option>
                          ";
            } else {
                // line 770
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["api"], "api_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["api"], "username", array());
                echo "</option>
                          ";
            }
            // line 772
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['api'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 773
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 774
        echo ($context["help_api"] ?? null);
        echo "</small>
                    </div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-stock\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 780
        echo ($context["entry_stock_display"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 783
        if (($context["config_stock_display"] ?? null)) {
            // line 784
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_stock_display\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_stock_display\" value=\"0\"/> ";
            // line 785
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 787
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_stock_display\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_stock_display\" value=\"0\" checked=\"checked\"/> ";
            // line 788
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 790
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 791
        echo ($context["help_stock_display"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 795
        echo ($context["entry_stock_warning"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 798
        if (($context["config_stock_warning"] ?? null)) {
            // line 799
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_stock_warning\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_stock_warning\" value=\"0\"/> ";
            // line 800
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 802
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_stock_warning\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_stock_warning\" value=\"0\" checked=\"checked\"/> ";
            // line 803
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 805
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 806
        echo ($context["help_stock_warning"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 810
        echo ($context["entry_stock_checkout"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 813
        if (($context["config_stock_checkout"] ?? null)) {
            // line 814
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_stock_checkout\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_stock_checkout\" value=\"0\"/> ";
            // line 815
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 817
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_stock_checkout\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_stock_checkout\" value=\"0\" checked=\"checked\"/> ";
            // line 818
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 820
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 821
        echo ($context["help_stock_checkout"] ?? null);
        echo "</small>
                    </div>
                  </div>

                </div>
                <div class=\"tab-pane\" id=\"tab-affiliate\">

                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-affiliate-group\">";
        // line 829
        echo ($context["entry_affiliate_group"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_affiliate_group_id\" id=\"input-affiliate-group\" class=\"form-control\">
                        ";
        // line 832
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 833
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array()) == ($context["config_affiliate_group_id"] ?? null))) {
                // line 834
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", array());
                echo "</option>
                          ";
            } else {
                // line 836
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", array());
                echo "</option>
                          ";
            }
            // line 838
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 839
        echo "                      </select>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 843
        echo ($context["entry_affiliate_approval"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 846
        if (($context["config_affiliate_approval"] ?? null)) {
            // line 847
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_affiliate_approval\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_affiliate_approval\" value=\"0\"/> ";
            // line 848
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 850
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_affiliate_approval\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_affiliate_approval\" value=\"0\" checked=\"checked\"/> ";
            // line 851
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 853
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 854
        echo ($context["help_affiliate_approval"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 858
        echo ($context["entry_affiliate_auto"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                        ";
        // line 861
        if (($context["config_affiliate_auto"] ?? null)) {
            // line 862
            echo "                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_affiliate_auto\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_affiliate_auto\" value=\"0\"/> ";
            // line 863
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        } else {
            // line 865
            echo "                          <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_affiliate_auto\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                          <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_affiliate_auto\" value=\"0\" checked=\"checked\"/> ";
            // line 866
            echo ($context["text_no"] ?? null);
            echo "</label>
                        ";
        }
        // line 868
        echo "                      </div>
                      <small class=\"form-text text-muted\">";
        // line 869
        echo ($context["help_affiliate_auto"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-affiliate-commission\">";
        // line 873
        echo ($context["entry_affiliate_commission"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"config_affiliate_commission\" value=\"";
        // line 875
        echo ($context["config_affiliate_commission"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_affiliate_commission"] ?? null);
        echo "\" id=\"input-affiliate-commission\" class=\"form-control\"/>
                      <small class=\"form-text text-muted\">";
        // line 876
        echo ($context["help_affiliate_commission"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-affiliate\">";
        // line 880
        echo ($context["entry_affiliate"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_affiliate_id\" id=\"input-affiliate\" class=\"form-control\">
                        <option value=\"0\">";
        // line 883
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 884
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 885
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array()) == ($context["config_affiliate_id"] ?? null))) {
                // line 886
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            } else {
                // line 888
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            }
            // line 890
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 891
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 892
        echo ($context["help_affiliate"] ?? null);
        echo "</small>
                    </div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-return\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-return\">";
        // line 898
        echo ($context["entry_return"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_return_id\" id=\"input-return\" class=\"form-control\">
                        <option value=\"0\">";
        // line 901
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 902
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 903
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array()) == ($context["config_return_id"] ?? null))) {
                // line 904
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            } else {
                // line 906
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", array());
                echo "</option>
                          ";
            }
            // line 908
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 909
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 910
        echo ($context["help_return"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\" for=\"input-return-status\">";
        // line 914
        echo ($context["entry_return_status"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_return_status_id\" id=\"input-return-status\" class=\"form-control\">
                        ";
        // line 917
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["return_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["return_status"]) {
            // line 918
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["return_status"], "return_status_id", array()) == ($context["config_return_status_id"] ?? null))) {
                // line 919
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "return_status_id", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "name", array());
                echo "</option>
                          ";
            } else {
                // line 921
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "return_status_id", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "name", array());
                echo "</option>
                          ";
            }
            // line 923
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['return_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 924
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 925
        echo ($context["help_return_status"] ?? null);
        echo "</small>
                    </div>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-captcha\">
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 931
        echo ($context["entry_captcha"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <select name=\"config_captcha\" id=\"input-captcha\" class=\"form-control\">
                        <option value=\"\">";
        // line 934
        echo ($context["text_none"] ?? null);
        echo "</option>
                        ";
        // line 935
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["captchas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["captcha"]) {
            // line 936
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->source, $context["captcha"], "value", array()) == ($context["config_captcha"] ?? null))) {
                // line 937
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "value", array());
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "text", array());
                echo "</option>
                          ";
            } else {
                // line 939
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "value", array());
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "text", array());
                echo "</option>
                          ";
            }
            // line 941
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['captcha'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 942
        echo "                      </select>
                      <small class=\"form-text text-muted\">";
        // line 943
        echo ($context["help_captcha"] ?? null);
        echo "</small>
                    </div>
                  </div>
                  <div class=\"form-group row\">
                    <label class=\"col-sm-2 col-form-label\">";
        // line 947
        echo ($context["entry_captcha_page"] ?? null);
        echo "</label>
                    <div class=\"col-sm-10\">
                      <div class=\"form-control\" style=\"height: 150px; overflow: auto;\">
                        ";
        // line 950
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["captcha_pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["captcha_page"]) {
            // line 951
            echo "                          <label class=\"form-check\">
                            ";
            // line 952
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["captcha_page"], "value", array()), ($context["config_captcha_page"] ?? null))) {
                // line 953
                echo "                              <input type=\"checkbox\" name=\"config_captcha_page[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "value", array());
                echo "\" checked=\"checked\" class=\"form-check-input\"/>
                              ";
                // line 954
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "text", array());
                echo "
                            ";
            } else {
                // line 956
                echo "                              <input type=\"checkbox\" name=\"config_captcha_page[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "value", array());
                echo "\" class=\"form-check-input\"/>
                              ";
                // line 957
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "text", array());
                echo "
                            ";
            }
            // line 959
            echo "                          </label>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['captcha_page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 961
        echo "                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-image\">
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-logo\">";
        // line 969
        echo ($context["entry_logo"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"card image\">
                    <img src=\"";
        // line 972
        echo ($context["logo"] ?? null);
        echo "\" alt=\"\" title=\"\" id=\"thumb-logo\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" class=\"card-img-top\"/> <input type=\"hidden\" name=\"config_logo\" value=\"";
        echo ($context["config_logo"] ?? null);
        echo "\" id=\"input-logo\"/>
                    <div class=\"card-body\">
                      <button type=\"button\" data-toggle=\"image\" data-target=\"#input-logo\" data-thumb=\"#thumb-logo\" class=\"btn btn-primary btn-sm btn-block\"><i class=\"fas fa-pencil-alt\"></i> ";
        // line 974
        echo ($context["button_edit"] ?? null);
        echo "</button>
                      <button type=\"button\" data-toggle=\"clear\" data-target=\"#input-logo\" data-thumb=\"#thumb-logo\" class=\"btn btn-warning btn-sm btn-block\"><i class=\"fas fa-trash-alt\"></i> ";
        // line 975
        echo ($context["button_clear"] ?? null);
        echo "</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\" for=\"input-icon\">";
        // line 981
        echo ($context["entry_icon"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"card image\">
                    <img src=\"";
        // line 984
        echo ($context["icon"] ?? null);
        echo "\" alt=\"\" title=\"\" id=\"thumb-icon\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" class=\"card-img-top\"/> <input type=\"hidden\" name=\"config_icon\" value=\"";
        echo ($context["config_icon"] ?? null);
        echo "\" id=\"input-icon\"/>
                    <div class=\"card-body\">
                      <button type=\"button\" data-toggle=\"image\" data-target=\"#input-icon\" data-thumb=\"#thumb-icon\" class=\"btn btn-primary btn-sm btn-block\"><i class=\"fas fa-pencil-alt\"></i> ";
        // line 986
        echo ($context["button_edit"] ?? null);
        echo "</button>
                      <button type=\"button\" data-toggle=\"clear\" data-target=\"#input-icon\" data-thumb=\"#thumb-icon\" class=\"btn btn-warning btn-sm btn-block\"><i class=\"fas fa-trash-alt\"></i> ";
        // line 987
        echo ($context["button_clear"] ?? null);
        echo "</button>
                    </div>
                  </div>
                  <small class=\"form-text text-muted\">";
        // line 990
        echo ($context["help_icon"] ?? null);
        echo "</small>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-mail\">
              <fieldset>
                <legend>";
        // line 996
        echo ($context["text_general"] ?? null);
        echo "</legend>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-engine\">";
        // line 998
        echo ($context["entry_mail_engine"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_mail_engine\" id=\"input-mail-engine\" class=\"form-control\">
                      ";
        // line 1001
        if ((($context["config_mail_engine"] ?? null) == "mail")) {
            // line 1002
            echo "                        <option value=\"mail\" selected=\"selected\">";
            echo ($context["text_mail"] ?? null);
            echo "</option>
                      ";
        } else {
            // line 1004
            echo "                        <option value=\"mail\">";
            echo ($context["text_mail"] ?? null);
            echo "</option>
                      ";
        }
        // line 1006
        echo "                      ";
        if ((($context["config_mail_engine"] ?? null) == "smtp")) {
            // line 1007
            echo "                        <option value=\"smtp\" selected=\"selected\">";
            echo ($context["text_smtp"] ?? null);
            echo "</option>
                      ";
        } else {
            // line 1009
            echo "                        <option value=\"smtp\">";
            echo ($context["text_smtp"] ?? null);
            echo "</option>
                      ";
        }
        // line 1011
        echo "                    </select>
                    <small class=\"form-text text-muted\">";
        // line 1012
        echo ($context["help_mail_engine"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-parameter\">";
        // line 1016
        echo ($context["entry_mail_parameter"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_parameter\" value=\"";
        // line 1018
        echo ($context["config_mail_parameter"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_parameter"] ?? null);
        echo "\" id=\"input-mail-parameter\" class=\"form-control\"/>
                    <small class=\"form-text text-muted\">";
        // line 1019
        echo ($context["help_mail_parameter"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-smtp-hostname\">";
        // line 1023
        echo ($context["entry_mail_smtp_hostname"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_hostname\" value=\"";
        // line 1025
        echo ($context["config_mail_smtp_hostname"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_hostname"] ?? null);
        echo "\" id=\"input-mail-smtp-hostname\" class=\"form-control\"/>
                    <small class=\"form-text text-muted\">";
        // line 1026
        echo ($context["help_mail_smtp_hostname"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-smtp-username\">";
        // line 1030
        echo ($context["entry_mail_smtp_username"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_username\" value=\"";
        // line 1032
        echo ($context["config_mail_smtp_username"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_username"] ?? null);
        echo "\" id=\"input-mail-smtp-username\" class=\"form-control\"/>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-smtp-password\">";
        // line 1036
        echo ($context["entry_mail_smtp_password"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_password\" value=\"";
        // line 1038
        echo ($context["config_mail_smtp_password"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_password"] ?? null);
        echo "\" id=\"input-mail-smtp-password\" class=\"form-control\"/>
                    <small class=\"form-text text-muted\">";
        // line 1039
        echo ($context["help_mail_smtp_password"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-smtp-port\">";
        // line 1043
        echo ($context["entry_mail_smtp_port"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_port\" value=\"";
        // line 1045
        echo ($context["config_mail_smtp_port"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_port"] ?? null);
        echo "\" id=\"input-mail-smtp-port\" class=\"form-control\"/>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-smtp-timeout\">";
        // line 1049
        echo ($context["entry_mail_smtp_timeout"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_timeout\" value=\"";
        // line 1051
        echo ($context["config_mail_smtp_timeout"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_timeout"] ?? null);
        echo "\" id=\"input-mail-smtp-timeout\" class=\"form-control\"/>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1056
        echo ($context["text_mail_alert"] ?? null);
        echo "</legend>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
        // line 1058
        echo ($context["entry_mail_alert"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"form-control\" style=\"height: 150px; overflow: auto;\">
                      ";
        // line 1061
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["mail_alerts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["mail_alert"]) {
            // line 1062
            echo "                        <label class=\"form-check\">
                          ";
            // line 1063
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["mail_alert"], "value", array()), ($context["config_mail_alert"] ?? null))) {
                // line 1064
                echo "                            <input type=\"checkbox\" name=\"config_mail_alert[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "value", array());
                echo "\" checked=\"checked\" class=\"form-check-input\"/>
                            ";
                // line 1065
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "text", array());
                echo "
                          ";
            } else {
                // line 1067
                echo "                            <input type=\"checkbox\" name=\"config_mail_alert[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "value", array());
                echo "\" class=\"form-check-input\"/>
                            ";
                // line 1068
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "text", array());
                echo "
                          ";
            }
            // line 1070
            echo "                        </label>
                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mail_alert'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1072
        echo "                    </div>
                    <small class=\"form-text text-muted\">";
        // line 1073
        echo ($context["help_mail_alert"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-mail-alert-email\">";
        // line 1077
        echo ($context["entry_mail_alert_email"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_mail_alert_email\" rows=\"5\" placeholder=\"";
        // line 1079
        echo ($context["entry_mail_alert_email"] ?? null);
        echo "\" id=\"input-alert-email\" class=\"form-control\">";
        echo ($context["config_mail_alert_email"] ?? null);
        echo "</textarea>
                    <small class=\"form-text text-muted\">";
        // line 1080
        echo ($context["help_mail_alert_email"] ?? null);
        echo "</small>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class=\"tab-pane\" id=\"tab-server\">
              <fieldset>
                <legend>";
        // line 1087
        echo ($context["text_general"] ?? null);
        echo "</legend>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
        // line 1089
        echo ($context["entry_maintenance"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                      ";
        // line 1092
        if (($context["config_maintenance"] ?? null)) {
            // line 1093
            echo "                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_maintenance\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_maintenance\" value=\"0\"/> ";
            // line 1094
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        } else {
            // line 1096
            echo "                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_maintenance\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_maintenance\" value=\"0\" checked=\"checked\"/> ";
            // line 1097
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        }
        // line 1099
        echo "                    </div>
                    <small class=\"form-text text-muted\">";
        // line 1100
        echo ($context["help_maintenance"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
        // line 1104
        echo ($context["entry_seo_url"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                      ";
        // line 1107
        if (($context["config_seo_url"] ?? null)) {
            // line 1108
            echo "                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_seo_url\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_seo_url\" value=\"0\"/> ";
            // line 1109
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        } else {
            // line 1111
            echo "                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_seo_url\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_seo_url\" value=\"0\" checked=\"checked\"/> ";
            // line 1112
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        }
        // line 1114
        echo "                    </div>
                    <small class=\"form-text text-muted\">";
        // line 1115
        echo ($context["help_seo_url"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-robots\">";
        // line 1119
        echo ($context["entry_robots"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_robots\" rows=\"5\" placeholder=\"";
        // line 1121
        echo ($context["entry_robots"] ?? null);
        echo "\" id=\"input-robots\" class=\"form-control\">";
        echo ($context["config_robots"] ?? null);
        echo "</textarea>
                    <small class=\"form-text text-muted\">";
        // line 1122
        echo ($context["help_robots"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-compression\">";
        // line 1126
        echo ($context["entry_compression"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_compression\" value=\"";
        // line 1128
        echo ($context["config_compression"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_compression"] ?? null);
        echo "\" id=\"input-compression\" class=\"form-control\"/>
                    <small class=\"form-text text-muted\">";
        // line 1129
        echo ($context["help_compression"] ?? null);
        echo "</small>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1134
        echo ($context["text_security"] ?? null);
        echo "</legend>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
        // line 1136
        echo ($context["entry_password"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                      ";
        // line 1139
        if (($context["config_password"] ?? null)) {
            // line 1140
            echo "                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_password\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_password\" value=\"0\"/> ";
            // line 1141
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        } else {
            // line 1143
            echo "                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_password\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_password\" value=\"0\" checked=\"checked\"/> ";
            // line 1144
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        }
        // line 1146
        echo "                    </div>
                    <small class=\"form-text text-muted\">";
        // line 1147
        echo ($context["help_password"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
        // line 1151
        echo ($context["entry_shared"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                      ";
        // line 1154
        if (($context["config_shared"] ?? null)) {
            // line 1155
            echo "                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_shared\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_shared\" value=\"0\"/> ";
            // line 1156
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        } else {
            // line 1158
            echo "                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_shared\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_shared\" value=\"0\" checked=\"checked\"/> ";
            // line 1159
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        }
        // line 1161
        echo "                    </div>
                    <small class=\"form-text text-muted\">";
        // line 1162
        echo ($context["help_shared"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-encryption\">";
        // line 1166
        echo ($context["entry_encryption"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_encryption\" rows=\"5\" placeholder=\"";
        // line 1168
        echo ($context["entry_encryption"] ?? null);
        echo "\" id=\"input-encryption\" class=\"form-control\">";
        echo ($context["config_encryption"] ?? null);
        echo "</textarea>
                    <small class=\"form-text text-muted\">";
        // line 1169
        echo ($context["help_encryption"] ?? null);
        echo "</small>
                    ";
        // line 1170
        if (($context["error_encryption"] ?? null)) {
            // line 1171
            echo "                      <div class=\"invalid-tooltip\">";
            echo ($context["error_encryption"] ?? null);
            echo "</div>
                    ";
        }
        // line 1172
        echo "</div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1176
        echo ($context["text_upload"] ?? null);
        echo "</legend>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-file-max-size\">";
        // line 1178
        echo ($context["entry_file_max_size"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_file_max_size\" value=\"";
        // line 1180
        echo ($context["config_file_max_size"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_file_max_size"] ?? null);
        echo "\" id=\"input-file-max-size\" class=\"form-control\"/>
                    <small class=\"form-text text-muted\">";
        // line 1181
        echo ($context["help_file_max_size"] ?? null);
        echo "</small>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-file-ext-allowed\">";
        // line 1185
        echo ($context["entry_file_ext_allowed"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_file_ext_allowed\" rows=\"5\" placeholder=\"";
        // line 1187
        echo ($context["entry_file_ext_allowed"] ?? null);
        echo "\" id=\"input-file-ext-allowed\" class=\"form-control\">";
        echo ($context["config_file_ext_allowed"] ?? null);
        echo "</textarea>
                    <small class=\"form-text text-muted\">";
        // line 1188
        echo ($context["help_file_ext_allowed"] ?? null);
        echo "</small>
                    ";
        // line 1189
        if (($context["error_extension"] ?? null)) {
            // line 1190
            echo "                      <div class=\"invalid-tooltip\">";
            echo ($context["error_extension"] ?? null);
            echo "</div>
                    ";
        }
        // line 1192
        echo "                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-file-mime-allowed\">";
        // line 1195
        echo ($context["entry_file_mime_allowed"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_file_mime_allowed\" rows=\"5\" placeholder=\"";
        // line 1197
        echo ($context["entry_file_mime_allowed"] ?? null);
        echo "\" id=\"input-file-mime-allowed\" class=\"form-control\">";
        echo ($context["config_file_mime_allowed"] ?? null);
        echo "</textarea>
                    <small class=\"form-text text-muted\">";
        // line 1198
        echo ($context["help_file_mime_allowed"] ?? null);
        echo "</small>
                    ";
        // line 1199
        if (($context["error_mime"] ?? null)) {
            // line 1200
            echo "                      <div class=\"invalid-tooltip\">";
            echo ($context["error_mime"] ?? null);
            echo "</div>
                    ";
        }
        // line 1202
        echo "                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1206
        echo ($context["text_error"] ?? null);
        echo "</legend>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
        // line 1208
        echo ($context["entry_error_display"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                      ";
        // line 1211
        if (($context["config_error_display"] ?? null)) {
            // line 1212
            echo "                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_error_display\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_error_display\" value=\"0\"/> ";
            // line 1213
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        } else {
            // line 1215
            echo "                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_error_display\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_error_display\" value=\"0\" checked=\"checked\"/> ";
            // line 1216
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        }
        // line 1218
        echo "                    </div>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">";
        // line 1222
        echo ($context["entry_error_log"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                      ";
        // line 1225
        if (($context["config_error_log"] ?? null)) {
            // line 1226
            echo "                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_error_log\" value=\"1\" checked=\"checked\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_error_log\" value=\"0\"/> ";
            // line 1227
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        } else {
            // line 1229
            echo "                        <label class=\"btn btn-outline-secondary\"><input type=\"radio\" name=\"config_error_log\" value=\"1\"/> ";
            echo ($context["text_yes"] ?? null);
            echo "</label>
                        <label class=\"btn btn-outline-secondary active\"><input type=\"radio\" name=\"config_error_log\" value=\"0\" checked=\"checked\"/> ";
            // line 1230
            echo ($context["text_no"] ?? null);
            echo "</label>
                      ";
        }
        // line 1232
        echo "                    </div>
                  </div>
                </div>
                <div class=\"form-group row required\">
                  <label class=\"col-sm-2 col-form-label\" for=\"input-error-filename\">";
        // line 1236
        echo ($context["entry_error_filename"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_error_filename\" value=\"";
        // line 1238
        echo ($context["config_error_filename"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_error_filename"] ?? null);
        echo "\" id=\"input-error-filename\" class=\"form-control\"/>
                    ";
        // line 1239
        if (($context["error_log"] ?? null)) {
            // line 1240
            echo "                      <div class=\"invalid-tooltip\">";
            echo ($context["error_log"] ?? null);
            echo "</div>
                    ";
        }
        // line 1241
        echo "</div>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type=\"text/javascript\"><!--
\$('select[name=\\'config_theme\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=setting/setting/theme&user_token=";
        // line 1254
        echo ($context["user_token"] ?? null);
        echo "&theme=' + this.value,
\t\tdataType: 'html',
\t\tbeforeSend: function() {
\t\t\t\$('select[name=\\'config_theme\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('select[name=\\'config_theme\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(html) {
\t\t\t\$('#theme').attr('src', html);
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('select[name=\\'config_theme\\']').trigger('change');
//--></script>
<script type=\"text/javascript\"><!--
\$('select[name=\\'config_country_id\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=localisation/country/country&user_token=";
        // line 1276
        echo ($context["user_token"] ?? null);
        echo "&country_id=' + this.value,
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('select[name=\\'config_country_id\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('select[name=\\'config_country_id\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(json) {
\t\t\thtml = '<option value=\"\">";
        // line 1285
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\tif (json['zone'] && json['zone'] != '') {
\t\t\t\tfor (i = 0; i < json['zone'].length; i++) {
\t\t\t\t\thtml += '<option value=\"' + json['zone'][i]['zone_id'] + '\"';

\t\t\t\t\tif (json['zone'][i]['zone_id'] == '";
        // line 1291
        echo ($context["config_zone_id"] ?? null);
        echo "') {
\t\t\t\t\t\thtml += ' selected=\"selected\"';
\t\t\t\t\t}

\t\t\t\t\thtml += '>' + json['zone'][i]['name'] + '</option>';
\t\t\t\t}
\t\t\t} else {
\t\t\t\thtml += '<option value=\"0\" selected=\"selected\">";
        // line 1298
        echo ($context["text_none"] ?? null);
        echo "</option>';
\t\t\t}

\t\t\t\$('select[name=\\'config_zone_id\\']').html(html);

\t\t\t\$('#button-save').prop('disabled', false);
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('select[name=\\'config_country_id\\']').trigger('change');
//--></script>
";
        // line 1313
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "setting/setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  3425 => 1313,  3407 => 1298,  3397 => 1291,  3388 => 1285,  3376 => 1276,  3351 => 1254,  3336 => 1241,  3330 => 1240,  3328 => 1239,  3322 => 1238,  3317 => 1236,  3311 => 1232,  3306 => 1230,  3301 => 1229,  3296 => 1227,  3291 => 1226,  3289 => 1225,  3283 => 1222,  3277 => 1218,  3272 => 1216,  3267 => 1215,  3262 => 1213,  3257 => 1212,  3255 => 1211,  3249 => 1208,  3244 => 1206,  3238 => 1202,  3232 => 1200,  3230 => 1199,  3226 => 1198,  3220 => 1197,  3215 => 1195,  3210 => 1192,  3204 => 1190,  3202 => 1189,  3198 => 1188,  3192 => 1187,  3187 => 1185,  3180 => 1181,  3174 => 1180,  3169 => 1178,  3164 => 1176,  3158 => 1172,  3152 => 1171,  3150 => 1170,  3146 => 1169,  3140 => 1168,  3135 => 1166,  3128 => 1162,  3125 => 1161,  3120 => 1159,  3115 => 1158,  3110 => 1156,  3105 => 1155,  3103 => 1154,  3097 => 1151,  3090 => 1147,  3087 => 1146,  3082 => 1144,  3077 => 1143,  3072 => 1141,  3067 => 1140,  3065 => 1139,  3059 => 1136,  3054 => 1134,  3046 => 1129,  3040 => 1128,  3035 => 1126,  3028 => 1122,  3022 => 1121,  3017 => 1119,  3010 => 1115,  3007 => 1114,  3002 => 1112,  2997 => 1111,  2992 => 1109,  2987 => 1108,  2985 => 1107,  2979 => 1104,  2972 => 1100,  2969 => 1099,  2964 => 1097,  2959 => 1096,  2954 => 1094,  2949 => 1093,  2947 => 1092,  2941 => 1089,  2936 => 1087,  2926 => 1080,  2920 => 1079,  2915 => 1077,  2908 => 1073,  2905 => 1072,  2898 => 1070,  2893 => 1068,  2888 => 1067,  2883 => 1065,  2878 => 1064,  2876 => 1063,  2873 => 1062,  2869 => 1061,  2863 => 1058,  2858 => 1056,  2848 => 1051,  2843 => 1049,  2834 => 1045,  2829 => 1043,  2822 => 1039,  2816 => 1038,  2811 => 1036,  2802 => 1032,  2797 => 1030,  2790 => 1026,  2784 => 1025,  2779 => 1023,  2772 => 1019,  2766 => 1018,  2761 => 1016,  2754 => 1012,  2751 => 1011,  2745 => 1009,  2739 => 1007,  2736 => 1006,  2730 => 1004,  2724 => 1002,  2722 => 1001,  2716 => 998,  2711 => 996,  2702 => 990,  2696 => 987,  2692 => 986,  2683 => 984,  2677 => 981,  2668 => 975,  2664 => 974,  2655 => 972,  2649 => 969,  2639 => 961,  2632 => 959,  2627 => 957,  2622 => 956,  2617 => 954,  2612 => 953,  2610 => 952,  2607 => 951,  2603 => 950,  2597 => 947,  2590 => 943,  2587 => 942,  2581 => 941,  2573 => 939,  2565 => 937,  2562 => 936,  2558 => 935,  2554 => 934,  2548 => 931,  2539 => 925,  2536 => 924,  2530 => 923,  2522 => 921,  2514 => 919,  2511 => 918,  2507 => 917,  2501 => 914,  2494 => 910,  2491 => 909,  2485 => 908,  2477 => 906,  2469 => 904,  2466 => 903,  2462 => 902,  2458 => 901,  2452 => 898,  2443 => 892,  2440 => 891,  2434 => 890,  2426 => 888,  2418 => 886,  2415 => 885,  2411 => 884,  2407 => 883,  2401 => 880,  2394 => 876,  2388 => 875,  2383 => 873,  2376 => 869,  2373 => 868,  2368 => 866,  2363 => 865,  2358 => 863,  2353 => 862,  2351 => 861,  2345 => 858,  2338 => 854,  2335 => 853,  2330 => 851,  2325 => 850,  2320 => 848,  2315 => 847,  2313 => 846,  2307 => 843,  2301 => 839,  2295 => 838,  2287 => 836,  2279 => 834,  2276 => 833,  2272 => 832,  2266 => 829,  2255 => 821,  2252 => 820,  2247 => 818,  2242 => 817,  2237 => 815,  2232 => 814,  2230 => 813,  2224 => 810,  2217 => 806,  2214 => 805,  2209 => 803,  2204 => 802,  2199 => 800,  2194 => 799,  2192 => 798,  2186 => 795,  2179 => 791,  2176 => 790,  2171 => 788,  2166 => 787,  2161 => 785,  2156 => 784,  2154 => 783,  2148 => 780,  2139 => 774,  2136 => 773,  2130 => 772,  2122 => 770,  2114 => 768,  2111 => 767,  2107 => 766,  2103 => 765,  2097 => 762,  2090 => 758,  2087 => 757,  2081 => 756,  2073 => 754,  2065 => 752,  2062 => 751,  2058 => 750,  2052 => 747,  2047 => 744,  2041 => 743,  2039 => 742,  2035 => 741,  2032 => 740,  2025 => 738,  2020 => 736,  2015 => 735,  2010 => 733,  2005 => 732,  2003 => 731,  2000 => 730,  1996 => 729,  1990 => 726,  1985 => 723,  1979 => 721,  1977 => 720,  1973 => 719,  1970 => 718,  1963 => 716,  1958 => 714,  1953 => 713,  1948 => 711,  1943 => 710,  1940 => 709,  1936 => 708,  1930 => 705,  1923 => 701,  1920 => 700,  1914 => 699,  1906 => 697,  1898 => 695,  1895 => 694,  1891 => 693,  1885 => 690,  1878 => 686,  1875 => 685,  1869 => 684,  1861 => 682,  1853 => 680,  1850 => 679,  1846 => 678,  1842 => 677,  1836 => 674,  1829 => 670,  1826 => 669,  1821 => 667,  1816 => 666,  1811 => 664,  1806 => 663,  1804 => 662,  1798 => 659,  1791 => 655,  1788 => 654,  1783 => 652,  1778 => 651,  1773 => 649,  1768 => 648,  1766 => 647,  1760 => 644,  1753 => 640,  1747 => 639,  1742 => 637,  1733 => 631,  1730 => 630,  1724 => 629,  1716 => 627,  1708 => 625,  1705 => 624,  1701 => 623,  1697 => 622,  1691 => 619,  1686 => 616,  1680 => 615,  1678 => 614,  1674 => 613,  1668 => 612,  1663 => 610,  1656 => 606,  1653 => 605,  1648 => 603,  1643 => 602,  1638 => 600,  1633 => 599,  1631 => 598,  1625 => 595,  1620 => 592,  1614 => 591,  1612 => 590,  1608 => 589,  1605 => 588,  1598 => 586,  1593 => 585,  1588 => 584,  1583 => 582,  1578 => 581,  1575 => 580,  1571 => 579,  1565 => 576,  1558 => 572,  1555 => 571,  1549 => 570,  1541 => 568,  1533 => 566,  1530 => 565,  1526 => 564,  1520 => 561,  1514 => 557,  1509 => 555,  1504 => 554,  1499 => 552,  1494 => 551,  1492 => 550,  1486 => 547,  1479 => 543,  1476 => 542,  1471 => 540,  1466 => 539,  1461 => 537,  1456 => 536,  1454 => 535,  1448 => 532,  1441 => 528,  1438 => 527,  1433 => 525,  1428 => 524,  1423 => 522,  1418 => 521,  1416 => 520,  1410 => 517,  1401 => 511,  1398 => 510,  1392 => 508,  1386 => 506,  1383 => 505,  1377 => 503,  1371 => 501,  1369 => 500,  1365 => 499,  1359 => 496,  1352 => 492,  1349 => 491,  1343 => 489,  1337 => 487,  1334 => 486,  1328 => 484,  1322 => 482,  1320 => 481,  1316 => 480,  1310 => 477,  1304 => 473,  1299 => 471,  1294 => 470,  1289 => 468,  1284 => 467,  1282 => 466,  1276 => 463,  1267 => 457,  1261 => 456,  1256 => 454,  1249 => 450,  1246 => 449,  1241 => 447,  1236 => 446,  1231 => 444,  1226 => 443,  1224 => 442,  1218 => 439,  1211 => 435,  1208 => 434,  1203 => 432,  1198 => 431,  1193 => 429,  1188 => 428,  1186 => 427,  1180 => 424,  1173 => 419,  1167 => 418,  1165 => 417,  1161 => 416,  1155 => 415,  1150 => 413,  1145 => 410,  1139 => 409,  1137 => 408,  1133 => 407,  1127 => 406,  1122 => 404,  1113 => 398,  1110 => 397,  1105 => 395,  1100 => 394,  1095 => 392,  1090 => 391,  1088 => 390,  1082 => 387,  1075 => 383,  1072 => 382,  1067 => 380,  1062 => 379,  1057 => 377,  1052 => 376,  1050 => 375,  1044 => 372,  1037 => 367,  1031 => 366,  1029 => 365,  1025 => 364,  1019 => 363,  1014 => 361,  1007 => 357,  1004 => 356,  999 => 354,  994 => 353,  989 => 351,  984 => 350,  982 => 349,  976 => 346,  968 => 341,  964 => 340,  960 => 339,  956 => 338,  952 => 337,  948 => 336,  944 => 335,  940 => 334,  936 => 333,  932 => 332,  928 => 331,  920 => 325,  914 => 324,  906 => 322,  898 => 320,  895 => 319,  891 => 318,  885 => 315,  879 => 311,  873 => 310,  865 => 308,  857 => 306,  854 => 305,  850 => 304,  844 => 301,  837 => 297,  834 => 296,  829 => 294,  824 => 293,  819 => 291,  814 => 290,  812 => 289,  806 => 286,  800 => 282,  794 => 281,  786 => 279,  778 => 277,  775 => 276,  771 => 275,  765 => 272,  758 => 268,  755 => 267,  749 => 266,  741 => 264,  733 => 262,  730 => 261,  726 => 260,  720 => 257,  714 => 253,  708 => 252,  700 => 250,  692 => 248,  689 => 247,  685 => 246,  679 => 243,  673 => 239,  667 => 238,  659 => 236,  651 => 234,  648 => 233,  644 => 232,  638 => 229,  632 => 225,  626 => 224,  618 => 222,  610 => 220,  607 => 219,  603 => 218,  597 => 215,  588 => 209,  582 => 205,  576 => 204,  568 => 202,  560 => 200,  557 => 199,  553 => 198,  547 => 195,  542 => 192,  535 => 188,  532 => 187,  525 => 185,  520 => 183,  515 => 182,  510 => 180,  505 => 179,  503 => 178,  500 => 177,  496 => 176,  490 => 173,  487 => 172,  485 => 171,  479 => 168,  473 => 167,  468 => 165,  461 => 161,  455 => 160,  450 => 158,  441 => 152,  437 => 151,  428 => 149,  422 => 146,  413 => 142,  408 => 140,  403 => 137,  397 => 136,  395 => 135,  389 => 134,  384 => 132,  379 => 129,  373 => 128,  371 => 127,  365 => 126,  360 => 124,  353 => 120,  347 => 119,  342 => 117,  337 => 114,  331 => 113,  329 => 112,  323 => 111,  318 => 109,  313 => 106,  307 => 105,  305 => 104,  299 => 103,  294 => 101,  289 => 98,  283 => 97,  281 => 96,  275 => 95,  270 => 93,  262 => 87,  256 => 86,  248 => 84,  240 => 82,  237 => 81,  233 => 80,  227 => 77,  220 => 72,  214 => 71,  206 => 69,  198 => 67,  195 => 66,  191 => 65,  185 => 62,  176 => 58,  171 => 56,  162 => 52,  157 => 50,  152 => 47,  146 => 46,  144 => 45,  138 => 44,  133 => 42,  125 => 37,  121 => 36,  117 => 35,  113 => 34,  109 => 33,  105 => 32,  101 => 31,  96 => 29,  91 => 27,  88 => 26,  80 => 22,  77 => 21,  69 => 17,  67 => 16,  62 => 13,  51 => 11,  47 => 10,  42 => 8,  36 => 7,  32 => 6,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "setting/setting.twig", "F:\\wamp64\\www\\mycncart\\admin\\view\\template\\setting\\setting.twig");
    }
}
