var Encore = require('@symfony/webpack-encore');

const CopyWebpackPlugin = require('copy-webpack-plugin');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')
    .addStyleEntry('home', './assets/scss/home.scss')
    .addStyleEntry('base', './assets/scss/base.scss')
    .addStyleEntry('contact', './assets/scss/contact.scss')
    .addStyleEntry('cv', './assets/scss/cv.scss')
    .addStyleEntry('project', './assets/scss/project.scss')
    .addStyleEntry('login', './assets/scss/login.scss')
    .addStyleEntry('admin_project', './assets/scss/admin_project.scss')
    .addStyleEntry('admin_form', './assets/scss/admin_form.scss')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('homejs', './assets/js/home.js')
    .addEntry('basejs', './assets/js/base.js')
    .addEntry('contactjs', './assets/js/contact.js')
    .addEntry('cvjs', './assets/js/cv.js')
    .addEntry('projectjs', './assets/js/project.js')
    .addEntry('loginjs', './assets/js/login.js')
    .addEntry('admin_projectjs', './assets/js/admin_project.js')
    .addEntry('admin_formjs', './assets/js/admin_form.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')

    //Plugin
    .addPlugin( new CopyWebpackPlugin([
        { from : './assets/static/img', to: 'img'},
        { from : './assets/static/fonts', to: 'fonts'}
    ]))
;
Encore.configureWatchOptions(watchOptions => {
    watchOptions.poll = 250; // check for changes every 250 milliseconds
});

module.exports = Encore.getWebpackConfig();
