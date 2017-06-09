<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Loader;

/**
 * Define some useful constants
 */
define('BASE_DIR', dirname(__DIR__));
define('APP_DIR', BASE_DIR . '/app');

// Set false if production mode
define('IS_DEVELOPMENT', true);

error_reporting(E_ALL);
if (IS_DEVELOPMENT)
    ini_set('display_errors', 1);


try {

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new FactoryDefault();

    /**
     * Reading config
     */
    $config = include APP_DIR . '/config/config.php';

    $loader = new Loader();

    /**
     * We're a registering a set of directories taken from the configuration file
     */
    $loader->registerNamespaces([
        'Application\Models'      => $config->application->modelsDir,
        'Application\Controllers' => $config->application->controllersDir,
        'Application\Forms'       => $config->application->formsDir,
        'Application\Lib'         => $config->application->libraryDir
     ]);

    $loader->register();

    // Use composer autoloader to load vendor classes
    require_once BASE_DIR . '/vendor/autoload.php';

    /**
     * Register the global configuration as config
     */
    $di->setShared('config', $config);

    /**
     * Dispatcher use a default namespace
     */
    $di->set('dispatcher', function () {
        $evManager = $this->getShared('eventsManager');
        $evManager->attach("dispatch:beforeException", function($event, $dispatcher, $exception) {
            switch ($exception->getCode()) {
                case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward(array(
                        'controller' => 'index',
                        'action'     => 'notfound',
                    ));
                    return false;
            }
        });
        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($evManager);
        $dispatcher->setDefaultNamespace('Application\Controllers');
        return $dispatcher;
    });

    /**
     * The URL component is used to generate all kind of urls in the application
     */
    $di->setShared('url', function () use ($config) {
        $url = new Url();
        $url->setBaseUri($config->baseUri);
        return $url;
    });

    /**
     * Setting up the view component
     */
    $di->set('view', function () use ($config) {
        $view = new View();
        $view->setViewsDir($config->application->viewsDir);
        $view->registerEngines(array(
            '.volt' => function ($view, $di) use ($config)  {
                $volt = new Volt($view, $di);
                $volt->setOptions(array(
                    'compiledPath' => function ($templatePath) use ($config) {
                        $dirName = explode('/',dirname($templatePath));
                        krsort($dirName);
                        $dirName = array_values($dirName);
                        if (!is_dir($config->application->cacheDir."volt/" . $dirName[0]))
                            mkdir($config->application->cacheDir."volt/" . $dirName[0], 0777, true);
                        return $config->application->cacheDir."volt/" . $dirName[0] . '/' . basename($templatePath) . '.php';
                    },
                    'compiledSeparator' => '_',
                ));
                $compiler = $volt->getCompiler();
                $compiler->addFunction('truncate', 'Application\Lib\TextTools::truncate');
                $compiler->addFunction('rand', 'Application\Lib\TextTools::rand');
                $compiler->addFunction('jdate', 'Application\Lib\JDate::date');
                $compiler->addFilter('farsi_num', function ($str) {
                    return 'str_replace(array("0","1","2","3","4","5","6","7","8","9"), array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹"), '.$str.')';
                });
                return $volt;
            }
        ));
        return $view;
    }, true);

    /**
     * Database connection is created based in the parameters defined in the configuration file
     */
    $di->set('db', function () use ($config) {
        return new Mysql([
            'host' => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname' => $config->database->dbname,
        ]);
    });

    /**
     * If the configuration specify the use of metadata adapter use it or use memory otherwise
     */
    $di->set('modelsMetadata', function () use ($config) {
        if (!is_dir($config->application->cacheDir . 'metaData/'))
            mkdir($config->application->cacheDir . 'metaData/', 0777, true);
        return new MetaDataAdapter([
            'metaDataDir' => $config->application->cacheDir . 'metaData/'
        ]);
    });

    /**
     * Start the session the first time some component request the session service
     */
    $di->set('session', function () {
        $session = new SessionAdapter();
        $session->start();
        return $session;
    });

    /**
     * Loading routes from the routes.php file
     */
    $di->set('router', function () {
        return require APP_DIR . '/config/routes.php';
    });

    /**
     * Flash service with custom CSS classes
     */
    $di->set('flash', function () {
        return new Flash([
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
    });

    /**
     * Flash service base on user session with custom CSS classes
     */
    $di->set('flashSession', function () {
        return new FlashSession(array(
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ));
    });

    /**
     * Support Jalali date as a component
     */
    $di->set('jdate', function () {
        return new \Application\Lib\JDate();
    });

    /**
    * Handle the request
    */
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (Exception $e) {
    error_log("Exception: ".$e->getMessage()." in: ".$e->getFile()." line: ".$e->getLine()." trace: ".$e->getTraceAsString());
    echo "<h3><center>متاسفانه مشکلی پیش آمده است 😢</center></h3><h5><center>لطفا مجددا تلاش کنید 🌹</center></h5>";
    if (IS_DEVELOPMENT){
        echo $e->getMessage(), '<br>';
        echo nl2br(htmlentities($e->getTraceAsString()));
    }
}
