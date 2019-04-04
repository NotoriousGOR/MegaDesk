# MegaDesk

The project is a fully featured call center based ticket system using Laravel 5.7 + Node w/ Vue.js. The system is unique in that weekends are not used towards counting the age of the ticket. The system uses Bootstrap as the CSS framework, but was designed and developed by me, NotoriousGOR. 

## Getting Started

  You're going to want Node installed along with PHP and composer with a MySQL database (or whatever of your choosing). 

### Installing

You're going to want to make sure to change ```.env.example``` to ```.env``` with the changes your system requires (ie. Passwords)

#### Step 1
```
composer install
```

#### Step 2
```
artisan key:generate
```

#### Step 3
```
npm i
```

## Deployment

#### Step 1
```
php artisan serve
```

##### hint:
If you want to host dev build on your machine and access it through another device use the ```--host (your ip) --port 80``` flags

#### Step 2
```
artisan key:generate
```

## Built With

* [Laravel](https://laravel.com/docs/5.7) - Backend PHP Framework used
* [Node](https://nodejs.org/en/) - Front End Management
* [Vue.js](https://vuejs.org/) - Front End JS Framework
* [BootStrap 4](https://getbootstrap.com/docs/4.3/getting-started/introduction/) - CSS Framework

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Gabriel Rosales** - *Initial work* - [Gabriel Rosales](https://github.com/NotoriousGOR)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Bootstrap
* Tons of resources
