<?php

namespace Tavo\EcLaravelValidator\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Tavo\EcLaravelValidator\EcValidatorServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [EcValidatorServiceProvider::class];
    }
}
