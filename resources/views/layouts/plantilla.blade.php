<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>@yield("title")</title>
   @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>

   <header class="header">
       <div class="logo">
           <a href="/">
               <img src="img/logo.png" alt="Nombre de la Empresa">
           </a>
       </div>
       <button class="menu-toggle" aria-label="Abrir menú">☰</button> 
       <nav>
           <ul>
               <li><a href="#">Inicio</a></li>
               <li><a href="#">Servicios</a></li>
               <li><a href="#">Sobre Nosotros</a></li>
               <li><a href="#">Contacto</a></li>
           </ul>
       </nav>
   </header>
    
</body>
</html>