<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('widget_fields', function (Blueprint $table) {
            $table->index('widget_id');
            $table->index('widget_field_id');
            $table->dropPrimary();
            $table->id()->first();
            $table->unsignedInteger('position')->default(0)->after('value');
        });
    }

    public function down()
    {
        Schema::table('widget_fields', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn(['id', 'position']);
            $table->primary(['widget_id', 'widget_field_id']);
            $table->dropIndex(['widget_id']);
            $table->dropIndex(['widget_field_id']);
        });
    }
};
