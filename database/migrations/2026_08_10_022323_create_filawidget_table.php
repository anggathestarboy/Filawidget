<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->integer('order')->default(0);
            $table->integer('child_order')->default(0);
            $table->boolean('status')->default(false);
            $table->foreignId('parent_id')->nullable()->constrained('pages')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('widget_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identifier')->unique();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('widget_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->json('config')->nullable();
            $table->text('fieldsIds')->nullable();
            $table->timestamps();
        });

        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->json('options')->nullable();
            $table->timestamps();
        });

        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(false);
            $table->foreignId('widget_area_id')->constrained('widget_areas')->onDelete('cascade');
            $table->foreignId('widget_type_id')->constrained('widget_types')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('widget_fields', function (Blueprint $table) {
            $table->longText('value')->nullable();
            $table->foreignId('widget_id')->constrained('widgets')->onDelete('cascade');
            $table->foreignId('widget_field_id')->constrained('fields')->onDelete('cascade');
            $table->primary(['widget_id', 'widget_field_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('widgets');
        Schema::dropIfExists('fields');
        Schema::dropIfExists('widget_fields');
        Schema::dropIfExists('widget_areas');
        Schema::dropIfExists('widget_types');
    }
};
