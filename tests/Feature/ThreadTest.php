<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function a_user_see_all_threads()
	{
		$thread = factory('App\Thread')->create();

		$response = $this->get('/threads');

		$response->assertSee($thread->title);
		$response->assertSee($thread->body);
	}

	/** @test */
	public function a_user_can_see_single_thread()
	{
		$thread = factory('App\Thread')->create();

		$response = $this->get('/threads/'.$thread->id);

		$response->assertSee($thread->title);
		$response->assertSee($thread->body);
	}
}

