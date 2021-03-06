<div class="center divShow">


      <div class="faq"><a href="#divShow_1">{@lang('I can\'t login, or I forgot my username or password.')@}</a></div>

      <div class="hidden" id="divShow_1">
      {@lang@}If you can\'t login, check to make sure that your "caps lock" key is off. Your username and password are CaSe SeNsItIvE. If you still cannot login, you can request to{@/lang@} <a href="{{ $design->url('user','main','forgot') }}">{@lang('reset your password')@}</a> {@lang('or')@} <a href="{{ $design->url('contact','contact','index') }}">{@lang('contact us')@}</a>.
      </div>

      <div class="faq"><a href="#divShow_2">{@lang('How can I update my profile?')@}</a></div>
      <div class="hidden" id="divShow_2">
         {@lang@}To update your profile, you must go into your profile and settings in your profile editing. You can move through the different parts of your profile by clicking the tabs at the top of the page.{@/lang@}
      </div>

      <div class="faq"><a href="#divShow_3">{@lang('How can I delete my account?')@}</a></div>
      <div class="hidden" id="divShow_3">
      {@lang@}If you are aboslutely sure that you want to delete your account, you can do so in your privacy settings. Please note that your account will be permanently deleted and irrecoverable!{@/lang@}
      </div>

      <div class="faq"><a href="#divShow_4">{@lang('How can I update my email address?')@}</a></div>
      <div class="hidden" id="divShow_4">
      {@lang@}For safety and to prevent spam, you can not change your email address.{@/lang@}
      </div>

      <div class="faq"><a href="#divShow_5">{@lang('How can I deal with someone that is bothering me?')@}</a></div>
      <div class="hidden" id="divShow_5">
      {@lang@}If someone is bothering or harassing you, blocking them is usually the best solution. Please report it via our contact form with the url of the profile of the person and the explanation of what the person has done wrong.{@/lang@}
      </div>


</div>
