# books

Bbookshop est un site e-commerce de livres développé avec Symfony.

## Table de matières
    1. Création du projet
    2. Intégration de bootstrap
    3. développement  
    4. Fonctionnalités de la V1

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

    * création d'autres formulaires:   
    
            symfony console make:form  

    * création des Entités:   
     
            symfony console make:entity 
            
    * création de Controlleurs   
    
            symfony console make:controller  
            
    * création de la base de données  
    
            symfony console doctrine:database:create   
            
    * migration vers la BDD
    
            symfony console make:migration
            symfony console doctrine:migrations:migrate   
            
    
        
4. Fonctionnalités mise en place dans la V1  

    - création de compte utilisateur
    - Connexion au compte
    - page d'accueil avec produits
    - page de details d'un produit(titre, prix, description, auteur, catégorie)
    - page des catégories 
        - choisir une catégorie et afficher ses livres 
    - Lorsque l'utlisateur est connecté:  
         - s'il est Administrateur :   
             - il est redirigé vers la partie administrateur du site  
             - gestion des produits du site (ajout, modification, suppression)
             - gestion des catéégories du site (ajout, modification, suppression)
             - se rendre sur le site depuis le pannel d'administration
             - voir son profil
         - s'il est utilisateur simple   
             - voir les produits
             - voir ses informations de profil      
    - page Profil qui affiche les infos de l'utlisateur   
    - Page panier (ajout des produits au panier, supprimer le panier, retirer un produit du panier)   

        

