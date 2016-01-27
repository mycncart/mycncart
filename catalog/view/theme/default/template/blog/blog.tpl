<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    
      <?php if($cms_blog_show_image) { ?>
        <?php if ($thumb) { ?>
        <div><img src="<?php echo $thumb; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" class="img-thumbnail" /></div>
        <?php } ?>
      <?php } ?>
          
      <h1><?php echo $title; ?></h1>
      
      <div>
		
		  	<?php if( $cms_blog_show_author ) { ?>
			<span><i class="fa fa-pencil"></i> <b><?php echo $text_written_by; ?></b> <?php echo $author; ?></span> 
			<?php } ?>
			
			<?php if( $cms_blog_show_created_date ) { ?>
			<span><i class="fa fa-calendar"></i> <b><?php echo $text_created_date; ?></b> <?php echo $created; ?></span> 
			<?php } ?>
			
			
			<?php if( $cms_blog_show_hits ) { ?>
			<span><i class="fa fa-insert-template"></i> <b><?php echo $text_hits; ?></b> <?php echo $hits; ?> </span>
			<?php } ?>		
			

			
			<?php if( $cms_blog_show_comment_counter ) { ?>
			<span><i class="fa fa-comment"></i> <b><?php echo $text_comment_count; ?></b> <?php echo $comment_count; ?> </span>
			<?php } ?>	
			
		
		  </div>
          
      <?php echo $description; ?>
      <hr>
      
      <?php if ($comment_status) { ?>
        
          <form class="form-horizontal" id="form-comment">
            <div id="comment"></div>
            <h2><?php echo $text_write; ?></h2>
            <?php if ($comment_guest) { ?>
            <div class="form-group required">
              <div class="col-sm-12">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="name" value="" id="input-name" class="form-control" />
              </div>
            </div>
            <div class="form-group required">
              <div class="col-sm-12">
                <label class="control-label" for="input-comment"><?php echo $entry_comment; ?></label>
                <textarea name="text" rows="5" id="input-comment" class="form-control"></textarea>
                <div class="help-block"><?php echo $text_note; ?></div>
              </div>
            </div>
            <?php echo $captcha; ?>
            <div class="buttons clearfix">
              <div class="pull-right">
                <button type="button" id="button-comment" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
              </div>
            </div>
            <?php } else { ?>
            <?php echo $text_login; ?>
            <?php } ?>
          </form>
        
      <?php } ?>
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('#comment').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#comment').fadeOut('slow');

    $('#comment').load(this.href);

    $('#comment').fadeIn('slow');
});

$('#comment').load('index.php?route=blog/blog/comment&blog_id=<?php echo $blog_id; ?>');

$('#button-comment').on('click', function() {
	$.ajax({
		url: 'index.php?route=blog/blog/write&blog_id=<?php echo $blog_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-comment").serialize(),
		beforeSend: function() {
			$('#button-comment').button('loading');
		},
		complete: function() {
			$('#button-comment').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#comment').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#comment').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
			}
		}
	});
});

//--></script>
<?php echo $footer; ?> 