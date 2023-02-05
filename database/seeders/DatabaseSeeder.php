<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Area;
use App\Models\Setting;
use App\Models\Clinc;
use App\Models\Slot;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    /* Colors :
Main #4ec0e7
Second #f18aa2
Create #62d683
Edit #ffa83a
Cancel / Delete #ff4062 */
    public function run()
    {


       Admin::create([
           'name'=>'admin',
           'email'=>'admin@gmail.com',
           'password'=>Hash::make('12345678')
       ]);

        $items = [
            [
                'id' => 1,
                'name'=>[
                'en'=> 'follow up days',
                'ar'=>'ايام الاستشارة'
                 ],
                 'key'=>'follow_up_days',
                 'value'=>'7',
            ],
            [
                'id'=>'2',
                'name'=>[
                    'en'=> 'color create',
                    'ar'=>'زر اضافة'
                ],
                'key'=>'color_create',
                'value'=>'#62d683',
            ],
            [
                'id'=>'3',
                'name'=>[
                    'en'=> 'color edit',
                    'ar'=>'زر تعديل'
                ],
                'key'=>'color_edit',
                'value'=>'#ffa83a',
            ],
            [
                'id'=>'4',
                'name'=>[
                    'en'=> 'color delete',
                    'ar'=>'زر حذف'
                ],
                'key'=>'color_delete',
                'value'=>'#ff4062',
            ],[
                'id'=>'5',
                'name'=>[
                    'en'=> 'color main',
                    'ar'=>'اللون الرئيسي'
                ],
                'key'=>'color_main',
                'value'=>'#4ec0e7',
            ],[
                'id'=>'6',
                'name'=>[
                    'en'=> 'color second',
                    'ar'=>'اللون الثانوي'
                ],
                'key'=>'color_second',
                'value'=>'#f18aa2',

            ],[
                'id'=>'7',
                'name'=>[
                    'en'=> 'logo',
                    'ar'=>'شعار'
                ],
                'key'=>'logo',
                'value'=>'/media/SLogo3.png',

            ],[
                'id'=>'8',
                'name'=>[
                    'en'=> 'facebook',
                    'ar'=>'فيسبوك'
                ],
                'key'=>'facebook',
                'value'=>'https://www.facebook.com/',

            ],[
                'id'=>'9',
                'name'=>[
                    'en'=> 'youtube',
                    'ar'=>'يوتيوب'
                ],
                'key'=>'youtube',
                'value'=>'https://www.youtube.com/',

            ],[
                'id'=>'10',
                'name'=>[
                    'en'=> 'instagram',
                    'ar'=>'إنستغرام'
                ],
                'key'=>'instagram',
                'value'=>'https://www.instagram.com/',

            ],[
                'id'=>'11',
                'name'=>[
                    'en'=> 'tiktok',
                    'ar'=>'تيك توك'
                ],
                'key'=>'tiktok',
                'value'=>'https://www.tiktok.com/',

            ],[
                'id'=>'12',
                'name'=>[
                    'en'=> 'clinc',
                    'ar'=>'العيادة'
                ],
                'key'=>'clinc',
                'value'=>'11 Galal Hagag St. from Ahmed Tayseer St., Girls Collage - Heliopolis',

            ],[
                'id'=>'13',
                'name'=>[
                    'en'=> 'tel',
                    'ar'=>'تليفون ارضي'
                ],
                'key'=>'tel',
                'value'=>'(202) 2419 8224',

            ],[
                'id'=>'14',
                'name'=>[
                    'en'=> 'gallery',
                    'ar'=>'تيك توك'
                ],
                'key'=>'gallery',
                'value'=>'',

            ],[
                'id'=>'15',
                'name'=>[
                    'en'=> 'ios link',
                    'ar'=>'تيك توك'
                ],
                'key'=>'ios_link',
                'value'=>'',

            ],[
                'id'=>'16',
                'name'=>[
                    'en'=> 'android link',
                    'ar'=>'تيك توك'
                ],
                'key'=>'android_link',
                'value'=>'',

            ],[
                'id'=>'17',
                'name'=>[
                    'en'=> 'logo2',
                    'ar'=>'شعار الروشتة'
                ],
                'key'=>'logo2',
                'value'=>'/media/logo2.jpg',

            ],[
                'id'=>'18',
                'name'=>[
                    'en'=> 'doctor name english',
                    'ar'=>'اسم الطبيب انجليزى'
                ],
                'key'=>'doctor_name_english',
                'value'=>'Dr. Germaine Alfred'

            ],[
                'id'=>'19',
                'name'=>[
                    'en'=> 'doctor name arabic',
                    'ar'=>'اسم الطبيب عربي'
                ],
                'key'=>'doctor_name_arabic',
                'value'=>'د. جيرمين ألفريد'

            ],[
                'id'=>'20',
                'name'=>[
                    'en'=>'job title1 english',
                    'ar'=>'المسمي الوظيفى 1 انجليزى'
                ],
                'key'=>'job_title1_english',
                'value'=>'Pediatrician & Neonatologist'

            ],[
                'id'=>'21',
                'name'=>[
                    'en'=>'job title1 arabic',
                    'ar'=>'المسمي الوظيفى 1 عربي'
                ],
                'key'=>'job_title1_arabic',
                'value'=>'استشارى طب الاطفال وحديثي الولادة'

            ],[
                'id'=>'22',
                'name'=>[
                    'en'=>'job title2 english',
                    'ar'=>'المسمي الوظيفى 2 انجليزى'
                ],
                'key'=>'job_title2_english',
                'value'=>'M.B.ch. , M.Sc. , Cairo University'

            ],[
                'id'=>'23',
                'name'=>[
                    'en'=>'job title2 arabic',
                    'ar'=>'المسمي الوظيفى 2 عربي'
                ],
                'key'=>'job_title2_arabic',
                'value'=>'ماجيستير طب الاطفال - جامعة القاهرة'

            ],[
                'id'=>'24',
                'name'=>[
                    'en'=>'job title3 english',
                    'ar'=>'المسمي الوظيفى 3 انجليزى'
                ],
                'key'=>'job_title3_english',
                'value'=>'Hayat Medical Center - El Korba'

            ],[
                'id'=>'25',
                'name'=>[
                    'en'=>'job title3 arabic',
                    'ar'=>'المسمي الوظيفى 3 عربي'
                ],
                'key'=>'job_title3_arabic',
                'value'=>'مستشفى مركز الحياة الطبي - الكوربة'

            ],[
                'id'=>'26',
                'name'=>[
                    'en'=>'job title4 english',
                    'ar'=>'المسمي الوظيفى 4 انجليزى'
                ],
                'key'=>'job_title4_english',
                'value'=>'Member of the Egyption Society'

            ],[
                'id'=>'27',
                'name'=>[
                    'en'=>'job title4 arabic',
                    'ar'=>'المسمي الوظيفى 4 عربي'
                ],
                'key'=>'job_title4_arabic',
                'value'=>'عضو الجمعية المصرية'

            ],[
                'id'=>'28',
                'name'=>[
                    'en'=> 'hospital ',
                    'ar'=>'المستشفى'
                ],
                'key'=>'hospital',
                'value'=>'Hayat Medical Center - El Korba',

            ],[
                'id'=>'29',
                'name'=>[
                    'en'=> 'mobile',
                    'ar'=>'موبيل'
                ],
                'key'=>'mobile',
                'value'=>'(2)0120 772 1212',

            ],[
                'id'=>'30',
                'name'=>[
                    'en'=> 'email',
                    'ar'=>'البريد الالكتروني'
                ],
                'key'=>'email',
                'value'=>'germainemakar@hotmail.com',

            ],



        ];

        foreach ($items as $item) {
            Setting::create($item);
        }

        Area::create([
            'id'=>'1',
        'name'=>[
            'en'=> 'cairo',
            'ar'=>'القاهرة'
        ]
       ]);

       Clinc::create([
           'id'=>1,
           'name'=>'main clinc',
           'title'=>'null',
           'location_url'=>'null'
       ]);

    //    Slot::create([
    //     'id'=>1,
    //     'date'=>'2022-12-20',
    //     'number'=>'5',
    //     'from'=>'15:00',
    //     'to'=>'16:00',
    //     'clinc_id'=> 1
    //    ]);



    }
}
