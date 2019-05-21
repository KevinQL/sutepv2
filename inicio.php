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
    <!-- NAVEGACION  -->
    <?php include('navegacion.html'); ?>
    <!-- FIN NAVEGACIÓN -->

    <!-- SECCIÓN HEADER -->

    <div id="carouselExampleControls" class="carousel slide pt-0 slide-k" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="img/1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="img/2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="img/5.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- secction container -->

    <section class="colorbarra py-5">
        <div class="container lead text-dark text-center">
            <img src="img/logosutep.png" width="100px" alt="">
            <p>Un niño, un maestro, un libro, un lápiz pueden cambiar el mundo (Malala Yousafzai).</p>
        </div>
    </section>


    <!-- SECTION NOTICIAS -->
    <section class="bg-light text-muted py-5">
        <div class="container">
            
            <div class="row">
                <div class="text-center col-md-8">
                    <h1 class="display-5 pb-4 text-center">NOTICIAS</h1>
                    <?php
                        require('conect2.php');
                        $con = new DB();
                        $server = $con->conectar();
                        
                        $num_pag = 1;
                        $num_notice = 4;

                        $num_pag = (!empty($_GET['num']))? $_GET['num'] : 0; 
                        $num_pag_sql= ($num_pag!=0)? $num_pag-1: 0;

                        $query = "SELECT * FROM articulos ORDER BY orden ASC LIMIT $num_pag_sql,$num_notice";
                        $result = mysqli_query($server,$query);
                        
                        $notice_cantidad = 0;
                        $datos = [];                    
                        while($row = mysqli_fetch_assoc($result)){
                            $datos[] = $row;
                            $notice_cantidad++;
                        }
                        
                        //Controla el final del paginado de las noticias
                        if(!$notice_cantidad){
                            $num_pag = 0;
                            echo "NO HAY MÁS NOTICIAS...";
                        }
                        
                        foreach($datos as $row){
                            $titulo = $row['titulo'];                            
                    ?>    
                    <!--Noticias repetidas veces -->
                    <div>
                        <div class="card text-left  my-1">
                            <div class="card-body">
                                <h6> <?php echo $titulo; ?> </h6>
                                <div class="d-flex">
                                    <img src="backend/<?php echo $row['ruta']; ?>" width="100px" height="100px;" style="width:100px;" alt="">                                    
                                    <p class="ml-3"> 
                                        
                                        <?php echo $row['introduccion'] ?>

                                        <!-- Inicio Modal -->
                                        <!-- Button trigger modal VER NOTICIA -->
                                        <br>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalScrollable<?php echo $row['id'];?>">
                                            ver noticia
                                        </button>
                                        <br>
                                        <strong class="text-dark">
                                            <?php 
                                                echo $row['fecha'];
                                            ?>
                                        </strong>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalScrollable<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle"> <?php echo $titulo;?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="backend/<?php echo $row['ruta']; ?>" width="100%" height="330px;" style="width:100%;" alt="">                                                                                

                                                <?php                                                
                                                    echo $row['contenido'];
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- Fin Modal -->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        
                        }
                    ?>

                    <div class="container bg-light py-2">
                        <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anteriro</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="/sutepv2/?num=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="/sutepv2/?num=2">2</a></li>
                            <li class="page-item"><a class="page-link" href="/sutepv2/?num=3">3</a></li>
                            
                            <li class="page-item">
                                <a class="page-link" href="/sutepv2/?num=<?php echo $num_pag+1; ?>">Siguiente</a>
                            </li>
                        </ul>
                        </nav>                    
                    </div>


                </div>

                <div class="col-md-4 text-center">
                        <iframe width="340" height="240" src="https://www.youtube.com/embed/fE0v6lZ3fuw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FRezuam-600773577055743%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
            </div>
            
        </div>
    

    </section>
                            
    <!-- SECTION CONTACTO -->
    
    <section class="bg-text-contact py-3">
        <h3 class="text-center text-muted text-white">CONTÁCTANOS <!-- this section is for titles. For example CONTACTANOS--> </h3>
    </section>

    <section class="bg-contact py-3" >
        <div class="container">
            <div class="row pt-3">
                <div class="col-lg-5 pl-5 text-white font-zises">
                    <ul class="list-unstyled">
                        <li class="py-1">
                            <i class="ml-2 fas fa-user-circle"></i> Mauro Concha Villegas 
                            <br>
                            <i class="ml-2 fas fa-phone-square"></i> 953 744 203 
                            <br>
                            <a href="#"><i class="mx-2 fab fa-facebook-f text-secondary "></i></a>
                            <a href="#"><i class="mx-2 fab fa-twitter text-secondary "></i></a>
                            <a href="#"><i class="mx-2 fab fa-instagram text-secondary "></i></a>

                        </li>
                        <li class="py-1">
                            <i class="ml-2 fas fa-user-circle"></i> Elias Flores Carrión  
                            <br>
                            <i class="ml-2 fas fa-phone-square"></i> 978 004 592 
                            <br>
                            <a href="#"><i class="mx-2 fab fa-facebook-f text-secondary "></i></a>
                            <a href="#"><i class="mx-2 fab fa-twitter text-secondary "></i></a>
                            <a href="#"><i class="mx-2 fab fa-instagram text-secondary "></i></a>

                        </li>
                        <li class="py-1">
                            <i class="ml-2 fas fa-user-circle"></i> Charo Rodriguez 
                            <br>
                            <i class="ml-2 fas fa-phone-square"></i> 939 689 006 
                            <br>
                            <a href="#"><i class="mx-2 fab fa-facebook-f text-secondary "></i></a>
                            <a href="#"><i class="mx-2 fab fa-twitter text-secondary "></i></a>
                            <a href="#"><i class="mx-2 fab fa-instagram text-secondary "></i></a>

                        </li>
                    </ul>    
                </div>                
                <div class="col-lg-7"> 
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3877.0431263126356!2d-73.3914989501277!3d-13.655140590362942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x916d2bc66e03d8a3%3A0x37c9b64471c102d1!2sCasa+del+Maestro!5e0!3m2!1ses-419!2spe!4v1558365401045!5m2!1ses-419!2spe" width="100%" height="350px" frameborder="0" style="border:0" allowfullscreen></iframe>                                            
                    <span class="text-white">
                        Av. Casafranca, Andahuaylas 03701
                    </span>                    
                </div>
            </div>
        </div>
    </section>

    <!-- fin section contact -->
                      
  
    <?php include('pie.html'); ?>
                                
</body>
</html>