<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_services_api_lists_all_ten_services(): void
    {
        $this->getJson('/api/services')->assertOk()->assertJsonCount(10);
    }

    public function test_single_service_can_be_loaded_by_slug(): void
    {
        $this->getJson('/api/services/seo')->assertOk()->assertJsonPath('title', 'SEO');
        $this->getJson('/api/services/does-not-exist')->assertNotFound();
    }

    public function test_pricing_api_returns_nine_plans(): void
    {
        $this->getJson('/api/pricing')->assertOk()->assertJsonCount(9);
    }

    public function test_projects_api_returns_the_portfolio(): void
    {
        $this->getJson('/api/projects')->assertOk()->assertJsonCount(9);
    }

    public function test_contact_form_saves_a_message(): void
    {
        $this->postJson('/api/contact', [
            'name' => 'Ali Khan',
            'email' => 'ali@example.com',
            'services' => ['seo', 'web-design'],
            'message' => 'I need a new website for my shop.',
        ])->assertCreated();

        $this->assertDatabaseHas('contact_messages', ['email' => 'ali@example.com']);
    }

    public function test_contact_form_rejects_missing_fields(): void
    {
        $this->postJson('/api/contact', ['name' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function test_pages_have_seo_tags_in_the_html(): void
    {
        $this->withoutVite();

        $this->get('/pricing')
            ->assertOk()
            ->assertSee('<title>Pricing — Web, Design &amp; Marketing Plans | GrowmioTech</title>', false)
            ->assertSee('<link rel="canonical" href="'.rtrim(config('app.url'), '/').'/pricing">', false)
            ->assertSee('"@type":"FAQPage"', false);

        $this->get('/services/seo')->assertOk()->assertSee('<h1>SEO</h1>', false)->assertSee('"@type":"Service"', false);
    }

    public function test_unknown_pages_return_404_and_are_not_indexed(): void
    {
        $this->withoutVite();

        $this->get('/no-such-page')->assertNotFound()->assertSee('noindex', false);
        $this->get('/services/no-such-service')->assertNotFound();
    }

    public function test_sitemap_and_robots_are_served(): void
    {
        $this->get('/sitemap.xml')->assertOk()->assertSee('/services/seo', false)->assertSee('/portfolio', false);
        $this->get('/robots.txt')->assertOk()->assertSee('Sitemap:', false);
    }
}
