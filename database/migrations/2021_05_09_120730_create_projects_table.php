<?php

use App\Enum\DocumentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->foreignId('creator_id')->references('id')->on('users');
            $table->unsignedDouble('price')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->json('files')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string("status")->default( DocumentStatus::IN_SEARCH);
            $table->foreignId("executor_id")->nullable()->constrained("users");
            $table->foreignId("city_id")->constrained("cities");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
