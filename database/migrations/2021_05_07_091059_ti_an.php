<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiAn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ti_an', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('marking')->nullable()->comment('marking');
            $blueprint->string('remark')->nullable()->comment('remark');
            $blueprint->boolean('uploaded')->default(false)->comment('remark');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ti_an');
    }
}
