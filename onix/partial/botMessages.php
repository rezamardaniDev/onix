<?php

$crypto_text = "
<b>✅ لیست ارز های دیجیتال پشتیبانی شده در ربات :
             
 بیت کوین
 داگز
 ترون
 تون
 نات کوین
 تتر 
 همستر
 فانتوم
 اتریوم
 
 💰 همچنین با ارسال تعداد و نام ارز مانند نمونه زیر می توانید از مبدل ارزدیجیتال ربات استفاده نمایید.

مثال : 2 تون
 
💡برای دریافت قیمت ارز ها کافیه نام ارز مورد نظر به فارسی ارسال کنید ! </b>
    ";

$date = date("Y/m/d");
$time = date("H:i:s");

$user_area = "<b>
💭 | حساب کاربری شما در ربات ما 

📃 | نام شما : {$first_name}
📝 | یوزرنیم شما : @{$user_name}
🆔 | شناسه کاربری شما : {$user->chat_id}

┈┅┈┅┈┅┈┅┈┅┈┅┈┈┅┈┅┈┅┈┅┈┅┈┅┈ 

💎 | محدودیت درخواست های روزانه :

❕| محدودیت GPT-3.5 امروز : {$userLimits->gpt_3_limit}
❕| محدودیت GPT-4.o امروز : {$userLimits->gpt_4_limit}
❕| محدودیت جست و جو موزیک : {$userLimits->search_music}
❕| محدودیت ساخت تصویر  : {$userLimits->image_limit}
❕| محدودیت ساخت لوگو  : {$userLimits->logo_limit}
❕| محدودیت تبدیل متن به ویس : {$userLimits->text_to_voice}

┈┅┈┅┈┅┈┅┈┅┈┅┈┈┅┈┅┈┅┈┅┈┅┈┅┈

💎 | محدودیت درخواست های دانلودر ها :

📥 | محدودیت دانلودر اینستاگرام : {$userLimits->dl_instagram}
📥 | محدودیت دانلودر ساندکلاد : {$userLimits->dl_soundcloud}
📥 | محدودیت دانلودر یوتیوب : {$userLimits->dl_youtube}

┈┅┈┅┈┅┈┅┈┅┈┅┈┈┅┈┅┈┅┈┅┈┅┈┅┈
📆 | تاریخ اکنون : {$date}
⏱ | ساعت اکنون : {$time}
</b>";

$how_add_to_group = "
<b>جهت افزودن ربات ( Onyx ) به گروه مربوطه  :
    
1. ربات را در گروه خود عضو کنید.
    
2.سپس اونیکس (Onyx) را در گروه ادمین کنید.
    
3.و در آخر با خواندن بخش دستورات ربات با توجه به نیاز خود از ربات استفاده کنید.
    
⭕️ نکته: برای دریافت پاسخ از اونیکس ( Onyx )، اونیکس ( Onyx ) حتما باید در گروه ادمین باشد.
</b>";

$how_use_in_group = "
<b>
ابتدا ربات را در گروه خود ادمین کنید و سپس کلمه راهنما را در گروه راسال کنید
</b>
";

$sponsering_text = "
<b>
جهت اسپانسر شدن در ربات ما به آیدی ادمین [ @OnyxAiSupport ] مراجعه کنید !
</b>
";

$helper_text = "
<b>
❈ راهنماے هوش مصنوعی اونیکس ❈

 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ اونیکس / انیکس ] + سوالتون
🎖️ چت با هوش مصنوعی 
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ هوا ] + شهر
🎖️ نمایش هواشناسی 
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ اوقات ] + شهر
🎖️ نمایش اوقات شرعی
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ ارز ]
🎖️ نمایش قیمت دلار و ...
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ جوک ]
🎖️ نمایش جوک 
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ فال ]
🎖️  نمایش فال حافظ
 ┈┅┅┅┈ ✿ ┈┅┅┅┈
💠 دستور [ دانستنی ]
🎖️ نمایش دانستنی
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ سخن بزرگان ]
🎖️ نمایش سخن بزرگان
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ ترجمه به فارسی ] + متن انگلیسی
🎖️ نمایش ترجمه فارسی 
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ ترجمه به انگلیسی ] + متن فارسی 
🎖️ نمایش ترجمه انگلیسی 
 ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ ! ] بعد سوالتون از هوش مصنوعی 
🎖️ نمایش حالت خشم 
  ┈┅┅┅┈ ✿ ┈┅┅┅┈ 
💠 دستور [ # ] بعد سوالتون از هوش مصنوعی 
🎖️ نمایش حالت ملایم
</b>
";
