<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exhibitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_id')->cascadeOnDelete();
            $table->string('title');
            $table->longText('description');
            $table->string('location');
            $table->string('thumbnail_image')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('tags')->nullable();
            $table->integer('views');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropForeign('exhibitions_user_id_foreign');
            $table->dropColumn('user_id');

            $table->dropForeign('exhibitions_type_id_foreign');
            $table->dropColumn('type_id');
        });

        Schema::dropIfExists('exhibitions');
    }
};
