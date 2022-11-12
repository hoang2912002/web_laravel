<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->boolean('level');
            $table->string('email');
            $table->string('password');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            //tại sao lại dùng timestamp
            //timestamp nó là số giây bắt đầu từ 1/1/1970 -> now
            //tại vì khi mình muốn convert sang 1 cái khác thì mik đỡ mất công biến nó thành đối tượng để sửa
            //VD: Y-m-d ==> h-m-d-m-Y thì phải biến nó thành đối tượng r thêm giờ phút vô
            //còn timestamp thì nó có sẵn r k cần phải reformat lại 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
