<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>@yield("title")</title>
   @vite('resources/scss/app.scss', 'resources/js/app.js')
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha384-8Cxt8Pp5Afloj5s0tJq6ecV6v9F+0vK0bA+L2z8BpaoRTjbxlVo7tJTouA7m2O/e" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>

    
<header>
    <nav class="navbar navbar-expand-lg" style="background-color: #83B271;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi Sitio Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    
   
   @yield("content")
   
   <footer id="miFooter">
       <div class="footer-container">
           <div class="footer-section">
               <h4>Contacto</h4>
               <p>Teléfono: +1 234 567 890</p>
               <p>Email: ecotech@gmail.com</p>
           </div>
           <div class="footer-section">
               <h4>Redes Sociales</h4>
               <p>Síguenos en nuestras redes sociales:</p>
               <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
               <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
               <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
           </div>            
           <div class="footer-section">
               <h4>Acerca de Nosotros</h4>
               <p>Somos una empresa dedicada a [descripción breve]...</p>
           </div>
       </div>
   </footer>
   
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha384-QtWVXS3eT3etYt5BAfQyT2/5L5NzKR/nU2C5r9SI2p4FuCp3HcNuYcXpcNmj6ZD3" crossorigin="anonymous"></script>

</body>
</html>