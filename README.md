# SAE-5-01-BACK 

## Authors
- MATON Erwann
- ALVEZ Kilian
- ROBION Alban
- CLOCHETTE Baptiste
- HUREAUX Lucas

## Instal / Config

To start the Database: 
```sh
docker-compose up 
```

For start the server : ``symfony serv``

## Scripts

``start`` : Launch the local server 

``test:cs`` : Test the quality of code

``fix:cs`` : Correct the code

``test:yaml`` : Test YAML files in folder Config

``test:twig`` : Test Twig files in folder Templates

``db`` : Delete the exists db and create a new db, create migration and load migration
