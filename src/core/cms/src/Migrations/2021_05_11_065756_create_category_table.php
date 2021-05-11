<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE TABLE `categories` (
                `id` int(10) UNSIGNED NOT NULL,
                `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                `name_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                `parent_id` smallint(5) UNSIGNED DEFAULT 0,
                `parent_parent_id` smallint(6) DEFAULT NULL,
                `avail_flg` smallint(5) UNSIGNED DEFAULT 1,
                `status` smallint(5) UNSIGNED DEFAULT 0,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ');

        DB::statement("
            INSERT INTO `categories` (`id`, `name`, `name_url`, `parent_id`, `parent_parent_id`, `avail_flg`, `status`, `created_at`, `updated_at`) VALUES
                (17, 'DẦU NHỜN CHO XE MÁY', 'dau-nhon-cho-xe-may.1615517897', 0, 0, 1, 1, '2021-02-03 06:38:36', '2021-03-12 02:58:17'),
                (18, 'DẦU NHỜN CHO XE Ô TÔ CON, Ô TÔ TẢI', 'dau-nhon-cho-xe-o-to-con-o-to-tai.1615517886', 0, 0, 1, 1, '2021-02-03 06:38:44', '2021-03-12 02:58:06');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
