# Candidate Test PHP/Laravel MVC

### Quick overview:
<p>We'll be working with modules, which basically follow an MVC structure where each module has a Model(e.g lt_person), View (list view, edit view and detail view) and a Controller (Which is essentially where we manipulate records stored in our model tables). When you create and build a module, this basically creates a model class (sugacrm/web/module/lt_person/lt_person.php) that you can use to update a record, a configuration file (sugacrm/web/module/lt_person/vardefs.php) where you can define fields and which of those fields appear on views and some view classes (sugacrm/web/module/lt_person/views/view.detail.php and sugacrm/web/module/lt_person/views/view.edit.php).</p>

## Now lets set up the test:
<br>

### First download and install docker if you dont have it yet
<a href="https://www.docker.com/products/docker-desktop/">https://www.docker.com/products/docker-desktop/</a>
<br><br>

### Build the container that will serve the test app
```sh
docker-compose build test-app
```

### Start the test container up and build the db and ngix containers
```sh
docker-compose up -d
```

### Install composer packages
```sh
docker-compose exec test-app ./run.sh composer install
```

### Lets build the modules we have at the moment
```sh
#Note: This will delete all the tables linked to modules, recreate them and run migrations
docker-compose exec test-app ./run.sh build-modules
```

#### FYI: The app runs at http://localhost:8000

## Congrats, you're all set at this point, the commands that come next you will only need to run at specific steps of your development process.

### This is how you can seed tables
```sh
docker-compose exec test-app ./run.sh seed
#Seeding specific tables or running specific seeder classes
docker-compose exec test-app ./run.sh seed --class=PolicySeeder
```

### This is how you can create seeders
```sh
docker-compose exec test-app ./run.sh create-seeder MySeeder
```

### Run migrations
```sh
#Might want to give the db container a few minutes to properly start up before running this one
docker-compose exec test-app ./run.sh migrate
```

### Run inspire to get an inspiration from laravel
```sh
docker-compose exec test-app ./run.sh inspire
```

### This is how you can ssh into the container if needed
```sh
docker exec -it case-management-test-container /bin/bash
```

### This is how you can create a module called users
```sh
docker-compose exec test-app ./run.sh create-module users
```

### This is how you can remove a module called users
```sh
docker-compose exec test-app ./run.sh remove-module users
```

### This is how you can create a unit test
```sh
docker-compose exec test-app ./run.sh create-unit-test MyAwesomeUnitTest
```

### This is how you can create a feature test
```sh
docker-compose exec test-app ./run.sh create-feature-test MyAwesomeFeatureTest
```

### This is how you can run tests
```sh
docker-compose exec test-app ./run.sh test
```

### This is how you can run specific tests
```sh
#Run all tests in a class
docker-compose exec test-app ./run.sh test --filter=MyAwesomeUnitTest

#Run a specific test function
docker-compose exec test-app ./run.sh test --filter=MyAwesomeUnitTest::test_example
```

### This is how you can create custom migrations
```sh
docker-compose exec test-app ./run.sh create-migration create_role_user_table
```

### Defining fields on a module
```php
# This shows an example where a case_id field is defined on a 'policy' module. This would be in a vardefs file:
# sugarcrm/web/modules/lt_policy/vardefs.php
'fields' => [
    ...
    'case_id' => [
        'type' => 'integer', //supports:  string, text, boolean
        'default' => '', //Ignored if left as an empty string ''
        'null' => true, //Specifies if the field should be nullable or have a null value when unpopulated
        'length' => 100 //Length of the field, only used for string types
    ]
]
```

### Defining relationship on a module
```php
# This shows an example where three relationships are defined on a 'policy' module. This would be in a vardefs file:
# sugarcrm/web/modules/lt_policy/vardefs.php
'related_modules' => [
    //Define a many-to-one relationship where policy belongs to premium payer
    'lt_premium_payer' => [
        'relationship_type' => 'many-to-one',
        'relation_key_lhs' => 'premium_payer_id',
    ],
    //Define a many-to-many relationship where a policy can have many dependants and dependants can be on many policies
    'lt_dependant' => [
        'relationship_type' => 'many-to-many',
        'join_table' => 'policy_dependant',
        'join_key_lhs' => 'policy_id',
        'join_key_rhs' => 'dependant_id',
    ],
    //Define a one-to-many relationship where a policy has many benefits
    'lt_benefit' => [
        'relationship_type' => 'one-to-many',
        'relation_key_rhs' => 'policy_id',
    ]
]
```

### Defining fields to show on a module view
```php
# sugarcrm/web/modules/lt_policy/vardefs.php
'detail_view_fields' => [
    ['name', 'description'],//Fields shown when viewing a bean of a module
],
'edit_view_fields' => [
    ['name', 'description'],//Fields shown when editing a bean of a module
],
'list_view_fields' => ['name', 'description'] //Fields shown when view a list of beans of a module
```

### Adding a record to a lt_person table
```php
$person = new lt_person();
$person->name = "Tadda";
$person->surname = "Ospielios";
$person->save();
```

### Load a relationship on a bean
```php
$person->load_relationship('lt_child');

//Note: lt_child is only possible to load as a relationship if its defined under `related_modules` on the lt_person module
//In this file: sugarcrm/web/modules/lt_person/vardefs.php
//You should have:
'related_modules' => [
    //Define a one-to-many relationship where person has children
    'lt_premium_payer' => [
        'relationship_type' => 'one-to-many',
        'relation_key_rhs' => 'person_id',
    ]
],
```

### Link child to person
```php
//Fetch child record
$child = new lt_child();
$child->retrieve(6);//id = 6

//Note: property `lt_child` is only available after running load_relationship: $person->load_relationship('lt_child');
$person->lt_child->add($child);
```

### unlink child from person
```php
//Fetch child record
$child = new lt_child();
$child->retrieve(6);//id = 6

//Note: property `lt_child` is only available after running load_relationship: $person->load_relationship('lt_child');
$person->lt_child->remove($child);
```


### Instructions

You work for a company that offers life insurance.

You are tasked with fixing some broken functionality on this customer relationship management (CRM) application that the company uses to manage cases, policies and customers.

Navigate the local running website (http://localhost:8000/instructions) for information on what needs to be fixed for this assignment.
FYI: Api docs are at (http://localhost:8000/api/documentation)
