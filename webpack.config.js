var Encore = require('@symfony/webpack-encore');

var devPath = '/symfony/openmobilerooms/web/build';
var prodPath = '/web/build';
var path = Encore.isProduction() ? prodPath : devPath;

Encore
    // directory where all compiled assets will be stored
    .setOutputPath('web/build/')

    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath(path)

    // this is now needed so that you manifest.json keys are still 'build/foo.js' // i.e. you want need to change anything in your Symfony app
    .setManifestKeyPrefix('build')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // will output as web/build/global.css
    .addStyleEntry('global', './app/Resources/assets/scss/global.scss')

    // allow sass/scss files to be processed
    .enableSassLoader()

    // allow legacy applications to use $/jQuery as a global variable    
    // .autoProvidejQuery()

    .enableSourceMaps(!Encore.isProduction())

    // create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
;

// export the final configuration
module.exports = Encore.getWebpackConfig();