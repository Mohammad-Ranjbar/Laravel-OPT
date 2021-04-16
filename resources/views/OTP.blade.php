@component('mail::message')
# کد فعال سازی شما

کد شما: {{$opt}}

@component('mail::button', ['url' => ''])
برای ورود کلیک کنید
@endcomponent

Thanks,<br>
محمد جواد رنجبر | ادمین سایت
@endcomponent
