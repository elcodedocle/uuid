uuid class
==========
#####*Universal Unique Identifier v3, v4 and v5 generator*
 Copyright: The PHP Documentation Group<br />
 License: Creative Commons Attribution 3.0 License
 
### How to use



```php
use synapp\info\tools\uuid\uuid;

require_once 'vendor/elcodedocle/uuid/uuid.php';

//Named-based UUID:
$v3uuid = uuid::v3(uuid::v4(), 'BlahBlahSomeRandomStringBlergBlorg');
$v5uuid = uuid::v5(uuid::v4(), 'BlahBlahSomeRandomStringBlergBlorg');

//Pseudo-random UUID:
$v4uuid = uuid::v4();

echo 'UUIDv3: '.$v3uuid."\n".'UUIDv4: '.$v4uuid."\n".'UUIDv5: '.$v5uuid."\n";
```

### Motivation

I needed a UUID generator I could import as a dependency on my projects, so I 
took the one from the 
[PHP manual](http://www.php.net/manual/en/function.uniqid.php#94959), added a 
composer.json and this README.md and uploaded it to this repo.

### Acks

- The [OSF](http://www.opengroup.org/), for developing the UUID standards 

- Andrew Moore, the class author (obviously) 

- [The PHP Documentation Group](http://php.net/docs.php)


Enjoy!

