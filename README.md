HALITAR CORE BUNDLE
========================

Boîte à outils pour la mise en place rapide d'un socle minimaliste pour la mise en place d'une application symfony.

MANAGER / REPOSITORY
--------------

Des services managers, repositories pour l'accès à la base de données.

JAVASCRIPT
--------------

Automatisation et orchestration de certains actions javascript depuis le backend.

INSTALLATION
--------------

Tapez la commande ci-dessous pour installer le bundle "halitar/core".

```
php composer.phar require halitar/core v0.0.1
```

Inclure les lignes ci-dessous dans votre template

```
{{ include ('HalitarCoreBundle:Template:js.html.twig') }}
```
et
```
{{ include ('HalitarCoreBundle:Template:css.html.twig') }}
```

Importer les services dans le fichier "app/config/config.yml"

```
imports:
    - { resource: "@HalitarCoreBundle/Resources/config/services.yml" }
```

Ajouter dans le fichier "app/config/routing.yml"

halitar_core_routing:
    resource: "@HalitarCoreBundle/Resources/config/routing.yml"
    prefix:   /
