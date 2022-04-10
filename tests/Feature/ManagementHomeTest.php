<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\SetUpAdmin;

class ManagementHomeTest extends TestCase
{
    use SetUpAdmin;

    public function test_index_view_is_shown()
    {
        $this->be($this->getAdmin());
        $this->get('/admin/')
            ->assertViewIs('admin.pages.home');
    }
}
