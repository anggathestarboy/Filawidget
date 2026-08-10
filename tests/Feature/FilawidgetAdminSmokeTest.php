<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilawidgetAdminSmokeTest extends TestCase
{
    public function test_admin_widget_pages_render(): void
    {
        $user = User::factory()->create();

        config(['app.env' => 'local']);

        $this->actingAs($user)
            ->get('/admin/widgets')
            ->assertOk();

        $create = $this->actingAs($user)
            ->get('/admin/widgets/create')
            ->assertOk();

        $create->assertSee('Indonesia');
        $create->assertSee('English');

        $edit = $this->actingAs($user)
            ->get('/admin/widgets/5/edit')
            ->assertOk();

        file_put_contents(sys_get_temp_dir() . '/editpage.html', $edit->getContent());

        $edit->assertSee('[ID]', false);
        $edit->assertSee('[EN]', false);
        $edit->assertSee('Widget Laravel', false);
        $edit->assertSee('Laravel Widgets', false);
    }
}
