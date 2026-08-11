<?php

namespace Database\Seeders;

use IbrahimBougaoua\Filawidget\Models\Field;
use IbrahimBougaoua\Filawidget\Models\Widget;
use IbrahimBougaoua\Filawidget\Models\WidgetArea;
use IbrahimBougaoua\Filawidget\Models\WidgetField;
use IbrahimBougaoua\Filawidget\Models\WidgetType;
use Illuminate\Database\Seeder;

class FilawidgetHomepageSeeder extends Seeder
{
    protected $fields;

    protected $typeIds = [];

    protected $areaIds = [];

    public function run(): void
    {
        $this->seedFields();
        $this->fields = Field::pluck('id', 'name');

        $this->seedTypes();
        $this->seedHomepage();
        $this->seedAbout();
    }

    protected function seedFields(): void
    {
        $fields = [
            'title' => 'text',
            'desc' => 'textarea',
            'image' => 'image',
            'button_label' => 'text',
            'button_url' => 'text',
            'navbar_field' => 'richeditor',
            'navbar_url' => 'richeditor',
        ];

        foreach ($fields as $name => $type) {
            Field::updateOrCreate(
                ['name' => $name],
                ['type' => $type]
            );
        }
    }

    protected function seedTypes(): void
    {
        $types = [
            'header-widget-type' => ['name' => 'Header Widget Type', 'fieldsIds' => ['title', 'button_label', 'navbar_field', 'navbar_url']],
            'hero-widget-type' => ['name' => 'Hero Widget Type', 'fieldsIds' => ['title', 'desc', 'image', 'button_label', 'button_url']],
            'cards-widget-type' => ['name' => 'Cards Widget Type', 'fieldsIds' => ['title', 'desc', 'image']],
            'footer-widget-type' => ['name' => 'Footer Widget Type', 'fieldsIds' => ['desc', 'button_label', 'button_url', 'navbar_url']],
        ];

        foreach ($types as $slug => $data) {
            $type = WidgetType::updateOrCreate(
                ['slug' => $slug],
                ['name' => $data['name'], 'fieldsIds' => collect($data['fieldsIds'])->map(fn ($f) => $this->fields[$f])->values()->all()]
            );
            $this->typeIds[$slug] = $type->id;
        }
    }

    protected function seedArea(string $identifier, string $name, int $order, ?string $description = null): void
    {
        $area = WidgetArea::updateOrCreate(
            ['identifier' => $identifier],
            ['name' => $name, 'status' => true, 'order' => $order, 'description' => $description]
        );
        $this->areaIds[$identifier] = $area->id;
    }

    protected function seedWidget(string $slug, string $area, string $type, string $name, array $fieldNames, int $order, array $values): void
    {
        $widget = Widget::updateOrCreate(
            ['slug' => $slug],
            [
                'name' => $name,
                'widget_area_id' => $this->areaIds[$area],
                'widget_type_id' => $this->typeIds[$type],
                'fieldsIds' => collect($fieldNames)->map(fn ($f) => $this->fields[$f])->values()->all(),
                'order' => $order,
                'status' => true,
            ]
        );

        WidgetField::where('widget_id', $widget->id)->delete();

        foreach ($values as $fieldName => $value) {
            WidgetField::create([
                'widget_id' => $widget->id,
                'widget_field_id' => $this->fields[$fieldName],
                'value' => $value,
            ]);
        }
    }

    protected function seedHomepage(): void
    {
        $this->seedArea('header', 'Header', 1);
        $this->seedArea('hero', 'Hero', 2);
        $this->seedArea('cards', 'Cards', 3, 'Our Features');
        $this->seedArea('footer', 'Footer', 4);

        $this->seedWidget('site-header', 'header', 'header-widget-type', 'Site Header', ['title', 'button_label', 'navbar_field', 'navbar_url'], 1, [
            'title' => ['id' => 'Widget Laravel', 'en' => 'Laravel Widgets'],
            'button_label' => ['id' => 'Hubungi Kami', 'en' => 'Contact Us'],
            'navbar_field' => [
                'id' => '<ol><li><a href="/homepage">Beranda</a></li><li><a href="/about">Tentang</a></li><li><a href="#">Hubungi</a></li></ol>',
                'en' => '<ol><li><a href="/homepage">Home</a></li><li><a href="/about">About</a></li><li><a href="#">Contact</a></li></ol>',
            ],
            'navbar_url' => [
                'id' => '<ol><li><a href="/homepage">/homepage</a></li><li><a href="/about">/about</a></li></ol>',
                'en' => '<ol><li><a href="/homepage">/homepage</a></li><li><a href="/about">/about</a></li></ol>',
            ],
        ]);

        $this->seedWidget('hero-banner', 'hero', 'hero-widget-type', 'Hero Banner', ['title', 'desc', 'image', 'button_label', 'button_url'], 1, [
            'title' => ['id' => 'Selamat Datang di Laravel + Filament', 'en' => 'Welcome to Laravel + Filament'],
            'desc' => [
                'id' => 'Setiap bagian dari halaman ini, mulai dari header sampai footer, dibangun dengan plugin Filawidget dan langsung diambil dari database Anda.',
                'en' => 'Every section of this homepage, from the header to the footer, is built with the Filawidget plugin and comes straight from your database.',
            ],
            'image' => '01KZMXF4FDHB9DDRQ4Z42HB8AX.jpg',
            'button_label' => ['id' => 'Mulai Sekarang', 'en' => 'Get Started'],
            'button_url' => '#',
        ]);

        $this->seedWidget('feature-one', 'cards', 'cards-widget-type', 'Quality Service', ['title', 'desc', 'image'], 1, [
            'title' => ['id' => 'Layanan Berkualitas', 'en' => 'Quality Service'],
            'desc' => [
                'id' => 'Kami menghadirkan kode yang rapi dan terpelihara menggunakan praktik terbaik Laravel dan Filament.',
                'en' => 'We deliver polished, maintainable code using modern Laravel and Filament best practices.',
            ],
            'image' => '01KZMSP4FKDBGJQ0G2TW2JYHAK.jpg',
        ]);

        $this->seedWidget('feature-two', 'cards', 'cards-widget-type', 'Expert Team', ['title', 'desc', 'image'], 2, [
            'title' => ['id' => 'Tim Ahli', 'en' => 'Expert Team'],
            'desc' => [
                'id' => 'Tim developer berpengalaman yang siap membantu Anda meluncurkan fitur lebih cepat.',
                'en' => 'A team of experienced developers ready to help you ship features faster.',
            ],
            'image' => '01KZMSVEWP3WR7HX6RV6K1Q5EP.jpg',
        ]);

        $this->seedWidget('feature-three', 'cards', 'cards-widget-type', 'Fast Support', ['title', 'desc', 'image'], 3, [
            'title' => ['id' => 'Dukungan Cepat', 'en' => 'Fast Support'],
            'desc' => [
                'id' => 'Dapatkan dukungan cepat dan ramah kapan pun Anda butuhkan, langsung dari dashboard Anda.',
                'en' => 'Get quick, friendly support whenever you need it, right from your dashboard.',
            ],
            'image' => '01KZMSY1SGWW72EJJJQZW1VCM1.jpg',
        ]);

        $this->seedWidget('footer-widget', 'footer', 'footer-widget-type', 'Footer Widget', ['desc', 'button_label', 'button_url', 'navbar_url'], 1, [
            'desc' => [
                'id' => '© 2026 Widget Laravel. Semua hak dilindungi. Dibangun dengan Filament + Filawidget.',
                'en' => '© 2026 Laravel Widgets. All rights reserved. Built with Filament + Filawidget.',
            ],
            'button_label' => ['id' => 'Hubungi Kami', 'en' => 'Contact Us'],
            'button_url' => '#',
            'navbar_url' => [
                'id' => '<ol><li><a href="/homepage">/homepage</a></li><li><a href="/about">/about</a></li></ol>',
                'en' => '<ol><li><a href="/homepage">/homepage</a></li><li><a href="/about">/about</a></li></ol>',
            ],
        ]);
    }

    protected function seedAbout(): void
    {
        $this->seedArea('about-hero', 'About Hero', 5);
        $this->seedArea('about-cards', 'About Cards', 6, 'Who We Are');

        $this->seedWidget('about-hero-banner', 'about-hero', 'hero-widget-type', 'About Hero Banner', ['title', 'desc', 'image', 'button_label', 'button_url'], 1, [
            'title' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
            'desc' => [
                'id' => 'Kami adalah tim developer dan desainer yang berdedikasi membangun aplikasi indah dengan Laravel dan Filament.',
                'en' => 'We are a team of developers and designers passionate about building beautiful applications with Laravel and Filament.',
            ],
            'image' => '01KZMTYKQY21VHY6HJYZ5WC5V7.jpg',
            'button_label' => ['id' => 'Hubungi Kami', 'en' => 'Contact Us'],
            'button_url' => '#',
        ]);

        $this->seedWidget('about-mission', 'about-cards', 'cards-widget-type', 'Our Mission', ['title', 'desc', 'image'], 1, [
            'title' => ['id' => 'Misi Kami', 'en' => 'Our Mission'],
            'desc' => [
                'id' => 'Memberdayakan bisnis dengan aplikasi web yang cepat, andal, dan mudah dirawat.',
                'en' => 'To empower businesses with fast, reliable and maintainable web applications.',
            ],
            'image' => '01KZMV6WKZZCJWJ1JA9GFY5B2E.jpg',
        ]);

        $this->seedWidget('about-vision', 'about-cards', 'cards-widget-type', 'Our Vision', ['title', 'desc', 'image'], 2, [
            'title' => ['id' => 'Visi Kami', 'en' => 'Our Vision'],
            'desc' => [
                'id' => 'Menjadi mitra pengembangan paling terpercaya untuk tim PHP modern di seluruh dunia.',
                'en' => 'To be the most trusted development partner for modern PHP teams worldwide.',
            ],
            'image' => '01KZMVDXY47QFKCPM8HCTD7GB3.jpg',
        ]);

        $this->seedWidget('about-values', 'about-cards', 'cards-widget-type', 'Our Values', ['title', 'desc', 'image'], 3, [
            'title' => ['id' => 'Nilai-Nilai Kami', 'en' => 'Our Values'],
            'desc' => [
                'id' => 'Inovasi, transparansi, dan fokus tanpa henti pada kualitas dalam semua yang kami buat.',
                'en' => 'Innovation, transparency and a relentless focus on quality in everything we ship.',
            ],
            'image' => '01KZMVVJRVMDAGZMDQEZ0PVF6X.jpg',
        ]);
    }
}
