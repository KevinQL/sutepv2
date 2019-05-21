<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sutep Andahuaylas</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- icon fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <!-- css propios -->
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
    
    <!-- NAVEGACIÓN -->
    <?php include('navegacion.html'); ?>
    
    <!-- FIN NAVEGACIÓN -->

    <!-- SECCIÓN CERTIFICADO -->
    <section class="cuerpo-certificado secction-principal">
        <div class="fondo-transparente">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="img/certifiacdo1.png" class="img-fluid" width="370px;" alt="">
                    </div>
                    <div class="col-md-6 justify-content-center align-self-center px-5 p-sm-5">
                        <div class="text-white lead ">
                            <div class="">
                                <h3 class="text-center">CERTIFICADO DOCENTE</h3>
                                <form id="formulario">
                                    <div class="form-group">
                                        <label class="text-left">Seleccione Tipo documento</label>
                                        <input type="text" class="form-control form-control-sm d-inline" disabled readonly="readonly" value="DNI ▼">
                                    </div>

                                    <input type="number" name="dni" class="form-control form-control-lg" id="dni" required="required" placeholder="Ingrese DNI">

                                    <button class="btn btn-lg btn-outline-warning btn-block my-3" id="btn-obtener">
                                        OBTENER
                                    </button>
                                </form>

                                <div class="notice-general">
                                    <div class="alert alert-warning alert-dismissible fade hiden notice" role="alert">
                                       <span class="notification">RESULTANDO...</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times</span> 
                                        </button>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->

    <?php include('pie.html'); ?>

    <!-- AJAX CDN-->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
    </script>
    
    
    <script>

        $(document).ready(function(){
            document.getElementById('btn-obtener').addEventListener('click',function(event){
                event.preventDefault();
                var dni = document.getElementById('dni').value;

                if( dni.length != 8 || ((dni/dni) != 1) ){
                    console.log("Número de DNI incorrecto!!");
                    No_es_Dni();

                    console.log( $('#formulario').serialize() ); //prueba :)          

                    return null;

                }else{

                    $.ajax({
                        type: "POST",
                        url: "procesar_certificado.php",
                        data: $('#formulario').serialize(),
                        success: function(data){
                            console.log(data);
                            let request_server=data;
                            if(request_server){
                                Descargar();
                            }else{
                                console.log("USUARIO NO EXISTE")                                    
                                Usuario_No_Existe();
                            }

                        }

                    });

                }

                /*
                * Funciones para las notificaciones de consulta
                */
                
                function Descargar(){
                    $('.notice-general').html(
                        `<div class="alert alert-success alert-dismissible fade show text-center notice" role="alert">
                            <span class="notification"> certificado para ${dni} 
                            <a href='library_download/certificate.php?chmodmodeelle=%&${btoa(dni)}&${btoa("Lenyn putito siempre putito")}&id=${btoa(dni)}' target='_blank' class="btn btn-warning btn-lg btn-block">Descargar pdf</a> </span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times</span> 
                            </button>
                        </div>`
                    );
                }

                function Usuario_No_Existe(){
                    $('.notice-general').html(
                        `<div class="alert alert-danger alert-dismissible fade show notice" role="alert">
                            <span class="notification lead">No existe!!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times</span> 
                            </button>
                        </div>`
                    );
                }

                function No_es_Dni(){
                    $('.notice-general').html(
                        `<div class="alert alert-warning alert-dismissible fade show notice" role="alert">
                            <span class="notification">Numero de DNI incorrecto!!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times</span> 
                            </button>
                        </div>`
                    );
                }


            });
        });


    </script>

</body>
</html>