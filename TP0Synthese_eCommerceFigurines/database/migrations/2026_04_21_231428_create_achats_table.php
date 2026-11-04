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
        Schema::create('achats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('produit_id')->nullable()->constrained('figurines')->nullOnDelete();
            $table->string('nom_produit');
            $table->integer('prix_unitaire');
            $table->integer('quantite');
            $table->integer('total');
            $table->string('etat')->default('en_preparation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achats');
    }
};
