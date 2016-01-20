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
      <?php if ($description) { ?>
      <div class="row">
        <div class="col-sm-10"><?php echo $description; ?></div>
      </div>
      <hr>
      <?php } ?>
      
      <?php if ($blogs) { ?>
      
        <?php foreach($blogs as $blog) { ?>
        <div class="row">
          
          <?php if($cms_blog_category_page_show_image) { ?>
            <?php if ($blog['thumb']) { ?>
            <div><img src="<?php echo $blog['thumb']; ?>" alt="<?php echo $blog['title']; ?>" title="<?php echo $blog['title']; ?>" class="img-thumbnail" /></div>
            <?php } ?>
          <?php } ?>
         
          
          <?php if($cms_blog_category_page_show_title) { ?>
          <h4><a href="<?php echo $blog['link'];?>" title="<?php echo $blog['title'];?>"><?php echo $blog['title']; ?></a></h4>
          <?php } ?>
          
          <div>
		
		  	<?php if( $cms_blog_category_page_show_author ) { ?>
			<span><i class="fa fa-pencil"></i> <b><?php echo $text_written_by; ?></b> <?php echo $blog['author']; ?></span> 
			<?php } ?>
			
			<?php if( $cms_blog_category_page_show_created_date ) { ?>
			<span><i class="fa fa-calendar"></i> <b><?php echo $text_created_date; ?></b> <?php echo $blog['created']; ?></span> 
			<?php } ?>
			
			<?php if( $cms_blog_category_page_show_category ) { ?>
			<span><i class="fa fa-thumb-tack"></i> 
				<b><?php echo $text_published_in; ?></b>
				<a class="color" href="<?php echo $blog['category_link'];?>" title="<?php echo $blog['category_title'];?>"><?php echo $blog['category_title']; ?></a> 
			</span>
			<?php } ?>	
			

			
			
			<?php if( $cms_blog_category_page_show_hits ) { ?>
			<span><i class="fa fa-insert-template"></i> <b><?php echo $text_hits; ?></b> <?php echo $blog['hits']; ?> </span>
			<?php } ?>		
			

			
			<?php if( $cms_blog_category_page_show_comment_counter ) { ?>
			<span><i class="fa fa-comment"></i> <b><?php echo $text_comment_count; ?></b> <?php echo $blog['comment_count']; ?> </span>
			<?php } ?>	
			
		
	</div>
          
          <?php if($cms_blog_category_page_show_brief) { ?>
            <?php if ($blog['brief']) { ?>
            <div><?php echo $blog['brief']; ?></div>
            <?php } ?>
          <?php } ?>
          
          
        </div>
        <hr>
        <?php } ?>
      
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
