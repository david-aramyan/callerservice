<?php

namespace Test\Unit;

use App\Caller;

class CallerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test getting any result.
     */
    public function testGetAllResults()
    {
        $caller = new Caller;
        $caller->make('https://api.github.com/users', 'get');

        $this->assertNotEmpty($caller->get());
    }

    /**
     * Test that response has all fields
     */
    public function testResultFields()
    {
        $caller = new Caller;
        $caller->make('https://api.github.com/users', 'get');
        $data = $caller->get();

        $this->assertNotFalse(strpos($data, 'login'));
        $this->assertNotFalse(strpos($data, 'url'));
        $this->assertNotFalse(strpos($data, 'id'));
        $this->assertNotFalse(strpos($data, 'node_id'));
        $this->assertNotFalse(strpos($data, 'avatar_url'));
        $this->assertNotFalse(strpos($data, 'gravatar_id'));
        $this->assertNotFalse(strpos($data, 'html_url'));
        $this->assertNotFalse(strpos($data, 'followers_url'));
        $this->assertNotFalse(strpos($data, 'following_url'));
        $this->assertNotFalse(strpos($data, 'gists_url'));
        $this->assertNotFalse(strpos($data, 'starred_url'));
        $this->assertNotFalse(strpos($data, 'subscriptions_url'));
        $this->assertNotFalse(strpos($data, 'organizations_url'));
        $this->assertNotFalse(strpos($data, 'repos_url'));
        $this->assertNotFalse(strpos($data, 'events_url'));
        $this->assertNotFalse(strpos($data, 'received_events_url'));
        $this->assertNotFalse(strpos($data, 'type'));
        $this->assertNotFalse(strpos($data, 'site_admin'));
    }

    /**
     * Test that response has selected fields
     */
    public function testSelectedFields()
    {
        $caller = new Caller;
        $caller->make('https://api.github.com/users', 'get');
        $data = $caller->only(['login','url']);

        $this->assertNotFalse(strpos($data, 'login'));
        $this->assertNotFalse(strpos($data, 'url'));
    }

    /**
     * Test that response has only selected fields
     */
    public function testSelectedFieldsOnly()
    {
        $caller = new Caller;
        $caller->make('https://api.github.com/users', 'get');
        $data = $caller->only(['login','url']);

        $this->assertNotFalse(strpos($data, 'login'));
        $this->assertNotFalse(strpos($data, 'url'));
        $this->assertFalse(strpos($data, 'id'));
    }

    /**
     * Test filtering results
     */
    public function testConditionalSelection()
    {
        $caller = new Caller;
        $caller->make('https://api.github.com/users', 'get');
        $caller->where('site_admin','=', false);
        $caller->where('url','>', 'https://api.github.com/users/anotherjesse');
        $caller->where('id','=', 4);
        $data = json_decode($caller->get(),true);
        $data = current($data);
        $this->assertFalse($data['site_admin'], false);
        $this->assertEquals($data['id'], 4);
        $this->assertGreaterThan('anotherjesse',$data['login']);
    }

    /**
     * Test Ascending sorted results
     */
    public function testAscendingSortedResults()
    {
        $caller = new Caller;
        $caller->make('https://api.github.com/users', 'get');
        $caller->sort('login','ASC');
        $data = json_decode($caller->get(),true);

        (count($data) < 2) ? $this->assertTrue($data, true) : $this->assertGreaterThan($data[0]['login'], $data[1]['login']);
    }

    /**
     * Test Descending sorted results
     */
    public function testDescendingSortedResults()
    {
        $caller = new Caller;
        $caller->make('https://api.github.com/users', 'get');
        $caller->sort('login','DESC');
        $data = json_decode($caller->get(),true);

        (count($data) < 2) ? $this->assertTrue($data, true) : $this->assertLessThan($data[0]['login'], $data[1]['login']);
    }
}
