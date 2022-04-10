<?php

namespace Tests\Feature;

use App\Models\Car;
use Tests\TestCase;
use Tests\Traits\SetUpAdmin;

class CarsManagementTest extends TestCase
{
    use SetUpAdmin;

    public function test_get_all_cars(): void
    {
        Car::factory(15)->create();
        $this->be($this->getAdmin());
        $this->get('/admin/cars')
            ->assertViewIs('admin.pages.car')
            ->assertViewHas(['cars']);
    }

    public function test_create_car(): void
    {
        $car = Car::factory()->make()->toArray();
        $this->be($this->getAdmin());
        $this->post('/admin/cars',$car)
            ->assertRedirect('/admin/cars');
    }

    public function test_update_exiting_car(): void
    {
        $car = Car::factory()->create();
        $carUpdateData = Car::factory()->make()->toArray();
        $this->be($this->getAdmin());
        $this->put('/admin/cars/'.$car->id,$carUpdateData)
            ->assertRedirect('/admin/cars');
    }

    public function test_update_non_existing_car(): void
    {
        $this->be($this->getAdmin());
        $carUpdateData = Car::factory()->make()->toArray();
        $this->put('/admin/cars/0',$carUpdateData)
            ->assertNotFound();
    }

    public function test_delete_existing_car(): void
    {
        $car = Car::factory()->create();
        $this->be($this->getAdmin());
        $this->delete('/admin/cars/'.$car->id)
            ->assertRedirect('/admin/cars');
    }

    public function test_delete_non_existing_car(): void
    {
        $this->be($this->getAdmin());
        $this->delete('/admin/cars/0')
            ->assertNotFound();
    }
}
