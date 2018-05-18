$(document).ready(function() {

    /* =================================================================
        Default Table
    ================================================================= */

    $('#table-1').DataTable();
      
    /* =================================================================
       Exporting Table Data
    ================================================================= */

    $('#table-2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );

    /* =================================================================
       Table with Column Filtering
    ================================================================= */

    var $table3 = jQuery("#table-3");
    
    var table3 = $table3.DataTable( {
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
    
    // Setup - add a text input to each footer cell
    $( '#table-3 tfoot th' ).each( function () {
        var title = $('#table-3 thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search ' + title + '" />' );
    } );
    
    // Apply the search
    table3.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

});