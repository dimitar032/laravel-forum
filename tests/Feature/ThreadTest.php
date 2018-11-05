<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
	use DatabaseMigrations;

	protected $thread;

	public function setUp(){
		parent::setUp();

		$this->thread = factory('App\Thread')->create();
	}


	/** @test */
	public function a_user_see_all_threads()
	{
		$this->get('/threads')
		->assertSee($this->thread->title)
		->assertSee($this->thread->body);
	}

	/** @test */
	public function a_user_can_see_single_thread()
	{
		$this->get('/threads/'.$this->thread->id)
		->assertSee($this->thread->title)
		->assertSee($this->thread->body);
	}

	/** @test */
	public function a_user_can_read_replies_that_are_associated_with_a_thread()
	{
		$reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

		$this->get('/threads/'.$this->thread->id)
		->assertSee($reply->body);
	}
}

