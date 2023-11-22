# lemonmind
For recruitment process - November 2023

* Author: Sebastian Gruszka
* Contact: gruszka.seb@gmail.com

# Installation
**Prerequisites**

* Your user must be allowed to run docker commands (directly or via sudo).
* You must have docker compose installed.
* Your user must be allowed to change file permissions (directly or via sudo).
* Your user must be allowed to run git commands.
* You must have git installed.

## Follow These Steps
1. Go to directory where do You want to run application
2. Clone repository: `git clone https://github.com/appleandpear88/lemonmind.git <your_project_name>`
3. Go to project folder: `cd <your_project_name>`
4. Run ```echo `id -u`:`id -g` ``` to retrieve your local user and group id.
5. Open `docker-compose.yaml` file in an editor and change all ocurrences of `user: '501:20'` lines and update the ids if necessary.
6. Start enviornment `docker compose up -d`
7. Install pimcore and initialize the DB: `docker compose exec php vendor/bin/pimcore-install --mysql-host-socket=db --mysql-username=pimcore --mysql-password=pimcore --mysql-database=pimcore`
8. Now You can access your pimcore instance:
    * frontend: https://localhost
    * admin panel: https://localhost/admin
      * use credentials you defined during pimcore installation 

For more information go to official pimcore documentation: https://pimcore.com/docs/platform/Pimcore/Getting_Started/Installation/Docker_Based_Installation

# Initial Configuration
## Importing data

1. Go to DataHub, provide data source CSV files for below listed imports and execute manually import on **Execution** tab by pressing **Start** button on each:
   1. [ ] `runwaySurfaceImport`
   2. [ ] `runwaysImport`
   3. [ ] `regionImport`
   4. [ ] `municipalityImport`
   5. [ ] `frequencyMhzImport`
   6. [ ] `frequencyTypeImport`
   7. [ ] `frequencyImport`
   8. [ ] `airports`
   9. [ ] `runwaysAssociationWithAirports`
   10. [ ] `radioAssociationsWithAirports`
12. Run CLI command to run data importer process:
    * Go to app home directory in Terminal
    * Execute Sequential command: `docker compose exec php bin/console datahub:data-importer:process-queue-sequential` once.

Now all data should be imported and associated together. You can navigate to Data Objects in pimcore to view imported data.
