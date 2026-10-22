<?php

namespace Tavo\EcLaravelValidator\Tests;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Tavo\EcLaravelValidator\EcValidatorServiceProvider;

abstract class TestCase extends PHPUnitTestCase
{
    protected Container $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = new Container();
        $translator = new Translator(new ArrayLoader(), 'en');
        $this->app->instance('validator', new Factory($translator, $this->app));

        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->app);

        $provider = new EcValidatorServiceProvider($this->app);
        $provider->register();
        $provider->boot();
    }

    protected function tearDown(): void
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication(null);
        $this->app->flush();

        parent::tearDown();
    }
}
