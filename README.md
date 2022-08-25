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

2. Développement  
    * Creation de l'entité User qui servira à l'authentification:  

            symfony console make:User  

    * authentification du user(connexion):   

            symfony console make:auth   

    * création du formulaire d'inscription:  

            symfony console make:registration-form   
