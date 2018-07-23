<?php

namespace Tavo\EcLaravelValidator\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Tavo\EcLaravelValidator\EcValidatorServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [EcValidatorServiceProvider::class];
    }
}
