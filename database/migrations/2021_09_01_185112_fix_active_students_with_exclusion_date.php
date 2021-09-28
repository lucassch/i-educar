<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\IeducarStudent;

class FixActiveStudentsWithExclusionDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        IeducarStudent::where('ativo', 1)
            ->update(['data_exclusao' => null]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
