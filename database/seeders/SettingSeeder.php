<?php

namespace Database\Seeders;

use App\Enums\SmtpStatus;
use Illuminate\Database\Seeder;
use Setting as SettingInsert;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settingArray['site_name']          = 'Amaris Synergy Limited';
        $settingArray['site_email']         = 'contact@amaris.com';
        $settingArray['site_phone_number']  = '+234 (906) 320-4011';
        $settingArray['site_currency_name'] = 'NGN';
        $settingArray['site_currency_code'] = '₦';
        $settingArray['site_timezone']      = 'Africa/Lagos';
        $settingArray['site_footer']        = '@ All Rights Reserved';
        $settingArray['site_logo']          = 'amaris-logo.png';
        $settingArray['site_logo_white']    = 'amaris-white-logo.png';
        $settingArray['site_favicon']       = 'favicon/apple-touch-icon.png';
        $settingArray['site_description']   = 'Amaris Synergy Limited is an online store platform in Nigeria.';

        $settingArray['mail_host']         = '';
        $settingArray['mail_port']         = '';
        $settingArray['mail_username']     = '';
        $settingArray['mail_password']     = '';
        $settingArray['mail_from_name']    = '';
        $settingArray['mail_from_address'] = '';
        $settingArray['mail_disabled']     = SmtpStatus::INACTIVE();

        $settingArray['social_facebook']  = 'https://web.facebook.com/AmarisNG-107910631954871';
        $settingArray['social_twitter']   = 'https://twitter.com/@ng_amaris';
        $settingArray['social_youtube']   = '';
        $settingArray['social_instagram'] = 'https://instagram.com/Amaris.ng';

        $settingArray['paystack_active']   = 1;
        $settingArray['paystack_key']  = 'pk_live_840844c2b25d6ed006362384bf987d6514c8f20d';
        $settingArray['paystack_secret']   = 'sk_live_4760727ff7192f73ccd085b583f983c2f72d4f9e';

        $settingArray['stripe_active']   = 1;
        $settingArray['stripe_key']  = 'pk_test_51L4gM4HPfoAuKwnmFouS5lTErlK9ZFYtE8w7EdyEVozXoWsy9o1U776PwmfnO1CgVJbdGjNLolAD0dnr3HCzAKlf00Cy0LHN3p';
        $settingArray['stripe_secret']   = 'sk_test_51L4gM4HPfoAuKwnm5WYczmKKJYpXyjwk9KWX3HaO6dQbZvAUYkZ7GyB87ZILzRCAfnXARnEWmDi9lvjiBvMZEKMn00Kaj47X1x';

        $settingArray['verifyafrica_userid']   = env('VERIFYAFRICA_USERID');
        $settingArray['verifyafrica_dvl_key']  = env('VERIFYAFRICA_DRIVERS_LICENSE_KEY');
        $settingArray['verifyafrica_nin_key']   = env('VERIFYAFRICA_NIN_KEY');
        $settingArray['verifyafrica_voters_key']   = env('VERIFYAFRICA_VOTERS_CARD_KEY');
        $settingArray['verifyafrica_passport_key']   = env('VERIFYAFRICA_INTL_PASSPORT_KEY');

        $settingArray['min_commission_withdrawal'] =  5000;
        $settingArray['referral_commission'] = 1.4;

        SettingInsert::set($settingArray);
        SettingInsert::save();
    }
}
