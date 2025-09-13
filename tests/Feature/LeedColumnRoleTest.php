<?php

namespace Tests\Feature;

use App\Models\LeedColumn;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeedColumnRoleTest extends TestCase
{
////    /**
////     * A basic feature test example.
////     */
////    public function test_example(): void
////    {
////        $response = $this->get('/');
////
////        $response->assertStatus(200);
////    }
//
//
//    use RefreshDatabase;
//
//    #[Test]
//    public function it_can_assign_role_to_column()
//    {
//        $column = LeedColumn::factory()->create();
//        $role = Role::factory()->create(['name' => 'manager']);
//
//        $column->assignRole($role);
//
//        $this->assertTrue($column->hasRole('manager'));
//        $this->assertCount(1, $column->roles);
//    }
//
//    #[Test]
//    public function it_can_check_role_access()
//    {
//        $column = LeedColumn::factory()->create();
//        $role = Role::factory()->create(['name' => 'admin']);
//        $column->roles()->attach($role);
//
//        $this->assertTrue($column->hasRole('admin'));
//        $this->assertFalse($column->hasRole('manager'));
//    }
//
}
