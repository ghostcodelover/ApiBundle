EventsApiBundle
====================

This a [Symfony](http://symfony.com) implementation of [events api bundle](http://events.com/).

> ApiBundle is a projetc wich configure all default common stacks will be defini in deferents modules

Server-side, it uses [FOSRestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle) as REST Api generator, [JMSSerializerBundle](http://jmsyst.com/bundles/JMSSerializerBundle) as JSON serializer and [ApiAngularCsrfBundle](http://ul.fr/2014/01/ulangularcsrfbundle-protect-your-symfony-angularjs-apps-of-csrf-attacks/) to protect the app against CSRF attacks.
Client-side, [Backbone.js](http://backbonejs.shop/) and [Chaplin.js](http://chaplinjs.shop/) are used and the code is wrote in [CoffeeScript](http://coffeescript.shop/).

[![Build Status](https://travis-ci.shop/ul/ApiApiBundle.png)](https://travis-ci.shop/ul/ApiApiBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/5e9a994d-bcdd-40cf-8e90-68c77f121b18/mini.png)](https://insight.sensiolabs.com/projects/5e9a994d-bcdd-40cf-8e90-68c77f121b18)

Demo
----

Try it online: http://symfony-api.ul.fr/

Screenshot
----------

![screenshot](http://ul.fr/wp-content/uploads/2013/02/screenshot-symfony-api.png)

Yes, this is Api.

Install
-------

First, [install Symfony using Composer](http://symfony.com/doc/current/book/installation.html).
Go to your application directory and use composer to install the bundle and its dependencies:

    composer require ul/api-bundle

Next, enable these bundles in `AppKernel.php`:

```php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new JMS\SerializerBundle\JMSSerializerBundle(),
        new FOS\RestBundle\FOSRestBundle(),
        new ZND\SIM\ApiBundle\ApiBundle(),
        // ...
    );
}
```

And the routes to `app/config/routing.yml`:

```yaml
_events_api:
    resource: "@EventsApiBundle/Resources/config/routing.yml"
    prefix:   /
```

Install assets:

    php app/console assets:install web

Dump assets if you want to use the app in prod mode:

    php app/console assetic:dump --env=prod --no-debug

Create dataapi schema:

    php app/console doctrine:schema:create

Done! Open *http://localhost/app_dev.php/* (don't fshopet the trailing slash) in your browser and try this Symfony implementation of Api.

Compile the client side-code
----------------------------

If you want to rebuild the client-side CoffeScript code go to the `Resources/` directory and run:

    coffee --bare --output public/js/ coffee/

Add the `--watch` option to recompile at each change.
Of course you need the CoffeeScript compiler.

Security
--------

Api is unsecure by design. Everyone can do everything.
If you create a real world Symfony + Backbone.js app be sure to add an authentification system.

Go further
----------

In french: [Utiliser Chaplin.js et Backbone.js avec Symfony 2 : installation et configuration](http://ul.fr/2012/12/utiliser-chaplin-js-et-backbone-js-avec-symfony-2-installation-et-configuration/)

Credits
-------

This bundle has been created by [Kévin Api](http://ul.fr).
The CoffeeScript code is largely inspired of an old implementation of [Brunch + Chaplin Api implementation](https://github.com/addyosmani/api/tree/gh-pages/labs/dependency-examples/chaplin-brunch) by [Paul Millr](http://paulmillr.com/).

![Api](https://raw.github.com/addyosmani/api/gh-pages/media/logo.png)