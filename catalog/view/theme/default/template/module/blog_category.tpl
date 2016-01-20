<div class="category box box-highlights">
    <div class="box-heading"><span><?php echo $heading_title; ?></span></div>
    <div class="box-content tree-menu" id="pav-categorymenu">
            <?php echo $tree;?>
    </div>
</div>
<script>
    $(document).ready(function(){
// applying the settings
        $("#pav-categorymenu li .head").empty().html('<a class="badge">+</a>');
        $("#pav-categorymenu li.active span.head").addClass("accordion-heading");
        $('#pav-categorymenu ul').Accordion({
            active: 'span.accordion-heading',
            header: 'span.head',
            alwaysOpen: false,
            animated: true,
            showSpeed: 400,
            hideSpeed: 800,
            event: 'click'
        });
        $( ".pav-category .head" ).click(function(){
            $( ".pav-category .head .badge" ).html("-");
            $( ".pav-category .head.selected .badge" ).html("+");

        });
    });
</script>