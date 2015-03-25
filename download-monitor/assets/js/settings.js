jQuery( function ( $ ) {
    $( '.nav-tab-wrapper a' ).click( function () {
        $( '.settings_panel' ).hide();
        $( '.nav-tab-active' ).removeClass( 'nav-tab-active' );
        $( $( this ).attr( 'href' ) ).show();
        $( this ).addClass( 'nav-tab-active' );
        return false;
    } );
    $( '#setting-dlm_default_template' ).change( function () {
        if ( $( this ).val() == 'custom' ) {
            $( '#setting-dlm_custom_template' ).closest( 'tr' ).show();
        } else {
            $( '#setting-dlm_custom_template' ).closest( 'tr' ).hide();
        }
    } ).change();

    $( '.nav-tab-wrapper a:first' ).click();
} );