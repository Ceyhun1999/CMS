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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // Основные данные
            $table->string('title', 255);             // Имя (max 255)
            $table->string('slug', 255)->unique();    // Альтернативное имя (max 255)
            $table->text('description')->nullable();  // HTML описание (max 65535, в форме 5000)

            // Иконки (одна или несколько)
            $table->json('icons')->nullable();

            // Родительская категория
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();

            // SEO
            $table->string('meta_title', 255)->nullable();       // max 255
            $table->string('meta_description', 500)->nullable(); // max 500
            $table->string('meta_keywords', 500)->nullable();    // max 500

            // Настройки новостей
            $table->string('news_sort_field', 50)->default('created_at'); // max 50
            $table->enum('news_sort_order', ['asc', 'desc'])->default('desc');
            $table->boolean('include_subcategories')->default(true);
            $table->unsignedInteger('news_per_page')->default(10);

            // Системные
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
