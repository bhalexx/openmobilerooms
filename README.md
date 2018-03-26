# OpenMobileRooms

### Introduction
This project is an example of Bilemo B2B partner application using [Bilemo REST API][1] as part of my 7th [OpenClassRooms](https://openclassrooms.com/) PHP/Symfony Developer project. This application is built with **Symfony 3.4**.

Read instructions below to fork this application and become a Bilemo partner.

### Prerequisites
- PHP >=5.5.9
- MySQL
- [Composer][2] to install Symfony 3.4 and project dependencies

### Dependencies
This project uses:
- [FOSUserBundle][3] for user management
- [CsaGuzzleBundle][4] a PHP HTTP client that makes it easy to send HTTP requests to call Bilemo API

Those dependencies are included in composer.json.

This project also uses:
- [WebPack Encore][5] for assets management
- [bootstrap-sass][6] Bootstrap SASS library
- [sass-loader][7] to compile your SCSS files to CSS

Those dependencies are included in package.json

### Installation
First of all, follow [Bilemo API instructions][8] to add your application as a Bilemo partner and get credentials you will need later:
```
client_id: {YourClientId}
client_secret: {YourClientSecret}
username: {YourApplicationName}
password: {YourPassword}
```
Once you got your credentials, you can go on:

1. Clone this repository on your local machine by using this command line in your folder `git clone https://github.com/bhalexx/openmobilerooms.git`.
2. Rename `app/config/parameters.yml.dist` in `app/config/parameters.yml`, edit database parameters with yours and fill parameters with the credentials you got from Bilemo.
3. Edit API URI (e.g.: URI from your forked [API project][1]) from `config(_dev).yml` in `csa_guzzle` section (parameter `base_uri`).
5. In project folder open a new terminal window and execute command line `composer install`. 
6. Then execute command line `npm install` to install node modules for assets management.

**Your project is ready to be run!**

### Customization
Assets are located in `app\Resources\assets`, and minified and built by Encore in `web\build`. To add/edit or any other configuration customization, look at `webpack.config.js`!

You can modify the max number of mobiles by editing `mobile_limit` in `config.yml`.

### Documentation
This application project is as documented as possible, so you can find:
- some [diagrams][9] to explain how the application communicates with the API
- [API documentation][10]

### Related projects
Two other projects were created to complete this 7th project:
- [Bilemo][11] - the Bilemo REST API
- [Bilemo Admin][12] - the Bilemo administration application

[1]: https://github.com/bhalexx/bilemo
[2]: https://getcomposer.org/
[3]: https://github.com/FriendsOfSymfony/FOSUserBundle
[4]: https://github.com/csarrazi/CsaGuzzleBundle
[5]: https://github.com/symfony/webpack-encore
[6]: https://github.com/twbs/bootstrap-sass
[7]: https://github.com/webpack-contrib/sass-loader
[8]: https://github.com/bhalexx/bilemo#authentication-to-access-api
[9]: https://github.com/bhalexx/openmobilerooms/tree/master/diagrams
[10]: https://github.com/bhalexx/bilemo#documentation
[11]: https://github.com/bhalexx/bilemo
[12]: https://github.com/bhalexx/bilemo_admin