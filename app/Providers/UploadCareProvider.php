<?php

namespace AI\Providers;

use Silex\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;

class UploadCareProvider implements ServiceProviderInterface, BootableProviderInterface {

  public function register(Container $app) {
    $app['uploadcare'] = $app->protect(function () use ($app) {
        return new \Uploadcare\Api('121545454521', 'dff547584545212121');
    });
  }

  public function boot(Application $app) {

  }

}


 ?>
