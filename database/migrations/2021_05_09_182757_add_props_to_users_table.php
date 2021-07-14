<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("image")->nullable();
            $table->string("family_name");
            $table->string("company_name")->nullable();
            $table->text("description")->nullable();
//            $table->decimal("rating")->nullable();
            $table->foreignId("city_id")->nullable()->constrained("cities");
            $table->dateTime("work_since")->nullable();
            $table->foreignId("user_type_id")->constrained("user_types");
            $table->string("phone")->nullable();
            $table->string("website")->nullable();
            $table->decimal("balance")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("image");
            $table->dropColumn("family_name");
            $table->dropColumn("company_name");
            $table->dropColumn("description");
            $table->dropColumn("rating");
            $table->dropForeign(["city_id"]);
            $table->dropColumn("city_id");
            $table->dropColumn("work_since");
            $table->dropForeign(["user_type_id"]);
            $table->dropColumn("user_type_id");
        });
    }
}
