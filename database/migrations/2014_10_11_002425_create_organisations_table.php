<?php

declare(strict_types=1);

use App\Enum\OrganisationAreaType;
use App\Enum\OrganisationStatus;
use App\Enum\OrganisationType;
use App\Models\City;
use App\Models\County;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->enum('type', OrganisationType::values());
            $table->enum('status', OrganisationStatus::values())->default('inactive');
            $table->text('email');
            $table->text('phone');
            $table->year('year')->nullable();
            $table->string('vat')->nullable();
            $table->string('no_registration')->nullable();
            $table->foreignIdFor(County::class)->nullable()->constrained();
            $table->foreignIdFor(City::class)->nullable()->constrained();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->json('contact_person')->nullable();
            $table->json('other_information')->nullable();
            $table->enum('type_of_area', OrganisationAreaType::values());
            $table->json('areas_of_activity')->nullable();
            $table->boolean('has_branches')->default(false);
            $table->boolean('social_services_accreditation')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('organisations');
    }
};
