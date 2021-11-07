<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_visit_tasks_page(): void
    {
        /** @var Authenticatable $user */
        $user = User::factory()->make();

        $this->actingAs($user);

        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas(['tasks']);
    }

    public function test_visit_tasks_create_page(): void
    {
        /** @var Authenticatable $user */
        $user = User::factory()->make();

        $this->actingAs($user);

        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
    }

    public function test_adding_new_task(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->followingRedirects();
        $response = $this->post(route('tasks.store'), ['task' => $task]);
        $response->assertStatus(200);
    }

    public function test_visit_tasks_edit_page(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->get(route('tasks.edit', ['task' => $task]));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.edit');
        $response->assertViewHas(['task']);
    }
    // edit task test - post
    public function test_updating_task(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->followingRedirects();
        $response = $this->put(route('tasks.update', ['task' => $task]));
        $response->assertStatus(200);
    }

    // delete task - delete
    public function test_deleting_task(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->followingRedirects();
        $response = $this->delete(route('tasks.destroy', ['task' => $task]));
        $response->assertStatus(200);
    }

    public function test_mark_task_as_completed(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->followingRedirects();
        $response = $this->post(route('tasks.complete', $task));
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
           'id' => $task->id,
           'completed_at' => now()
        ]);
    }
}
