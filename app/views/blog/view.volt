{% extends "layouts/base.volt" %}

{% block main %}

<div class="row">

    <div class="col-lg-9">
        <div class="card" style="margin-bottom: 15px;">
            <div class="card-block">
                {% if blog %}
                <h4 class="card-title">{{ link_to('blog/view/'~blog.id, blog.title) }}</h4>
                <p class="card-text">
                    <small class="float-right">{{ blog.author.name }} wrote at {{ jdate('Y-m-d H:i:s',blog.created_at) }}</small>
                    {{ blog.post }}
                </p>
                {{ link_to('blog/view/'~blog.id, 'Read more', 'class': 'btn btn-primary') }}
                {% else %}
                    <p class="card-text">
                        Not Found!
                    </p>
                {% endif %}
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">{{ link_to('/', 'Phalcon') }}</h4>
                <p class="card-text">
                Now we will show a list of blogs submitted in database as a weblog.
                </p>
            </div>
        </div>
    </div>

  </div>
{% endblock %}