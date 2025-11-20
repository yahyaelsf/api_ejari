<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('permissions')->delete();

        DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'admins',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:18:23',
                'display_name' => 'مدراء النظام',
                'parent_id' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'admins-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:33:23',
                'display_name' => 'رؤية المدراء',
                'parent_id' => 1,
            ),
            2 =>
            array (
                'id' => 4,
                'name' => 'admins-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:33:07',
                'display_name' => 'اضافة تعديل مدير',
                'parent_id' => 1,
            ),
            3 =>
            array (
                'id' => 5,
                'name' => 'admins-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:32:58',
                'display_name' => 'تغيير حالة المدراء',
                'parent_id' => 1,
            ),
            4 =>
            array (
                'id' => 6,
                'name' => 'admins-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:32:47',
                'display_name' => 'حذف المدراء',
                'parent_id' => 1,
            ),
            5 =>
            array (
                'id' => 7,
                'name' => 'users',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:18:23',
                'display_name' => 'المستخدمين',
                'parent_id' => NULL,
            ),
            6 =>
            array (
                'id' => 8,
                'name' => 'users-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:32:40',
                'display_name' => 'رؤية المستخدمين',
                'parent_id' => 7,
            ),
            7 =>
            array (
                'id' => 10,
                'name' => 'users-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:32:21',
                'display_name' => 'اضافة وتعديل المستخدمين',
                'parent_id' => 7,
            ),
            8 =>
            array (
                'id' => 11,
                'name' => 'users-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:32:09',
                'display_name' => 'تغيير حالة المستخدمين',
                'parent_id' => 7,
            ),
            9 =>
            array (
                'id' => 12,
                'name' => 'users-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:32:02',
                'display_name' => 'حذف المستخدمين',
                'parent_id' => 7,
            ),
            10 =>
            array (
                'id' => 13,
                'name' => 'categories',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:18:23',
                'display_name' => 'الأقسام',
                'parent_id' => NULL,
            ),
            11 =>
            array (
                'id' => 14,
                'name' => 'categories-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:31:05',
                'display_name' => 'رؤية الأقسام',
                'parent_id' => 13,
            ),
            12 =>
            array (
                'id' => 15,
                'name' => 'categories-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:30:53',
                'display_name' => 'اضافة وتعديل قسم',
                'parent_id' => 13,
            ),
            13 =>
            array (
                'id' => 16,
                'name' => 'categories-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:30:42',
                'display_name' => 'تغيير حالة القسم',
                'parent_id' => 13,
            ),
            14 =>
            array (
                'id' => 18,
                'name' => 'categories-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:30:24',
                'display_name' => 'حذف القسم',
                'parent_id' => 13,
            ),
            15 =>
            array (
                'id' => 19,
                'name' => 'slider',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:18:23',
                'display_name' => 'شريط الصور',
                'parent_id' => NULL,
            ),
            16 =>
            array (
                'id' => 20,
                'name' => 'slider-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:30:16',
                'display_name' => 'رؤية السلايدر',
                'parent_id' => 19,
            ),
            17 =>
            array (
                'id' => 21,
                'name' => 'slider-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:30:08',
                'display_name' => 'اضافة تعديل سلايدر',
                'parent_id' => 19,
            ),
            18 =>
            array (
                'id' => 22,
                'name' => 'slider-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:29:54',
                'display_name' => 'تغيير حالة  السلايد',
                'parent_id' => 19,
            ),
            19 =>
            array (
                'id' => 23,
                'name' => 'slider-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:29:46',
                'display_name' => 'حذف السلايدر',
                'parent_id' => 19,
            ),
            20 =>
            array (
                'id' => 24,
                'name' => 'partners',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:18:23',
                'display_name' => 'الشركاء',
                'parent_id' => NULL,
            ),
            21 =>
            array (
                'id' => 25,
                'name' => 'partners-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:23',
                'updated_at' => '2021-12-15 11:29:39',
                'display_name' => 'رؤية الشركاء',
                'parent_id' => 24,
            ),
            22 =>
            array (
                'id' => 26,
                'name' => 'partners-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:29:32',
                'display_name' => 'اضافة وتعديل الشركاء',
                'parent_id' => 24,
            ),
            23 =>
            array (
                'id' => 27,
                'name' => 'partners-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:29:21',
                'display_name' => 'تغيير حالة الشركاء',
                'parent_id' => 24,
            ),
            24 =>
            array (
                'id' => 28,
                'name' => 'partners-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:29:12',
                'display_name' => 'حذف الشركاء',
                'parent_id' => 24,
            ),
            25 =>
            array (
                'id' => 29,
                'name' => 'testimonials',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'قالوا عنا',
                'parent_id' => NULL,
            ),
            26 =>
            array (
                'id' => 30,
                'name' => 'testimonials-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:29:05',
                'display_name' => 'رؤية الأراء',
                'parent_id' => 29,
            ),
            27 =>
            array (
                'id' => 31,
                'name' => 'testimonials-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:28:56',
                'display_name' => 'اضافة وتعديل الأراء',
                'parent_id' => 29,
            ),
            28 =>
            array (
                'id' => 32,
                'name' => 'testimonials-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:28:38',
                'display_name' => 'تغيير حالة الأراء',
                'parent_id' => 29,
            ),
            29 =>
            array (
                'id' => 33,
                'name' => 'testimonials-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:28:45',
                'display_name' => 'حذف الأراء',
                'parent_id' => 29,
            ),
            30 =>
            array (
                'id' => 34,
                'name' => 'tags',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'الوسوم',
                'parent_id' => NULL,
            ),
            31 =>
            array (
                'id' => 35,
                'name' => 'tags-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:28:21',
                'display_name' => 'رؤية الوسوم',
                'parent_id' => 34,
            ),
            32 =>
            array (
                'id' => 36,
                'name' => 'tags-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:28:10',
                'display_name' => 'اضافة وتعديل وسم',
                'parent_id' => 34,
            ),
            33 =>
            array (
                'id' => 37,
                'name' => 'tags-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:27:52',
                'display_name' => 'تغيير حالة الوسوم',
                'parent_id' => 34,
            ),
            34 =>
            array (
                'id' => 38,
                'name' => 'tags-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:27:44',
                'display_name' => 'حذف الوسوم',
                'parent_id' => 34,
            ),
            35 =>
            array (
                'id' => 39,
                'name' => 'team',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'الفريق',
                'parent_id' => NULL,
            ),
            36 =>
            array (
                'id' => 40,
                'name' => 'team-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:27:37',
                'display_name' => 'رؤية الفريق',
                'parent_id' => 39,
            ),
            37 =>
            array (
                'id' => 41,
                'name' => 'team-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:27:31',
                'display_name' => 'اضافة تعديل الفريق',
                'parent_id' => 39,
            ),
            38 =>
            array (
                'id' => 42,
                'name' => 'team-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:27:19',
                'display_name' => 'تعديل حالة الفريق',
                'parent_id' => 39,
            ),
            39 =>
            array (
                'id' => 43,
                'name' => 'team-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:27:11',
                'display_name' => 'حذف الفريق',
                'parent_id' => 39,
            ),
            40 =>
            array (
                'id' => 44,
                'name' => 'about',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'من نحن',
                'parent_id' => NULL,
            ),
            41 =>
            array (
                'id' => 45,
                'name' => 'about-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:27:04',
                'display_name' => 'رؤية من نحن',
                'parent_id' => 44,
            ),
            42 =>
            array (
                'id' => 46,
                'name' => 'about-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:26:57',
                'display_name' => 'اضافة تعديل من نحن',
                'parent_id' => 44,
            ),
            43 =>
            array (
                'id' => 47,
                'name' => 'about-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:26:50',
                'display_name' => 'تغيير حالة من نحن',
                'parent_id' => 44,
            ),
            44 =>
            array (
                'id' => 49,
                'name' => 'products',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'المنتجات',
                'parent_id' => NULL,
            ),
            45 =>
            array (
                'id' => 50,
                'name' => 'products-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 13:06:29',
                'display_name' => 'رؤية المنتجات',
                'parent_id' => 49,
            ),
            46 =>
            array (
                'id' => 51,
                'name' => 'products-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:26:15',
                'display_name' => 'اضافة وتعديل منتجات',
                'parent_id' => 49,
            ),
            47 =>
            array (
                'id' => 52,
                'name' => 'products-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:26:01',
                'display_name' => 'حذف المنتجات',
                'parent_id' => 49,
            ),
            48 =>
            array (
                'id' => 53,
                'name' => 'jobs',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'الوظائف',
                'parent_id' => NULL,
            ),
            49 =>
            array (
                'id' => 54,
                'name' => 'jobs-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:25:52',
                'display_name' => 'رؤية والوظائف',
                'parent_id' => 53,
            ),
            50 =>
            array (
                'id' => 55,
                'name' => 'jobs-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:25:42',
                'display_name' => 'تعديل حالة الوظائف',
                'parent_id' => 53,
            ),
            51 =>
            array (
                'id' => 56,
                'name' => 'jobs-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:25:33',
                'display_name' => 'اضافة وتعديل الوظائف',
                'parent_id' => 53,
            ),
            52 =>
            array (
                'id' => 57,
                'name' => 'jobs-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:25:19',
                'display_name' => 'حذف الوظائف',
                'parent_id' => 53,
            ),
            53 =>
            array (
                'id' => 58,
                'name' => 'news',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'الأخبار والفعاليات',
                'parent_id' => NULL,
            ),
            54 =>
            array (
                'id' => 59,
                'name' => 'news-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:25:09',
                'display_name' => 'رؤية الأخبار والفعاليات',
                'parent_id' => 58,
            ),
            55 =>
            array (
                'id' => 60,
                'name' => 'news-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:24:56',
                'display_name' => 'اضافة وتعديل الأخبار والفعاليات',
                'parent_id' => 58,
            ),
            56 =>
            array (
                'id' => 61,
                'name' => 'campaigns',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'الحملات والعروض',
                'parent_id' => NULL,
            ),
            57 =>
            array (
                'id' => 62,
                'name' => 'campaigns-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:24:33',
                'display_name' => 'رؤية الحملات والعروض',
                'parent_id' => 61,
            ),
            58 =>
            array (
                'id' => 63,
                'name' => 'albums',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'الألبومات',
                'parent_id' => NULL,
            ),
            59 =>
            array (
                'id' => 64,
                'name' => 'albums-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:24:24',
                'display_name' => 'رؤية الألبومات',
                'parent_id' => 63,
            ),
            60 =>
            array (
                'id' => 65,
                'name' => 'albums-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:24:16',
                'display_name' => 'تعديل حالة الألبوم',
                'parent_id' => 63,
            ),
            61 =>
            array (
                'id' => 66,
                'name' => 'albums-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:23:47',
                'display_name' => 'اضافة وتعديل الألبومات',
                'parent_id' => 63,
            ),
            62 =>
            array (
                'id' => 67,
                'name' => 'albums-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:23:34',
                'display_name' => 'حذف الألبومات',
                'parent_id' => 63,
            ),
            63 =>
            array (
                'id' => 69,
                'name' => 'job-applications-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:23:23',
                'display_name' => 'رؤية طلبات التوظيف',
                'parent_id' => 76,
            ),
            64 =>
            array (
                'id' => 70,
                'name' => 'job-applications-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:23:06',
                'display_name' => 'حذف طلبات التوظيف',
                'parent_id' => 76,
            ),
            65 =>
            array (
                'id' => 71,
                'name' => 'contacts',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'رسائل اتصل بنا',
                'parent_id' => NULL,
            ),
            66 =>
            array (
                'id' => 72,
                'name' => 'contacts-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:22:02',
                'display_name' => 'عرض رسائل اتصل',
                'parent_id' => 71,
            ),
            67 =>
            array (
                'id' => 73,
                'name' => 'contacts-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:21:52',
                'display_name' => 'حذف رسائل اتصل بنا',
                'parent_id' => 71,
            ),
            68 =>
            array (
                'id' => 74,
                'name' => 'settings',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'الإعدادات',
                'parent_id' => NULL,
            ),
            69 =>
            array (
                'id' => 75,
                'name' => 'settings-edit',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:20:48',
                'display_name' => 'تعديل إعدادات النظام',
                'parent_id' => 74,
            ),
            70 =>
            array (
                'id' => 76,
                'name' => 'job-applications',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 11:18:24',
                'updated_at' => '2021-12-15 11:18:24',
                'display_name' => 'طلبات التوظيف',
                'parent_id' => NULL,
            ),
            71 =>
            array (
                'id' => 92,
                'name' => 'products-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 12:07:53',
                'updated_at' => '2021-12-15 12:08:25',
                'display_name' => 'تغيير حالة المنتجات',
                'parent_id' => 49,
            ),
            72 =>
            array (
                'id' => 93,
                'name' => 'news-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 12:07:53',
                'updated_at' => '2021-12-15 12:08:39',
                'display_name' => 'تغيير حالة الأخبار والفعاليات',
                'parent_id' => 58,
            ),
            73 =>
            array (
                'id' => 94,
                'name' => 'news-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 12:07:53',
                'updated_at' => '2021-12-15 12:08:49',
                'display_name' => 'حذف الأخبار والفعاليات',
                'parent_id' => 58,
            ),
            74 =>
            array (
                'id' => 95,
                'name' => 'campaigns-status',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 12:07:53',
                'updated_at' => '2021-12-15 12:09:00',
                'display_name' => 'تغيير حالة الحملات',
                'parent_id' => 61,
            ),
            75 =>
            array (
                'id' => 96,
                'name' => 'campaigns-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 12:07:53',
                'updated_at' => '2021-12-15 12:09:18',
                'display_name' => 'اضافة وتعديل حملات',
                'parent_id' => 61,
            ),
            76 =>
            array (
                'id' => 97,
                'name' => 'campaigns-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 12:07:53',
                'updated_at' => '2021-12-15 12:09:15',
                'display_name' => 'حذف الحملات',
                'parent_id' => 61,
            ),
            77 =>
            array (
                'id' => 100,
                'name' => 'about-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 13:45:39',
                'updated_at' => '2021-12-15 13:45:39',
                'display_name' => 'حذف من نحن',
                'parent_id' => 44,
            ),
            78 =>
            array (
                'id' => 101,
                'name' => 'roles',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 00:00:00',
                'updated_at' => NULL,
                'display_name' => 'الأدوار',
                'parent_id' => NULL,
            ),
            79 =>
            array (
                'id' => 102,
                'name' => 'roles-view',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 13:47:29',
                'updated_at' => '2021-12-15 13:47:29',
                'display_name' => 'رؤية الأدوار',
                'parent_id' => 101,
            ),
            80 =>
            array (
                'id' => 103,
                'name' => 'roles-store',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 13:47:29',
                'updated_at' => '2021-12-15 13:47:29',
                'display_name' => 'اضافة وتعديل دور',
                'parent_id' => 101,
            ),
            81 =>
            array (
                'id' => 104,
                'name' => 'roles-delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 13:47:29',
                'updated_at' => '2021-12-15 13:47:29',
                'display_name' => 'حذف الأدوار',
                'parent_id' => 101,
            ),
            82 =>
            array (
                'id' => 105,
                'name' => 'mailing-list',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 13:47:29',
                'updated_at' => '2021-12-15 13:47:29',
                'display_name' => 'القوائم البريدية',
                'parent_id' => NULL,
            ),
            83 =>
            array (
                'id' => 106,
                'name' => 'view-mailing-list',
                'guard_name' => 'admin',
                'created_at' => '2021-12-15 13:47:29',
                'updated_at' => '2021-12-15 13:47:29',
                'display_name' => 'رؤية القائمة البريدية',
                'parent_id' => 105,
            ),
        ));


    }
}
