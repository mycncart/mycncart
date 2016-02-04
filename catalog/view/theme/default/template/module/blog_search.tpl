<div class="row">
    <div class="col-sm-12">
        <form method="get" action="<?php echo $action; ?>"> 
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" name="filter_blog" type="text" value="<?php echo $filter_blog?>" placeholder="<?php $text_blog_search?>" />    
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>