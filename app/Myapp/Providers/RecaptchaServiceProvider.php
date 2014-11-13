<?php

namespace Myapp\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Description of RecaptchaServiceProvider
 *
 * @author ron
 */
class RecaptchaServiceProvider extends ServiceProvider {
    //put your code here
    public function register() {
        App::bind('recaptcha', function()
{
    return new \Myapp\Recaptcha\MyRecaptcha;
});
    }
}
