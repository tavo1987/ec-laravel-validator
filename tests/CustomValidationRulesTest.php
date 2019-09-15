<?php

namespace Tavo\EcLaravelValidator\Tests;

use Error;

class CustomValidationRulesTest extends TestCase

{   /** @test */
    function valid_ci()
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

    /** @test */
    function invalid_ci()
    {
        $rules = [
            'ci' => 'ecuador:ci',
        ];

        $data = [
            'ci'=> '0926687858',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());

    }

    /** @test */
    function valid_ruc()
    {
        $rules = [
            'ruc' => 'ecuador:ruc',
        ];

        $data = [
            'ruc'=> '0926687856001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertTrue($v->passes());

    }

    /** @test */
    function invalid_ruc()
    {
        $rules = [
            'ruc' => 'ecuador:ruc',
        ];

        $data = [
            'ruc'=> '09266878560001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());

    }

    /** @test */
    function valid_ruc_for_private_companies()
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spriv',
        ];

        $data = [
            'ruc'=> '0992397535001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertTrue($v->passes());

    }

    /** @test */
    function invalid_ruc_for_private_companies()
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spriv',
        ];

        $data = [
            'ruc'=> '09923975350020',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());

    }

    /** @test */
    function valid_ruc_for_public_companies()
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spub',
        ];

        $data = [
            'ruc'=> '1760001550001',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertTrue($v->passes());

    }

    /** @test */
    function invalid_ruc_for_public_companies()
    {
        $rules = [
            'ruc' => 'ecuador:ruc_spub',
        ];

        $data = [
            'ruc'=> '17600015500010',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $this->assertFalse($v->passes());

    }

    /** @test */
    function invalid_attribute_throw_an_error()
    {
        $this->expectException(Error::class);

        $rules = [
            'ruc' => 'ecuador:fake',
        ];

        $data = [
            'ruc'=> '17600015500010',
        ];

        $v = $this->app['validator']->make($data, $rules);

        $v->validate();
    }
}
