After downloading, check the settings in Homestead.yaml - in particular
 the mapping to the project directory on the host machine!
 
 When ready, then start up the vagrant machine with:

    vagrant up
    
After the vagrant machine has started connect using

    vagrant ssh
    cd uw-change-password
    
Then, to install this project:

    composer install
    npm install
    
Set up variables in .env file as necessary, then run

    php artisan migrate
    
Then you should be able to view the project in your browser at http://192.168.10.10

The prototype of the page to be implemented can be seen at http://192.168.10.10/password/change
    
