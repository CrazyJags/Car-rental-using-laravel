<?php

namespace Tests\Feature\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Tests\Traits\SetUpAdmin;

class AdminMiddlewareTest extends TestCase
{
    use SetUpAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        Route::middleware('admin')->any('/test', fn() => response()->json(['message' => 'Ok']));
    }

    /**
     * @dataProvider httpMethodsProvider
     */
    public function test_redirect_with_no_user_in_request(string $httpVerb): void
    {
        $this->$httpVerb('/test')
            ->assertRedirect('/admin/login');
    }

    /**
     * @dataProvider httpMethodsProvider
     */
    public function test_forbidden_with_user_role(string $httpVerb): void
    {
        $this->actingAs(User::factory()->make());
        $this->$httpVerb('/test')
            ->assertRedirect('/admin/login');
    }

    /**
     * @dataProvider httpMethodsProvider
     */
    public function test_allowed_with_admin_role(string $httpVerb)
    {
        $this->actingAs($this->getAdmin());
        $this->$httpVerb('/test')
            ->assertOk()
            ->assertExactJson(['message' => 'Ok']);
    }

    public static function httpMethodsProvider(): array
    {
        return [["get"], ["post"], ["put"], ["patch"], ["delete"], ["options"]];
    }
}
