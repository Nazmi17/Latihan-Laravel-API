<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->float("price");      
            $table->timestamps();
        });

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Product::create([
                "name" => $faker->name(),
                "description" => $faker->sentence(5, true),
                "price" => $faker->randomFloat(2, 0, 1000),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
