$(document).ready(function(){
    $("#btnTabla").click(function(){
        var patTexto = $('#dropPat').find('option:selected').text();
        var patId = $('#dropPat').find('option:selected').val();
        var medTexto = $('#med-todo').find('option:selected').text();
        var medId = $('#med-todo').find('option:selected').val();
        //var medGrupo = $('#dropMed').find('option:selected').data('g');
        var medCant = $('#med-cant').val();
        var solicitudDosis = $('#solicitud-dosis').val();
        var solicitudFrecuencia = $('#solicitud-frecuencia').val();
        //var medHay = $('#dropMed').find('option:selected').data('hay') == 1 ? true : false;
        var medNvo = $("#med-nvo").val();
        var medNvoConc = $("#med-nvo-conc").val();

        if (patId == "" || medId == ""){
            alert("Debe seleccionar al menos un medicamento y patologia");
            return false;
        }
        else if (solicitudDosis == "" || isNaN(solicitudDosis) || solicitudDosis < 1 || solicitudDosis > 24){
            alert("Debe indicar el numero de la dosis.");
            return false;
        }
        else if (solicitudFrecuencia == "" || isNaN(solicitudFrecuencia) || solicitudFrecuencia < 1 || solicitudDosis > 24){
            alert("Debe indicar el numero de la frecuencia.");
            return false;
        }
        /*else if (medCant == "" || isNaN(medCant) || medCant < 1){
            alert("Debe indicar el numero de cajas solicitadas");
            return false;
        }*/

        if (medId == 0){
            if (medNvo == ""){
              alert("Debe indicar el nombre del nuevo medicamento");
              $("#med-nvo").focus();
              return false;
            }
            else if (medNvoConc == ""){
              alert("Debe indicar la concentracion del nuevo medicamento");
              $("#med-nvo-conc").focus();
              return false;
            }
        }

        var existe = false;

        $("#cuerpoTabla").find('tr').each(function(){
            var inpPat = $(this).find('input').filter("[name='inpPat[]']");
            var inpMed = $(this).find('input').filter("[name='inpMed[]']");
            var inpCant = $(this).find('input').filter("[name='inpCant[]']");
            
            if ($(inpPat).val() == patId && $(inpMed).val() == medId 
                //&& $(inpMed).data('g') == medGrupo //Para ver si se agrego uno del mismo grupo, DEPRECATED
                && $(inpCant).val() == medCant){
                existe = true;
                return false;
            }
        });

        if (existe){
            //alert("Disculpe, ya ha seleccionado este medicamento o uno de sus sustitutos.");
            alert("Disculpe, ya ha seleccionado este medicamento.");
            return false;
        }

        /*if (!medHay){
            if (!confirm("Disculpe, el medicamento seleccionado no se encuentra disponible\n"+
                "Presione aceptar si desea añadirlo sin generar cita o cancelar para verificar"))
                return false;
        }*/

        var tablaSolicitud = '<tr class="row">'+
                            '<td class="col-md-5">'+
                            //Patologia
                                patTexto+
                                '<input name="inpPat[]" type="hidden" value="'+patId+'">'+
                            '</td>'+
                            '<td class="col-md-4">'+
                            // medicamento
                                ((medId == 0) ? (medNvo+" "+medNvoConc) : medTexto)+
                                //'<input name="inpMed[]" type="hidden" value="'+medId+'" data-g="'+medGrupo+'">'+
                                '<input name="inpMed[]" type="hidden" value="'+medId+'">'+
                                '<input name="inpMedNvo[]" type="hidden" value="'+medNvo+'">'+
                                '<input name="inpMedNvoConc[]" type="hidden" value="'+medNvoConc+'">'+
                            '</td>'+
                            '<td class="col-md-2">'+
                                medCant+
                                '<input name="inpCant[]" type="hidden" value="'+medCant+'">'+
                                //'<input name="inpHay[]" type="hidden" value="'+((medHay) ? 1 : 0)+'">'+
                            '</td>'+
                            '<td class="col-md-2">'+
                                (typeof medCant != "undefined" ? medCant : solicitudDosis+ ' cada ' + solicitudFrecuencia+ ' horas ' )+
                                '<input name="inpCant[]" type="hidden" value="'+(typeof medCant !== "undefined" ? medCant : '')+'">'+
                                //'<input name="inpHay[]" type="hidden" value="'+((medHay) ? 1 : 0)+'">'+
                            
                            '<input name="inpdos[]" type="hidden" value="'+solicitudDosis +'">'+
                            '<input name="inpfrec[]" type="hidden" value="'+solicitudFrecuencia +'">'+
                            '</td>'+
                            '<td class="col-md-1">'+
                                '<button class="eliminar" type="button">Eliminar</button>'+
                            '</td>'+
                         '</tr>';
        $('#cuerpoTabla').append(tablaSolicitud);
       
    });
});

$(document).on('click', ".eliminar", function(){
    if (confirm("¿Está seguro de querer eliminar este registro?"))
        $(this).parents('tr').remove();
    });