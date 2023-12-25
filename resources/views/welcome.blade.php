<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Web Empresarial</title>
    <link rel="stylesheet" href="{{asset('css/welcomestyles.css')}}">
    <script src="{{asset('js/js.js')}}"></script>
    <link rel="icon" type="image/png" href="img/welcome/icon2.png">

    <header>
        <div class="animate-header">
        <div class="button-container">
        <div class="auth-buttons">
            <a href="{{ route('login') }}">
            <button class="login-button">Entrar</button></a>
            <a href="{{ route('register') }}">
            <button class="register-button">Registrarse</button></a>
        </div>
        </div>

    
    
    <img class="iconn" src="{{asset('img/welcome/icon.png')}}" >
    <h1>Introducción a nuestra Agenda Web Empresarial</h1>
    <p>
      Bienvenido a nuestra Agenda Web Empresarial, la herramienta esencial para la gestión eficiente de tareas y eventos en tu organización.<br>
      Diseñada para satisfacer las necesidades tanto de empleados como de jefes, esta plataforma te ofrece un conjunto completo de funciones que simplifican la organización <br>
      aumentan la productividad y mejoran la comunicación en tu empresa.
    </p>
    </div>

    </header>
    
</head>
<body class="animate-body">
 

    <section id="gestionUsuarios" class="gestionUsuarios">
        <h2 >Gestión de Usuarios</h2>
        <p class="txthome">
            Nuestra Agenda Web Empresarial garantiza un inicio de sesión seguro y un control de acceso basado en roles.
            Tanto los empleados como los jefes pueden acceder de forma segura, asegurando que cada usuario tenga acceso a la información y las herramientas adecuadas para su función.
        </p>
    </section>

    <section id="panelesPersonalizados">
        <h2>Paneles Personalizados</h2>
        <p class="txthome">
            Para los empleados, ofrecemos un panel personalizado que proporciona una visión general de sus tareas asignadas 
            próximos eventos e información personal, todo en un solo vistazo.
            Los jefes, por otro lado, obtienen un panel completo con detalles de todos los empleados, tareas y estadísticas relevantes.
        </p>
    </section>

    <section id="GestiónTareasEficiente">
        <h2>Gestión de Tareas Eficiente</h2>
        <p class="txthome">
            Nuestra plataforma permite la asignación y reasignación de tareas con facilidad, junto con la capacidad de establecer niveles de prioridad,
            fechas de vencimiento y seguimiento de su estado. También puedes agregar comentarios y archivos adjuntos relacionados con las tareas.
        </p>
       
    </section>
    
       
    </section>

    <section id="RecopilaciónComentarios">
        <h2>Recopilación de Comentarios</h2>
        <p class="txthome">
            Valoramos tus opiniones. Recopilamos comentarios de los usuarios para mejorar constantemente la funcionalidad y la experiencia del usuario en nuestra plataforma.
        </p>
       
    </section>

    <section id="RecursosCapacitación">
        <h2>Recursos de Capacitación</h2>
        <p class="txthome">
            Para ayudarte a sacar el máximo provecho de nuestra Agenda Web Empresarial,<br>
            ofrecemos tutoriales, guías y recursos de capacitación para garantizar que puedas utilizar todas las funciones de manera efectiva.
        </p>
       
    </section>

    


    <footer>

        <div class="footer-box">
            <img class="iconfooter" src="./img/welcome/icon4.png" >
        
        <div class="Titlefooter" >
            <h2 class="titlefooter">Agenda Web Empresarial</h2>

        </div>
        <div class="social">
            <a href=""><img class="iconsocial1" src="{{asset('img/welcome/iconfb.png')}}"></a>
            <a href=""><img class="iconsocial2" src="{{asset('img/welcome/iconig.png')}}"></a>
            <a href=""><img class="iconsocial3" src="{{asset('img/welcome/iconwa.png')}}"></a>
            <a href=""><img class="iconsocial4" src="{{asset('img/welcome/iconcloud.png')}}"></a>
        </div>
        <div class="copyright">
            <p>©2023 TPS2-119 Ficha 2711225 SENA</p>
        </div>
        <div class="footer-links">
            <div class="footer-list">
                <div class="link">
                    <a  class="comentarios" target="_self" href=""> <h3>Comentarios </h3></a>
                </div>
                <div class="link">
                    <a  class="politicas" target="_self" href="">  <h3> Politicas</h3> </a>
                </div>
                <div class="link">
                    
                </div>
            </div>
        </div>
    </div>

    </footer>
</body>
</html>
