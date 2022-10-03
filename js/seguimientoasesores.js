
    $(document).ready(function() {
        let segases = $('#example').DataTable({
			ajax: {
				url: "searchfollowingas.php",
        		dataSrc: '',
				// success: function (r) {
				// 	console.log(r)
				// }			
			} ,
			columns: [ 
				{ data: 'CedulaAsesor' },
				{ data: 'NombreAsesor', data: 'ApellidoAsesor', render: function ( data, type, row ) {
            return row.NombreAsesor + ' ' + row.ApellidoAsesor;
        } },
				{ data: 'CedulaCliente' },
				{ data: 'NombreCliente', data: 'ApellidoCliente', render: function ( data, type, row ) {
            return row.NombreCliente + ' ' + row.ApellidoCliente;
        } },
				{ data: 'nombrePagaduria' },
				{ data: 'Monto' },
				{ data: 'Refinanciacion',data: 'saldoCarteraR',data: 'idBeneficio',
				render: function ( data, type, row ) {
					let tipo_benef = "";
					let ref = "";
					if(row.idBeneficio != 1){
						tipo_benef = "APLICA POLIZA"
					}
					if(row.Refinanciacion != ""){
						ref = "REFINANCIACION DEBE: "
					}else{
						ref= "NUEVO "
					}
            return ref + row.Refinanciacion + ' - ' + tipo_benef;
        } },
				{ data: 'comentStatus' },
				{ data: 'RESName' },
				{ data: 'USRUpdated' },
			],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por pagina",
                "zeroRecords": "Lo sentimos, no se encuentra ningun resultado",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Ninguna información dispónible",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "loadingRecords": "Cargando información...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primera",
                    "last": "Ultima",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        let busqueda = document.getElementById("botonbusqueda")
        busqueda.addEventListener("click",()=>{
            let mes = document.getElementById("selectMes").value;
            let anio = document.getElementById("anio").value;

            segases.ajax.url(`searchfollowingas.php?anio=${anio}&mes=${mes}`).load();
        });
    });