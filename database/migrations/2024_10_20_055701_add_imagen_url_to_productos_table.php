<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen_url')->nullable()->after('categoria_id');
        });
    }
    
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('imagen_url');
        });
    }
    
};
