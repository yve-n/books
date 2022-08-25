# books

library est une application web développée avec Symfony permettant de visualiser des livres.

## Table de matières
    1. Création du projet

***
1. Création du projet  
    * créer le projet:  

            symfony new library --webapp  
            composer require annotations  
            composer require twig   

2. integrer bootstrap au projet :  
    * webpack :

        composer require symfony/webpack-encore-bundle
        npm install

    * Modifier `app.css` en `app.scss`
    * Modifier dans  app.js le `app.css` en `app.scss`
    * De-commenter `.enableSassLoader()` dans le fichier webpack.config.js
    * install sass:  

        npm install sass-loader@^13.0.0 node-sass --save-dev  
        npm install postcss-loader autoprefixer

    * modifier le fichier base.html.twig  
        - ajouter :  
        {% block stylesheets %}{{ encore_entry_link_tags('app') }}{% endblock %}  
        {% block javascripts %}{{ encore_entry_script_tags('app') }}{% endblock %}  


    * creer un fichier postcss.config.js a la racine 
    * Ajouter : 

            module.exports = {
                plugins: {
                    autoprefixer: {}
                }
            }

    * npm run build  
    * npm install bootstrap  
    * creer un fichier custom.scss dans le dossier assets/styles  
    * Ajouter dans __assets/app.js__:   
   
        import { Tooltip, Toast, Popover } from 'bootstrap';

    * Ajouter dans __/assets/styles/app.scss__:  
   
        @import "custom";  
        @import "~bootstrap/scss/bootstrap";  

    * Dans le dossier config -> package / twig.yaml :  rajouter sous la ligne "default_path: '%kernel.project_dir%/templates'"

        form_themes: ['bootstrap_5_layout.html.twig']

    * facultatif:  

        npm install jquery @popperjs/core --save-dev   


3. Développement  
    * Creation de l'entité User qui servira à l'authentification:  

            symfony console make:User  

    * authentification du user(connexion):   

            symfony console make:auth   

    * création du formulaire d'inscription:  

            symfony console make:registration-form    


