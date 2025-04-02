<?php

use App\Enums\PropertyStatusEnum;
use App\Enums\PropertyTypeEnum;
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
        Schema::create('properties', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->string('address');
            $table->string('city');
            $table->string('postal_code', 10);
            $table->integer('square_meters');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->enum('type', PropertyTypeEnum::getValues());
            $table->boolean('for_sale')->default(false);
            $table->boolean('for_rent')->default(false);
            $table->enum('status', PropertyStatusEnum::getValues())->default(PropertyStatusEnum::AVAILABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
