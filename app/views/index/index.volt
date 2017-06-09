{% extends "layouts/base.volt" %}

{% block main %}
<header>
    <div class="jumbotron">
        <h1 class="display-3">Hello, world!</h1>
        <p class="lead">This is a website powered by Phalcon Framework.</p>
        <hr class="my-4">
        <p>You can now start reading phalcon document and develop your web application base on phalcon framework.</p>
        <p class="lead">
            {{ link_to('blog', '<i class="icon-ok icon-white"></i> Meet Our Blog', 'class': 'btn btn-primary btn-lg') }}
        </p>
    </div>
</header>

<div class="row">

    <div class="col">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Low overhead</h4>
                <p class="card-text">
                <ul class="features features-positive">
                    <li>
                        Zephir/C extensions are loaded together with PHP one time on the web server's daemon start process                    </li>
                    <li>
                        Classes and functions provided by the extension are ready to use for any application                    </li>
                    <li>
                        The code is compiled and isn't interpreted because it's already compiled to a specific platform and processor                    </li>
                    <li>
                        Thanks to its low-level architecture and optimizations <strong>Phalcon provides the lowest overhead for MVC-based applications</strong>                    </li>
                </ul>
                </p>
                {{ link_to('https://phalconphp.com/en/', 'Phalcon Website', 'class': 'btn btn-primary' , false) }}
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Dependency Injection</h4>
                <p class="card-text">
                    Phalcon is built upon a powerful yet easy to understand and use pattern called Dependency Injection. Initialize or define services once - and use them virtually anywhere throughout the application.
                </p>
                {{ link_to('https://docs.phalconphp.com/en/latest/reference/di.html', 'Dependency Injection/Service', 'class': 'btn btn-primary' , false) }}
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">MVC & HMVC</h4>
                <p class="card-text">
                    Build single and multi-module applications with ease and pleasure. Using the file structure, scheme and patterns you already know.
                </p>
                {{ link_to('https://docs.phalconphp.com/en/latest/reference/mvc.html', 'Check MVC Architecture', 'class': 'btn btn-primary' , false) }}
            </div>
        </div>
    </div>

  </div>
{% endblock %}