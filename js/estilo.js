$().ready(()=>{
    //Comportamiento para control deslizante
    $( "#precio" ).slider({
        range: "max",
        min: 1,
        max: 85,
        value: 20,
        slide: function( event, ui ) {
            $( "#txtPrecio" ).val( ui.value );
        }
    });
    $("#txtPrecio").val( $( "#precio" ).slider( "value" ));
    $("#txtPrecio").css({
        "border":"0", 
        "color":"#003153", 
        "background-color":$("section").css("background-color"),
        "font-weight":"bold"
    });
    
    //Aplicación de estilo a todos los controles (input)
    //de un tipo específico
    $( 'input[type="radio"]' ).checkboxradio();
    $( 'input[type="checkbox"]' ).checkboxradio();
});