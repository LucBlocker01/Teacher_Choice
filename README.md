# SAE-5-01-BACK 

## Authors
- MATON Erwann
- ALVEZ Kilian
- ROBION Alban
- CLOCHETTE Baptiste
- HUREAUX Lucas

## Install / Config

To start the Database: 
```sh
docker-compose up 
```

To start the server : 
```sh 
composer start
```

## Scripts

``start`` : Launch the local server 

``test:cs`` : Test the quality of code

``fix:cs`` : Corrects the code

``test:yaml`` : Test YAML files located in config folder

``test:twig`` : Test Twig files located in templates folder

``db`` : Delete the existing database and create a new one, using the most recent migration
