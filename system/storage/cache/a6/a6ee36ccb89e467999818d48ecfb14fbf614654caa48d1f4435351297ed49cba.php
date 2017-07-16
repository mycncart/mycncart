<?php

/* common/security.twig */
class __TwigTemplate_d5014b05001c8aaa0eba9f28fae0ad7493170322ee5ab9a071a36f2c671dc52b extends Twig_Template
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
        echo "<div id=\"modal-security\" class=\"modal\">
  <div class=\"modal-dialog\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
        <h4 class=\"modal-title text-danger\"><i class=\"fa fa-exclamation-triangle\"></i> ";
        // line 6
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h4>
      </div>
      <div class=\"modal-body\">
        <div class=\"alert alert-info\"><i class=\"fa fa-exclamation-circle\"></i> ";
        // line 9
        echo (isset($context["text_security"]) ? $context["text_security"] : null);
        echo "</div>
        <form class=\"form-horizontal\">
          <fieldset>
            <legend>";
        // line 12
        echo (isset($context["text_choose"]) ? $context["text_choose"] : null);
        echo "</legend>
            <div class=\"form-group\">
              <select name=\"type\" id=\"input-type\" class=\"form-control\">
                <option value=\"automatic\">";
        // line 15
        echo (isset($context["text_automatic"]) ? $context["text_automatic"] : null);
        echo "</option>
                <option value=\"manual\">";
        // line 16
        echo (isset($context["text_manual"]) ? $context["text_manual"] : null);
        echo "</option>
              </select>
            </div>
          </fieldset>
          <fieldset id=\"collapse-automatic\" class=\"collapse\">
            <legend>";
        // line 21
        echo (isset($context["text_automatic"]) ? $context["text_automatic"] : null);
        echo "</legend>
            <div class=\"form-group\">
              <div class=\"input-group\">
                <div class=\"input-group-btn dropdown\">
                  <button type=\"button\" id=\"button-path\" data-toggle=\"dropdown\" class=\"btn btn-default\">";
        // line 25
        echo (isset($context["document_root"]) ? $context["document_root"] : null);
        echo " <span class=\"caret\"></span></button>
                  <ul class=\"dropdown-menu\">
                    ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["paths"]) ? $context["paths"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["path"]) {
            // line 28
            echo "                    ";
            if ((twig_length_filter($this->env, $context["path"]) > twig_length_filter($this->env, (isset($context["document_root"]) ? $context["document_root"] : null)))) {
                // line 29
                echo "                    <li><a href=\"";
                echo $context["path"];
                echo "\"><i class=\"fa fa-exclamation-triangle fa-fw text-danger\"></i> ";
                echo $context["path"];
                echo "</a></li>
                    ";
            } else {
                // line 31
                echo "                    <li><a href=\"";
                echo $context["path"];
                echo "\"><i class=\"fa fa-check-circle fa-fw text-success\"></i> ";
                echo $context["path"];
                echo "</a></li>
                    ";
            }
            // line 33
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['path'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "                  </ul>
                </div>
                <input type=\"text\" name=\"directory\" value=\"storage\" placeholder=\"";
        // line 36
        echo (isset($context["entry_directory"]) ? $context["entry_directory"] : null);
        echo "\" class=\"form-control\" />
                <div class=\"input-group-btn\">
                  <button type=\"button\" id=\"button-move\" data-loading-text=\"";
        // line 38
        echo (isset($context["text_loading"]) ? $context["text_loading"] : null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-exclamation-triangle\"></i> ";
        echo (isset($context["button_move"]) ? $context["button_move"] : null);
        echo "</button>
                </div>
              </div>
              <input type=\"hidden\" name=\"path\" value=\"";
        // line 41
        echo (isset($context["document_root"]) ? $context["document_root"] : null);
        echo "\" />
            </div>
          </fieldset>
          <fieldset id=\"collapse-manual\" class=\"collapse\">
            <legend>";
        // line 45
        echo (isset($context["text_manual"]) ? $context["text_manual"] : null);
        echo "</legend>
            <div class=\"form-group\">
              <div style=\"height: 300px; overflow-y: scroll;\" class=\"form-control\" disabled=\"disabled\"></div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<script type=\"text/javascript\"><!--
\$(document).ready(function() {
\t\$('#modal-security').modal('show');
});

\$('#modal-security select[name=\\'type\\']').on('change', function() {
\t\$('#modal-security fieldset.collapse').removeClass('in');
\t
\t\$('#modal-security #collapse-' + \$(this).val()).addClass('in');
});

\$('#modal-security select[name=\\'type\\']').trigger('change');

\$('#modal-security .dropdown-menu a').on('click', function(e) {
\te.preventDefault();
\t
\t\$('#modal-security #button-path').html(\$(this).html() + ' <span class=\"caret\"></span>');
\t
\t\$('#modal-security input[name=\\'path\\']').val(\$(this).attr('href'));
});


\$('#modal-security .dropdown-menu a').on('click', function(e) {
\te.preventDefault();
\t
\t\$('#button-path').html(\$(this).text() + ' <span class=\"caret\"></span>');
\t
\t\$('input[name=\\'path\\']').val(\$(this).attr('href'));
\t
\t\$('input[name=\\'path\\']').trigger('change');
});

\$('#button-move').on('click', function() {
\tvar element = this;
\t
\t\$.ajax({
\t\turl: 'index.php?route=common/security/move&user_token=";
        // line 91
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "',
\t\ttype: 'post',
\t\tdata: \$('input[name=\\'path\\'], input[name=\\'directory\\']'),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$(element).button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$(element).button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible').remove();

\t\t\tif (json['error']) {
\t\t\t\t\$('#modal-security .modal-body').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#modal-security .modal-body').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('#modal-security select[name=\\'type\\']').on('change', function () {
\thtml  = '<ol>';
\thtml += '<li><p>";
        // line 121
        echo (isset($context["text_move"]) ? $context["text_move"] : null);
        echo "</p>';
\thtml += '<p><strong>";
        // line 122
        echo (isset($context["storage"]) ? $context["storage"] : null);
        echo "</strong></p>';
\thtml += '<p>";
        // line 123
        echo (isset($context["text_to"]) ? $context["text_to"] : null);
        echo "</p>';
\thtml += '<p><strong>' + \$('#modal-security input[name=\\'path\\']').val() + \$('#modal-security input[name=\\'directory\\']').val() + '/</strong></p></li>';
\thtml += '<li><p>";
        // line 125
        echo (isset($context["text_config"]) ? $context["text_config"] : null);
        echo "</p>';
\thtml += '<p><strong>define(\\'DIR_STORAGE\\', DIR_SYSTEM . \\'storage/\\');</strong></p>';
\thtml += '<p>to</p>';
\thtml += '<p><strong>define(\\'DIR_STORAGE\\', \\'' + \$('#modal-security input[name=\\'path\\']').val() + \$('#modal-security input[name=\\'directory\\']').val() + '/\\');</strong></p></li>';
\thtml += '<li><p>";
        // line 129
        echo (isset($context["text_admin"]) ? $context["text_admin"] : null);
        echo "</p>';
\thtml += '<p><strong>define(\\'DIR_STORAGE\\', DIR_SYSTEM . \\'storage/\\');</strong></p>';
\thtml += '<p>to</p>';
\thtml += '<p><strong>define(\\'DIR_STORAGE\\', \\'' + \$('#modal-security input[name=\\'path\\']').val() + \$('#modal-security input[name=\\'directory\\']').val() + '/\\');</strong></p></li>';
\t
  \thtml += '</li>';
    html += '</ol>';
\t
\t\$('#collapse-manual .form-control').html(html);
});

\$('input[name=\\'path\\']').trigger('change');
//--></script>";
    }

    public function getTemplateName()
    {
        return "common/security.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  223 => 129,  216 => 125,  211 => 123,  207 => 122,  203 => 121,  170 => 91,  121 => 45,  114 => 41,  106 => 38,  101 => 36,  97 => 34,  91 => 33,  83 => 31,  75 => 29,  72 => 28,  68 => 27,  63 => 25,  56 => 21,  48 => 16,  44 => 15,  38 => 12,  32 => 9,  26 => 6,  19 => 1,);
    }
}
/* <div id="modal-security" class="modal">*/
/*   <div class="modal-dialog">*/
/*     <div class="modal-content">*/
/*       <div class="modal-header">*/
/*         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*         <h4 class="modal-title text-danger"><i class="fa fa-exclamation-triangle"></i> {{ heading_title }}</h4>*/
/*       </div>*/
/*       <div class="modal-body">*/
/*         <div class="alert alert-info"><i class="fa fa-exclamation-circle"></i> {{text_security }}</div>*/
/*         <form class="form-horizontal">*/
/*           <fieldset>*/
/*             <legend>{{ text_choose }}</legend>*/
/*             <div class="form-group">*/
/*               <select name="type" id="input-type" class="form-control">*/
/*                 <option value="automatic">{{ text_automatic }}</option>*/
/*                 <option value="manual">{{ text_manual }}</option>*/
/*               </select>*/
/*             </div>*/
/*           </fieldset>*/
/*           <fieldset id="collapse-automatic" class="collapse">*/
/*             <legend>{{ text_automatic }}</legend>*/
/*             <div class="form-group">*/
/*               <div class="input-group">*/
/*                 <div class="input-group-btn dropdown">*/
/*                   <button type="button" id="button-path" data-toggle="dropdown" class="btn btn-default">{{ document_root }} <span class="caret"></span></button>*/
/*                   <ul class="dropdown-menu">*/
/*                     {% for path in paths %}*/
/*                     {% if path|length > document_root|length %}*/
/*                     <li><a href="{{ path }}"><i class="fa fa-exclamation-triangle fa-fw text-danger"></i> {{ path }}</a></li>*/
/*                     {% else %}*/
/*                     <li><a href="{{ path }}"><i class="fa fa-check-circle fa-fw text-success"></i> {{ path }}</a></li>*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/*                   </ul>*/
/*                 </div>*/
/*                 <input type="text" name="directory" value="storage" placeholder="{{ entry_directory }}" class="form-control" />*/
/*                 <div class="input-group-btn">*/
/*                   <button type="button" id="button-move" data-loading-text="{{ text_loading }}" class="btn btn-danger"><i class="fa fa-exclamation-triangle"></i> {{ button_move }}</button>*/
/*                 </div>*/
/*               </div>*/
/*               <input type="hidden" name="path" value="{{ document_root }}" />*/
/*             </div>*/
/*           </fieldset>*/
/*           <fieldset id="collapse-manual" class="collapse">*/
/*             <legend>{{ text_manual }}</legend>*/
/*             <div class="form-group">*/
/*               <div style="height: 300px; overflow-y: scroll;" class="form-control" disabled="disabled"></div>*/
/*             </div>*/
/*           </fieldset>*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* <script type="text/javascript"><!--*/
/* $(document).ready(function() {*/
/* 	$('#modal-security').modal('show');*/
/* });*/
/* */
/* $('#modal-security select[name=\'type\']').on('change', function() {*/
/* 	$('#modal-security fieldset.collapse').removeClass('in');*/
/* 	*/
/* 	$('#modal-security #collapse-' + $(this).val()).addClass('in');*/
/* });*/
/* */
/* $('#modal-security select[name=\'type\']').trigger('change');*/
/* */
/* $('#modal-security .dropdown-menu a').on('click', function(e) {*/
/* 	e.preventDefault();*/
/* 	*/
/* 	$('#modal-security #button-path').html($(this).html() + ' <span class="caret"></span>');*/
/* 	*/
/* 	$('#modal-security input[name=\'path\']').val($(this).attr('href'));*/
/* });*/
/* */
/* */
/* $('#modal-security .dropdown-menu a').on('click', function(e) {*/
/* 	e.preventDefault();*/
/* 	*/
/* 	$('#button-path').html($(this).text() + ' <span class="caret"></span>');*/
/* 	*/
/* 	$('input[name=\'path\']').val($(this).attr('href'));*/
/* 	*/
/* 	$('input[name=\'path\']').trigger('change');*/
/* });*/
/* */
/* $('#button-move').on('click', function() {*/
/* 	var element = this;*/
/* 	*/
/* 	$.ajax({*/
/* 		url: 'index.php?route=common/security/move&user_token={{ user_token }}',*/
/* 		type: 'post',*/
/* 		data: $('input[name=\'path\'], input[name=\'directory\']'),*/
/* 		dataType: 'json',*/
/* 		crossDomain: true,*/
/* 		beforeSend: function() {*/
/* 			$(element).button('loading');*/
/* 		},*/
/* 		complete: function() {*/
/* 			$(element).button('reset');*/
/* 		},*/
/* 		success: function(json) {*/
/* 			$('.alert-dismissible').remove();*/
/* */
/* 			if (json['error']) {*/
/* 				$('#modal-security .modal-body').prepend('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');*/
/* 			}*/
/* */
/* 			if (json['success']) {*/
/* 				$('#modal-security .modal-body').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');*/
/* 			}*/
/* 		},*/
/* 		error: function(xhr, ajaxOptions, thrownError) {*/
/* 			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);*/
/* 		}*/
/* 	});*/
/* });*/
/* */
/* $('#modal-security select[name=\'type\']').on('change', function () {*/
/* 	html  = '<ol>';*/
/* 	html += '<li><p>{{ text_move }}</p>';*/
/* 	html += '<p><strong>{{ storage }}</strong></p>';*/
/* 	html += '<p>{{ text_to }}</p>';*/
/* 	html += '<p><strong>' + $('#modal-security input[name=\'path\']').val() + $('#modal-security input[name=\'directory\']').val() + '/</strong></p></li>';*/
/* 	html += '<li><p>{{ text_config }}</p>';*/
/* 	html += '<p><strong>define(\'DIR_STORAGE\', DIR_SYSTEM . \'storage/\');</strong></p>';*/
/* 	html += '<p>to</p>';*/
/* 	html += '<p><strong>define(\'DIR_STORAGE\', \'' + $('#modal-security input[name=\'path\']').val() + $('#modal-security input[name=\'directory\']').val() + '/\');</strong></p></li>';*/
/* 	html += '<li><p>{{ text_admin }}</p>';*/
/* 	html += '<p><strong>define(\'DIR_STORAGE\', DIR_SYSTEM . \'storage/\');</strong></p>';*/
/* 	html += '<p>to</p>';*/
/* 	html += '<p><strong>define(\'DIR_STORAGE\', \'' + $('#modal-security input[name=\'path\']').val() + $('#modal-security input[name=\'directory\']').val() + '/\');</strong></p></li>';*/
/* 	*/
/*   	html += '</li>';*/
/*     html += '</ol>';*/
/* 	*/
/* 	$('#collapse-manual .form-control').html(html);*/
/* });*/
/* */
/* $('input[name=\'path\']').trigger('change');*/
/* //--></script>*/
