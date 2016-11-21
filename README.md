pinboard
========
php bin/console server:run

http://172.16.220.130:8000/app_dev.php

Tag: 1
------
- Rimuovere il bundle AppBundle
- Creare il bundle PinboardBundle con console generator
    - rinominare controller e paths in FrontendController
- modificare Homepage route
    - dare nome alla rotta "homepage"
- modificare Homepage controller
    - configurare parametri della rotta e passarli al template
- modificare Homepage template
    - extends del base per vedere debug bar
    - aggiungere un parametro al controller e renderizzarlo nel template
- creare Info route
- creare Info controller
- creare Info template

Tag: 2
------
- Creare Single Card Action con named parameter
- Creare stub di cards da renderizzare in homepage
    - utilizzo di url generator in controller e introduzione a service container
    
Tag: 3
------
- Introduzione a Doctrine
- Creazione entity e tabella Cards
    - php bin/console doctrine:generate:entity
    - aggiunta campi custom:
        - Title
        - Description
        - Image
        - Slug
    - generare getters / setters:
```{r, engine='bash', count_lines}
php bin/console generate:doctrine:entities PinboardBundle/Entity/Card
```    
- Introduzione all'uso delle fixtures
    - installazione di fixtures bundle ( vedi doc ufficiale )
    - creazione prima fixture "CardsFixtures"
    - Update del db
```{r, engine='bash', count_lines}
php bin/console doctrine:schema:update --force
```        
- Modificato parametro $name in $slug per la rotta card

Tag: 4
------
- Modifica dello stub in homepage ed estrazione dei dati dal DB  
- Setup pagina Card con dati dinamici
    - modificare lo slug in unique in database 
    - query della card dato il suo slug

Tag: 5
------
- Aggiunta campo "active" e "sort" alla card
    - rebuild delle entities
    - aggiunta dei nullable nella entity, tutti i campi
- Modifica delle fixtures
- descrizione e utilizzo del queryBuilder
- modifica del repository e aggiunta di query più complessa, estrarre Cards attive
    

Tag: 6
------
- Introduzione a service container
- Creazione servizio per estrarre Cards

Tag: 7
------
- Security: Authorization vs Authentication e introduzione a Security component
- Creazione di UserBundle
    - eppurazione da cartelle inutili ( views, controller Default )
- Database Users Provider: http://symfony.com/doc/current/security/entity_provider.html 
- Creiamo fixtures di utenti nel bundle UserBundle
- Autentichiamo con Basic Auth

Tag: 8
------
- Creazione header con pulsante di login
    - creazione Partials/_header.html.twig
    - creazione layout.html.twig per usare nostro layout dentro a bundle
    - modifica di tutti i template gia creati per estendere questo
    - se sono loggato mostro il nickname nell'header
    - creare route di logout (non il controller) e link nell'header
    - **NOTA**: firewall diversi non condividono autorizzazione. Meglio creare 1 firewall e aggiungere la login form li
- Creazione di form di login
    - creazione di SecurityController
    - modifica di security.yml
        - access controls
- Creazione user personal dashboard
    - creazione di DashboardController per separare un po di logica
    - template

Tag: 9 
------
- Creazione form di registrazione ( Prima form! ) ( http://symfony.com/doc/current/doctrine/registration_form.html )
    - spiegazione di FormType e creazione di UserType
    - creazione di registration controller
    - aggiunta di "plainPassword" all'utente. Non viene usata o salvata, ma serve per la UserType form
    - aggiunta di assert in classe utente per la validazione
    - **NOTA** non aggiungiamo riferimento allo schema. NOn vogliamo il campo in DB
```{r, engine='bash', count_lines}
php bin/console generate:doctrine:entities UserBundle/Entity/User
php bin/console doctrine:schema:update --force
```
- aggiunta di register nell'header
- Setting flash message in home dopo creazione utente
     
Tag: 10
-------
- Modifica schema: creare relazione utente - cards ( 1 - m )

  
- Aggiunta di form creazione nuova card personale utente
    - creazione route "addCard" con form e gestione della post nel controller
        - utilizzo di @Method annotation e FrameworkExtraBundle
        - flash messages
    - creazione submenu in Dashboard/index.html.twig 
    - aggiunta di blocco flash messages
    - Upload immagine ( http://symfony.com/doc/current/controller/upload_file.html )
    - crop immagine da backend
- Visualizzazione in home delle mie cards
    - aggiunta di metodo a servizio CardsManager
    - update repository
    - creazione di un component per includere il blocco sia in home che nella dashboard
    - eliminazione placeholder, utilizzo asset corretto
    - update scheda card con asset immagine
    
***TODO:***
-----------          

Tag: 11
-------
- Aggiunta di [POST] route: "addToFavourites" ( aggiunge la card ai preferiti )




    

 
    
    
