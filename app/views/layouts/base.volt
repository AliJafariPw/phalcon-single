<!DOCTYPE html>
<html>
<head>
    <title>{% if title is defined %}{{ title }}{% else %}Welcome to Phalcon Single Module{% endif %}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
    {{ stylesheet_link('css/style.css') }}
</head>
<body>

<div class="container main-container">
    {% block main %}

    {% endblock %}
</div>

<footer>
    Made with love by {{ link_to("http://jafari.pw", "Ali Jafari" , false) }} , Powered by {{ link_to("https://phalconphp.com/en/", "Phalcon Framework" , false) }}
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</body>
</html>