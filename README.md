uuid class
==========
#####*Universal Unique Identifier v3, v4 and v5 generator*
 Copyright: The PHP Documentation Group<br />
 License: Creative Commons Attribution 3.0 License
 
### How to use

Named-based UUID.
 
 $v3uuid = UUID::v3(UUID::v4(), 'BlahBlahSomeRandomStringBlergBlorg');
 $v5uuid = UUID::v5(UUID::v4(), 'BlahBlahSomeRandomStringBlergBlorg');
 
 Pseudo-random UUID
 
 $v4uuid = UUID::v4();
 *
 This class was taken from 

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

