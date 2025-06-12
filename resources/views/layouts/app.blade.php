<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neia Laços | @yield('pageName')</title>
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <nav class="blue-grey darken-4">
            <div class="nav-wrapper container">
                <ul class="right hide-on-med-and-down">
                    <li><a href="{{ url('/') }}">Pedidos</a></li>
                    <li><a href="{{ route('customers.index') }}">Clientes</a></li>
                    <li><a href="{{ route('raw_materials.index') }}">Materiais Base</a></li>
                    <li><a href="{{ url('/produto') }}">Produtos</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="page-footer blue-grey darken-4">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Neia Laços CRM</h5>
                    <p class="grey-text text-lighten-4">
                        Desenvolvido com <a class="grey-text text-lighten-4" href="https://laravel.com/" target="_blank">Laravel</a> e <a class="grey-text text-lighten-4" href="https://materializecss.com/" target="_blank">MaterializeCSS</a>.
                    </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links de Ajuda</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="">Documentação</a></li>
                        <li><a class="grey-text text-lighten-3" href="https://wa.me/5531993587602">Pedir Ajuda</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © {{ date('Y') }} Neia Laços CRM. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-mask.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elemsDropdown, {
                constrainWidth: false
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
