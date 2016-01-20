<?php  echo $header; ?>
<?php require( ThemeControlHelper::getLayoutPath( 'common/mass-header.tpl' )  ); ?>

<div class="main-columns container space-20">
<div class="container-inside">
	<div class="row">
		<?php if( $SPAN[0] ): ?>
		<aside id="sidebar-left" class="col-md-<?php echo $SPAN[0];?>">
		  <?php echo $column_left; ?>
		</aside>	
	    <?php endif; ?> 
		<div class="col-md-<?php echo $SPAN[1];?>"><div id="content" class="bg-white page-pavblog">
		
		<?php echo $content_top; ?>
		<h1><?php echo $heading_title; ?></h1>
		<!-- Start Div Content -->
		<div class="pav-header text-right">
			<a href="<?php echo $latest_rss;?>"><span class="fa fa-rss text-warning"></span></a>	
		</div>
		<div class="pav-filter-blogs">
			<div class="pav-blogs">
				<?php $cols = $cat_columns_leading_blogs;

				if( count($leading_blogs) ) { ?>
					<div class="leading-blogs clearfix">
						<?php foreach( $leading_blogs as $key => $blog ) { $key = $key + 1;?>
						<div class="pavcol<?php echo $cols;?>">
						<?php require( '_item.tpl' ); ?>
						</div>
						<?php if( ( $key%$cols==0 || $cols == count($leading_blogs)) ){ ?>
							<div class="clearfix"></div>
						<?php } ?>
						<?php } ?>
					</div>
				<?php } ?>
				<?php
					$cols = $cat_columns_secondary_blogs;
					$cols = !empty($cols)?$cols:1;
					if ( count($secondary_blogs) ) { ?>
					<div class="secondary clearfix">
						
						<?php foreach( $secondary_blogs as $key => $blog ) {  $key = $key+1; ?>
						<div class="pavcol<?php echo $cols;?>">
						<?php require( '_item.tpl' ); ?>
						</div>
						<?php if( ( $key%$cols==0 || $cols == count($leading_blogs)) ){ ?>
							<div class="clearfix"></div>
						<?php } ?>
						<?php } ?>
					</div>
				<?php } ?>
					
				<div class="pav-pagination pagination space-top-30"><?php echo $pagination;?></div>
			</div>
		</div>
		<!-- End Div Content -->
		<?php echo $content_bottom; ?></div>
	</div>
		<!-- End Div Row -->
		<?php if( $SPAN[2] ): ?>
		<aside id="sidebar-right" class="col-md-<?php echo $SPAN[2];?>">	
		<?php echo $column_right; ?>
		</aside>
	<?php endif; ?>
	</div>
</div>
</div><!-- End Div Container -->
<?php echo $footer; ?>