==========
Setup Codebender App
==========


1> first change database credential in parameter.yml

2> run php composer.phar install command to install vendor.

3> run below command to setup database from entity.

    php app/console doctrine:database:drop --force
    php app/console doctrine:database:create
    php app/console doctrine:schema:create

4> working functionality url is like below.

    /         (homepage)

        -  user listing page. display all users list
        - when we click on userid than user view page is to be display using ajax call(its return json encode content and display into table format and update table)

    /adduser

        - add user page. when we add user than registration date is automatically fillup into database using entity(using gedmo bundle, consider current created date)
        - when we add user than its call ajax request and store data into database and return json encode content for display last store user data.


5> Created entity class into AcmeDemoBundle/Entity.

    - user entity with 3 attributes: id, username, and registrationDate.

