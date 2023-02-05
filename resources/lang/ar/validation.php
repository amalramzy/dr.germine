<?php

return [
    'custom' => [
       
        'name_en' => [
            'required' => 'الاسم الانجليزى مطلوب',
        ],
        'name_ar' => [
            'required' => 'الاسم العربي مطلوب',
        ],
        'name' => [
            'required' => 'الاسم مطلوب',
        ],
        'email' => [
            'required' => 'البريد الالكترونى مطلوب',
            'email'=>'تنسيق البريد الإلكتروني غير صالح',
            'unique'=>'هذا البريد الالكتروني مسجل بالفعل'
        ],
        'birthdate'=> ['required'=>'تاريخ الميلاد مطلوب'],
        'gender' => ['required'=>'النوع مطلوب'], 
        'hospital' =>['required'=>'اسم المستشفى مطلوب'],
        'price'=>['required'=>'السعر مطلوب'],
        'date'=>['required'=>'التاريخ مطلوب'],
        'time'=>['required'=>'التوقيت مطلوب'],
        'company'=> ['required'=>'اسم الشركة مطلوب'],
        'phone'=> [
                'required'=>'رقم التليفون مطلوب',
                'numeric'=>'تنسيق رقم التليفون غير صالح'
                ],
        'from'=>['required'=>'توقيت البدء مطلوب'],
        'to'=>['required'=>'توقيت الانتهاء مطلوب'],
        'number'=>['required'=>'العدد مطلوب'],
        'father'=> ['required'=>'اسم الاب مطلوب'],
        'mother'=> ['required'=>' اسم الام مطلوب'],
        'area_id' => ['required'=>'اسم المنطقة مطلوب'], 
        'phone1' => [
            'required'=>'رقم تليفون التسجيل مطلوب',
            'numeric'=>'تنسيق رقم التليفون غير صالح'
            ],
            'phone2' =>[
                'required'=>'رقم التليفون الاضافى مطلوب',
                'numeric'=>'تنسيق رقم التليفون غير صالح'
            ],
        'password'=>['required'=>' كلمة المرور مطلوب'],
        'question_en'=>['required'=>'السؤال الانجليزي مطلوب'],
            'question_ar'=>['required'=>'السؤال العربي مطلوب'],
            'title_ar' => [
                'required' => 'العنوان العربي مطلوب',
            ],
            'title_en' => [
                'required' => 'العنوان الانجليزى مطلوب',
            ],
            'content_ar' => [
                'required' => 'المحتوي العربي مطلوب',
            ],
            'content_en' => [
                'required' => 'المحتوي الانجليزى مطلوب',
            ],
    ],

];