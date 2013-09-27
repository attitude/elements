Elements for PHP Apps
=====================

My purely naive approach to writing a PHP library


A/ Elements division
--------------------

Library elements consist of at least one of 3 parts by *functionality*:

+ **Interfaces** *(input-output compatibility)*
+ **Prototypes** *(low-level elements)*
+ **Elements** *(abstract and final elements)*

---

### A/1 Interfaces

This input-output compatibility code is really likely to change.
Some are still just a dummy shells.

### A/2 Prototypes

Lots of rewriting happened here, some are still broken (TableStorage prototypes mostly).


### A/3 Elements

Elements are the elements you interact with in your app. They are more like higher level abstraction to low-level actions.

#### A/3.1 Application hierarchy

When an external request touches your script, create a new **[Server](https://github.com/attitude/elements-server)** (wraps internal API) to handle it. 

1. Starts up the **[Bootstrap](https://github.com/attitude/elements-boot)**
2. Prepares **[Request](https://github.com/attitude/elements-request)**
3. Runs **[API](https://github.com/attitude/elements-api)**
    1.  uses **[Request](https://github.com/attitude/elements-request)**
    2.  **[Handler](https://github.com/attitude/elements-handler)** handles **[Request](https://github.com/attitude/elements-request)**
        1. passes **[Request](https://github.com/attitude/elements-request)** to registered **[Service](https://github.com/attitude/elements-service/blob/develop/Interface.php)**
        2. returns response (in case of exception an **[HTTPException](./HTTPException.php)** is thrown)
    3. responds using **[Responder](https://github.com/attitude/elements-responder)**
4. Responds

The rest is mostly up to you.

#### A/3.2 Common Elements

1.  ##### Serializer
    
    Right now only [JSON serialisation](https://github.com/attitude/elements-serializer-json) engine is provided.

1.  ##### Storage
    
    If your app needs storage, it does not need an ORM, not a NoSQL, MySQL - implementation should not matter. Most of the time you need to store an **[blob](https://github.com/attitude/elements-storage/blob/develop/Blob/Element.php)** and search by some **[index](https://github.com/attitude/elements-storage/blob/develop/Index/Element.php)**. (*Experimental, right now only Filesystem storage is supported.*)


#### A/3.3 Coding Concept Elements

These are the only ones sitting in this repository (other have their own) and are somehow
special or misused. Feel free to ignore them and write your own. Just stick to the interface.

1.  ##### Dependency injection

    Probably the most important component of all is the [DependencyContainer](./DependencyContainer.php). It's not so sophisticated as [others](https://github.com/symfony/symfony/tree/master/src/Symfony/Component/DependencyInjection) [ones](https://github.com/fabpot/Pimple) but it works ([MVP](http://en.wikipedia.org/wiki/Minimum_viable_product)).

1.  ##### Exceptions
    
    Rising an **[HTTPException](./HTTPException.php)** could be used to bubble up and show some error page instead. (*Experimental, maybe is misuse of Expection.*)


B/ The code
-----------

Library accepts (most) standards either proposed or [approved](https://github.com/php-fig/fig-standards/tree/master/accepted) by the [PHP Framework Interop Group](http://www.php-fig.org/) also know as [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md), [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) and [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).

Documentation is being written in *docblocks* using [PHP Documentor](http://phpdoc.org).

C/ Disclamer – Work-in-progress ahead
-------------------------------------

This is a more-of-an-experimental library than a production ready library, my journal of coding experience.
In case you are looking for a full-blown lib, check-out the [Symfony project](http://symfony.com) instead.
Otherwise, please hit fork this repo and let's have some fun.

1. **The Library** *(in progress)*
2. Unit Tests *(todo)*

*Made with love*

[@martin_adamko](http://twitter.com/martin_adamko)
