<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->string('vendor_id')->unique()->primary();
            $table->string('vendor_name');
            $table->text('vendor_desc');
            $table->string('vendor_icon')->nullable();
            $table->string('vendor_banner')->nullable();
            $table->text('vendor_gallery')->nullable();
            $table->string('vendor_phone')->unique()->nullable();
            $table->string('vendor_email')->unique()->nullable();
            $table->string('vendor_password')->nullable();
            $table->string('vendor_lat')->nullable();
            $table->string('vendor_long')->nullable();
            $table->string('vendor_postal_code')->nullable();
            $table->string('vendor_adderss')->nullable();
            $table->string('vendor_distance')->nullable();
            $table->text('vendor_token')->nullable();
            $table->integer('vendor_feature')->comment('1:yes,2:no')->nullable();
            $table->integer('vendor_status')->comment('1:active,0:deactive')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
