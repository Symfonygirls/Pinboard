pinboard
========

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


    

 
    
    
