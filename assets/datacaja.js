

var data = 
    [
        {
            "codigo":"Tiger Nixon",
            "descripcion":"System Architect",
            "banco":"Edinburgh",
            "cuenta":"5421",
            "tipo":"2011/04/25",
            "saldo":"$3,120",
            "inicio":"$3,120",
            "estado":"$3,120"
           
        }
      
    ]

;


// datatable init
$('document').ready(function(){
    //CREAR LA TABLA
    //BEGIN
	var tabla=$('#example').DataTable({
        destroy:true,
		scrollCollapse: false,
		autoWidth: false,
		responsive: true,
		searching: true,
		bLengthChange: false,
		bPaginate: true,
		bInfo: false,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
		"lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Buscar",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'
			}
		},
        data:data,
        columns:[
            {"data":"codigo"},
            {"data":"descripcion"},
            {"data":"banco"},
            {"data":"cuenta"},
            {"data":"tipo"},
            {"data":"saldo"},
            {"data":"inicio"},
            {"data":"estado"},
            {"defaultContent":"<button class='editar btn btn-sm btn-outline-warning'><i class='icon-copy dw dw-edit2'></i></button> <button class='btn btn-sm btn-outline-danger'><i class='icon-copy dw dw-delete-3'></i></button>"}
        ]
	});
    //END

     //BOTÓN EDITAR DE LA TABLA
     //BEGIN
    var obtener_data_editar=function(tbody,table){
        $(tbody).on("click","button.editar",function(){
            var data=table.row( $(this).parents("tr")).data();
            console.log(data);
        });
    }

   
    obtener_data_editar("#example tbody",tabla);
    //END



    $("#btn_guardar_caja").click(function(){
        var descripcion=$("#descripcion").val();
        var banco=$("#banco").val();
        var cuenta=$("#cuenta").val();
        var tipo=$("#tipo").val();
        var saldo=$("#saldo").val();
        var capital=$("#capital").val();

        $.ajax({
            type:"POST",
            url:"./procesar/savecaja.php",
            data:{vdescripcion:descripcion,
                  vbanco:banco,
                  vcuenta:cuenta,
                  vtipo:tipo,
                  vsaldo:saldo,
                  vcapital:capital
            },
            success: function(response){
                alert(response);
            }
        });
    });
});
    
     
    
