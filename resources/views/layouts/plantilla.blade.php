<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>@yield("title")</title>
   @vite('resources/scss/app.scss', 'resources/js/app.js')
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>