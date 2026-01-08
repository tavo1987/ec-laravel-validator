<?php

namespace Tavo\EcLaravelValidator\Tests;

use Error;
use PHPUnit\Framework\Attributes\Test;

class CustomValidationRulesTest extends TestCase
{
    #[Test]
    public function valid_ci(): void
    {
        $data = [
            'ci' => '0926687856',
        ];

        $rules = [
            'ci' => 'ecuador:ci',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertTrue($v->passes());
    }

    #[Test]
    public function invalid_ci(): void
    {
        $rules = [
            'ci' => 'ecuador:ci',
        ];

        $data = [
            'ci' => '0926687858',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());
    }

    #[Test]
    public function valid_ruc(): void
    {
        $rules = [
            'ruc' => 'ecuador:ruc',
        ];

        $data = [
            'ruc' => '0926687856001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertTrue($v->passes());
    }

    #[Test]
    public function invalid_ruc(): void
    {
        $rules = [
            'ruc' => 'ecuador:ruc',
        ];

        $data = [
            'ruc' => '09266878560001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());
    }

    #[Test]
    public function valid_ruc_for_private_companies(): void
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spriv',
        ];

        $data = [
            'ruc' => '0992397535001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertTrue($v->passes());
    }

    #[Test]
    public function invalid_ruc_for_private_companies(): void
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spriv',
        ];

        $data = [
            'ruc' => '09923975350020',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());
    }

    #[Test]
    public function valid_ruc_for_public_companies(): void
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spub',
        ];

        $data = [
            'ruc' => '1760001550001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertTrue($v->passes());
    }

    #[Test]
    public function invalid_ruc_for_public_companies(): void
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spub',
        ];

        $data = [
            'ruc' => '17600015500010',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());
    }

    #[Test]
    public function invalid_attribute_throws_an_error(): void
    {
        $this->expectException(Error::class);

        $rules = [
            'ruc' => 'ecuador:fake',
        ];

        $data = [
            'ruc' => '17600015500010',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $v->validate();
    }
}
