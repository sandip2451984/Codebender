Setup app
========================

1> first change database credential in parameter.yml

2> run php composer.phar install command to install vendor.

3> run below command to setup database from entity.

    php app/console doctrine:database:drop --force
    php app/console doctrine:database:create
    php app/console doctrine:schema:create

4> working functionality url is like below.

   /                    add user page.

   /user               user listing page using json encode.


5> Created entity class into UserBundle/Entity.

    - user entity with 3 attributes: id, username, and registrationDate.

