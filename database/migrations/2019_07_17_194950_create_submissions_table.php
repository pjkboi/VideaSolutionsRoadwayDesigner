<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->double('row')->nullable();
            $table->double('comm_ext')->nullable();
            $table->double('sdwlk_path_res')->nullable();
            $table->double('sdwlk_path_comm')->nullable();
            $table->double('sdwlk_str_frntr')->nullable();
            $table->double('sdwlk_landbuff_util')->nullable();
            $table->double('sdwlk_landbuff')->nullable();
            $table->double('sdwlk_landbuff_veg')->nullable();
            $table->double('ped_isl')->nullable();
            $table->double('cycl_lane')->nullable();
            $table->double('cycl_trac')->nullable();
            $table->double('cycl_str')->nullable();
            $table->double('prot_cycl_trac')->nullable();
            $table->double('bi_cycl_trac')->nullable();
            $table->double('raise_cycl_trac')->nullable();
            $table->double('curbuff_cycl_lane')->nullable();
            $table->double('contra_cycle_str')->nullable();
            $table->double('tran_stp')->nullable();
            $table->double('side_ded_transln')->nullable();
            $table->double('cent_transln_cntbrd')->nullable();
            $table->double('cent_transln_pssgr')->nullable();
            $table->double('shr_transln')->nullable();
            $table->double('curb_ln')->nullable();
            $table->double('pass_ln')->nullable();
            $table->double('lrg_veh_ln')->nullable();
            $table->double('bi_trav_ln')->nullable();
            $table->double('turn_ln')->nullable();
            $table->double('frt_trav_ln')->nullable();
            $table->double('park_ln')->nullable();
            $table->double('swale')->nullable();
            $table->double('rain_gdn')->nullable();
            $table->double('perm_pav')->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
