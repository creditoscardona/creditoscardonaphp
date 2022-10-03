document.addEventListener("DOMContentLoaded", function() {
    var total_desembolsos = new FormData();
    total_desembolsos.append( "query", "desembolsostotales" );

    fetch("consultas.php",
    {
        method: "POST",
        body: total_desembolsos
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ 
        // console.log(data[0]) 
        let cargatotaldesembolsos = document.getElementById("cargatotdes")
        let totaldesembolsos = document.getElementById("totdes")
        cargatotaldesembolsos.classList.remove('spinner-grow');
        totaldesembolsos.innerHTML = data[0]
    })
    var desembolsos_refinanciados = new FormData();
    desembolsos_refinanciados.append( "query", "desembolsosrefinanciados" );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_refinanciados
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ 
        // console.log(data[0]) 
        let cargadesembolsosrefinanciados = document.getElementById("cargadesref")
        let desembolsosrefinanciados = document.getElementById("desref")
        cargadesembolsosrefinanciados.classList.remove('spinner-grow');
        desembolsosrefinanciados.innerHTML = data[0]
    })
    var desembolsos_nuevos = new FormData();
    desembolsos_nuevos.append( "query", "desembolsosnuevos" );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_nuevos
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ 
        // console.log(data[0]) 
        let cargadesembolsosnuevos = document.getElementById("cargadesnue")
        let desembolsosnuevos = document.getElementById("desnue")
        cargadesembolsosnuevos.classList.remove('spinner-grow');
        desembolsosnuevos.innerHTML = data[0]
    })
    var total_desembolsos_por_mes = new FormData();
    total_desembolsos_por_mes.append( "query", "totaldesembolsospormes" );

    fetch("consultas.php",
    {
        method: "POST",
        body: total_desembolsos_por_mes
    })
    .then(function(res){ return res.json(); })
    .then(function(dataresp){ 
         
        let totaldesembolsospormes = document.getElementById("cargatotdesmes")
        // let desembolsosnuevos = document.getElementById("desnue")
        totaldesembolsospormes.classList.remove('spinner-grow');
        // desembolsosnuevos.innerHTML = data[0]
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // console.log(gradient)
        // console.log("Total por mes-->>",dataresp)
        // // Line chart
        window.graficameses = new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov",
                    "Dic"
                ],
                datasets: [{
                    label: "Desembolsos ($)",
                    fill: true,
                    backgroundColor: gradient,
                    // window.theme.primary,
                    // gradient,
                    borderColor: window.theme.primary,
                    data: 
                    dataresp
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: 'transparent'
                    }],
                    yAxes: [{                        
                        gridLines: 'transparent'
                    }]
                }
            }
        });
    })

    var desembolsos_pagadurias = new FormData();
    desembolsos_pagadurias.append( "query", "desembolsospagadurias" );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_pagadurias
    })
    .then(function(res){ return res.json(); })
    .then(function(dataresp){ 
        let desembolsospag = document.getElementById("cargadespag")
        if(dataresp.length != 0){            
            // let desembolsosnuevos = document.getElementById("desnue")
            desembolsospag.classList.remove('spinner-grow');
            // desembolsosnuevos.innerHTML = data[0]
            // // Line chart
            // Bar chart
            window.graficadespag = new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: dataresp[0],
                    datasets: [{
                        label: "este mes",
                        backgroundColor: [
                            "#A04000",
                            "#633974",
                            window.theme.primary,                            
                            "#CE6E6E",
                            "#5DADE2",
                            "#E67E22",
                            window.theme.warning,
                            "#717D7E",
                            "#34495E",                            
                            "#808B96",
                        ],
                        borderColor: [
                            "#A04000",
                            "#633974",
                            window.theme.primary,                            
                            "#CE6E6E",
                            "#5DADE2",
                            "#E67E22",
                            window.theme.warning,
                            "#717D7E",
                            "#34495E",                            
                            "#808B96",
                        ],
                        hoverBackgroundColor:[
                            "#A04000",
                            "#633974",
                            window.theme.primary,                            
                            "#CE6E6E",
                            "#5DADE2",
                            "#E67E22",
                            window.theme.warning,
                            "#717D7E",
                            "#34495E",                            
                            "#808B96",
                        ],
                        hoverBorderColor: [
                            "#A04000",
                            "#633974",
                            window.theme.primary,                            
                            "#CE6E6E",
                            "#5DADE2",
                            "#E67E22",
                            window.theme.warning,
                            "#717D7E",
                            "#34495E",                            
                            "#808B96",
                        ],
                        data: dataresp[1],
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        }else{
            desembolsospag.classList.remove('spinner-grow');
            desembolsospag.innerHTML = '<span>Aún no hay desembolsos</span>'
        }
    })

    var desembolsos_asesores = new FormData();
    desembolsos_asesores.append( "query", "desembolsosasesores" );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_asesores
    })
    .then(function(res){ return res.json(); })
    .then(function(dataresp){ 
        let desembolsosasesores = document.getElementById("cargadesases")
        if(dataresp.length == 0){            
            desembolsosasesores.classList.remove('spinner-grow');
            desembolsosasesores.innerHTML = '<span>Aún no hay desembolsos</span>'
        }else{
            fetch("consultadesases.php")
            .then(function(res){ return res.json(); })
            .then(function(dat){
                let tabla = document.getElementById("asesoresdes")
                let text = ""
                dat.forEach(element => text += element);
                tabla.innerHTML = text
            })
            // let desembolsosnuevos = document.getElementById("desnue")
            desembolsosasesores.classList.remove('spinner-grow');
            // desembolsosnuevos.innerHTML = data[0]        
            // Pie chart
            window.graficadesases = new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: dataresp[0],
                    datasets: [{
                        data: dataresp[1],
                        backgroundColor: [
                            "#A04000",
                            "#633974",
                            window.theme.primary,                            
                            "#CE6E6E",
                            "#5DADE2",
                            "#E67E22",
                            window.theme.warning,
                            "#717D7E",
                            "#34495E",                            
                            "#808B96",
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
            //aqui motrar la tabla
            let tabla = document.getElementById("asesoresdes")
            tabla.classList.remove("d-none")
            // tabla.classList.add("")
        }
    })

    var ciudades_clientes = new FormData();
    ciudades_clientes.append( "query", "ciudadesclientes" );

    fetch("consultas.php",
    {
        method: "POST",
        body: ciudades_clientes
    })
    .then(function(res){ return res.json(); })
    .then(function(dataresp){ 
        //  console.log("AQUI CITY-->",dataresp)
        let desembolsosasesores = document.getElementById("cargaciryclient")
        // let desembolsosnuevos = document.getElementById("desnue")
        desembolsosasesores.classList.remove('spinner-grow');        
        // var markers = dataresp;
        $('#world_map').vectorMap({
            map: 'co_merc', 	
            // markers: markers,
            markers: dataresp,
        });
    })

});

let busqueda = document.getElementById("botonbusqueda")
busqueda.addEventListener("click",()=>{
    let tabla = document.getElementById("asesoresdes")
    tabla.innerHTML = ""
    Swal.fire({
        title: 'Cargando nueva información',
        html: 'Esto puede tardar un tiempo.',
        allowOutsideClick: false,
        timer: 2000,
        didOpen: () => {
          Swal.showLoading()
        },
        willClose: () => {
        //   clearInterval(timerInterval)
        }
    })

    searchNewData()

    //con esto se cierra el modal swal
    // swal.close()
})


function searchNewData () {

    let mes = document.getElementById("selectMes").value;
    let anio = document.getElementById("anio").value;
    let despag = document.getElementById("cargadesases")
    despag.innerHTML = ""
    let desnue = document.getElementById("cargadespag")
    desnue.innerHTML = ""
    let totaldesembolsos = document.getElementById("totdes")
    totaldesembolsos.innerHTML = ""
    let desembolsosrefinanciados = document.getElementById("desref")
    desembolsosrefinanciados.innerHTML = ""
    let desembolsosnuevos = document.getElementById("desnue")
    desembolsosnuevos.innerHTML = ""
    document.getElementById("world_map").innerHTML = ""

    if(window.graficadesases){window.graficadesases.clear();}
    if(window.graficadespag){window.graficadespag.clear();}
    if(window.graficadesases){graficadesases.destroy();}
    if(window.graficadespag){window.graficadespag.destroy();}

    var total_desembolsos = new FormData();
    total_desembolsos.append( "query", "desembolsostotales" );
    total_desembolsos.append( "mes", mes );
    total_desembolsos.append( "anio", anio );

    fetch("consultas.php",
    {
        method: "POST",
        body: total_desembolsos
    })
    .then(function(res){ return res.json(); })
    .then(function(data){         
        totaldesembolsos.innerHTML = data[0]
    })

    var desembolsos_refinanciados = new FormData();
    desembolsos_refinanciados.append( "query", "desembolsosrefinanciados" );
    desembolsos_refinanciados.append( "mes", mes );
    desembolsos_refinanciados.append( "anio", anio );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_refinanciados
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ 
        desembolsosrefinanciados.innerHTML = data[0]
    })

    var desembolsos_nuevos = new FormData();
    desembolsos_nuevos.append( "query", "desembolsosnuevos" );
    desembolsos_nuevos.append( "mes", mes );
    desembolsos_nuevos.append( "anio", anio );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_nuevos
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ 
        desembolsosnuevos.innerHTML = data[0]
    })

    var desembolsos_pagadurias = new FormData();
    desembolsos_pagadurias.append( "query", "desembolsospagadurias" );
    desembolsos_pagadurias.append( "mes", mes );
    desembolsos_pagadurias.append( "anio", anio );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_pagadurias
    })
    .then(function(res){ return res.json(); })
    .then(function(dataresp){ 
        // Bar chart
        window.graficadespag = new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: dataresp[0],
                datasets: [{
                    label: "este mes",
                    backgroundColor: [
                        "#A04000",
                        "#633974",
                        window.theme.primary,                            
                        "#CE6E6E",
                        "#5DADE2",
                        "#E67E22",
                        window.theme.warning,
                        "#717D7E",
                        "#34495E",                            
                        "#808B96",
                    ],
                    borderColor: [
                        "#A04000",
                        "#633974",
                        window.theme.primary,                            
                        "#CE6E6E",
                        "#5DADE2",
                        "#E67E22",
                        window.theme.warning,
                        "#717D7E",
                        "#34495E",                            
                        "#808B96",
                    ],
                    hoverBackgroundColor:[
                        "#A04000",
                        "#633974",
                        window.theme.primary,                            
                        "#CE6E6E",
                        "#5DADE2",
                        "#E67E22",
                        window.theme.warning,
                        "#717D7E",
                        "#34495E",                            
                        "#808B96",
                    ],
                    hoverBorderColor: [
                        "#A04000",
                        "#633974",
                        window.theme.primary,                            
                        "#CE6E6E",
                        "#5DADE2",
                        "#E67E22",
                        window.theme.warning,
                        "#717D7E",
                        "#34495E",                            
                        "#808B96",
                    ],
                    data: dataresp[1],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false,
                        ticks: {
                            stepSize: 20
                        }
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    })

    var desembolsos_asesores = new FormData();
    desembolsos_asesores.append( "query", "desembolsosasesores" );
    desembolsos_asesores.append( "mes", mes );
    desembolsos_asesores.append( "anio", anio );

    fetch("consultas.php",
    {
        method: "POST",
        body: desembolsos_asesores
    })
    .then(function(res){ return res.json(); })
    .then(function(dataresp){  
        fetch("consultadesases.php",
        {
            method: "POST",
            body: desembolsos_asesores
        })
        .then(function(res){ return res.json(); })
        .then(function(dat){
            let tabla = document.getElementById("asesoresdes")
            let text = ""
            dat.forEach(element => text += element);
            tabla.innerHTML = text
        }) 
        // Pie chart
        window.graficadesases = new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: dataresp[0],
                datasets: [{
                    data: dataresp[1],
                    backgroundColor: [
                        "#A04000",
                        "#633974",
                        window.theme.primary,                            
                        "#CE6E6E",
                        "#5DADE2",
                        "#E67E22",
                        window.theme.warning,
                        "#717D7E",
                        "#34495E",                            
                        "#808B96",
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    })

    var ciudades_clientes = new FormData();
    ciudades_clientes.append( "query", "ciudadesclientes" );
    ciudades_clientes.append( "mes", mes );
    ciudades_clientes.append( "anio", anio );

    fetch("consultas.php",
    {
        method: "POST",
        body: ciudades_clientes
    })
    .then(function(res){ return res.json(); })
    .then(function(dataresp){ 
        //  console.log("AQUI CITY-->",dataresp)
        let desembolsosasesores = document.getElementById("cargaciryclient")
        // let desembolsosnuevos = document.getElementById("desnue")
        desembolsosasesores.classList.remove('spinner-grow');        
        // var markers = dataresp;
        $('#world_map').vectorMap({
            map: 'co_merc', 	
            // markers: markers,
            markers: dataresp,
        });
    })

    // swal.close()
}