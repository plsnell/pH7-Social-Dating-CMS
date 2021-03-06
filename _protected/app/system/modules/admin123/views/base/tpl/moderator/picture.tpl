{@if(!empty($pictures))@}

<ul>

 {@foreach($pictures as $picture)@}

    {{ $action = ($picture->approved == 1) ? 'disapprovedphoto' : 'approvedphoto' }}

  <div class="thumb_photo">
    <a href="{url_data_sys_mod}picture/img/{% $picture->username %}/{% $picture->albumId %}/{%  $file = str_replace('original', '1000',  $picture->file) %}" title="{% $picture->title %}" data-popup="image"><img src="{url_data_sys_mod}picture/img/{% $picture->username %}/{% $picture->albumId %}/{%  $file = str_replace('original', '400',  $picture->file) %}" alt="{% $picture->title %}" title="{% $picture->title %}" /></a>
    <p class="italic">{@lang('Posted by')@} <a href="{% $oUser->getProfileLink($picture->username) %}" target="_blank">{% $picture->username %}</a></p>

    <div>
      {{ $text = ($picture->approved == 1) ? t('Disapproved') : t('Approved') }}
      {{ LinkCoreForm::display($text, PH7_ADMIN_MOD,'moderator', $action, array('picture_id'=>$picture->pictureId)) }} |
      {{ LinkCoreForm::display(t('Delete'), PH7_ADMIN_MOD, 'moderator', 'deletephoto', array('album_id'=>$picture->albumId, 'picture_id'=>$picture->pictureId, 'id'=>$picture->profileId, 'username'=>$picture->username, 'picture_link'=>$picture->file)) }}
    </div>
  </div>

 {@/foreach@}

</ul>

{@main_include('page_nav.inc.tpl')@}

{@else@}

  <p class="center">{@lang('No Pictures for the treatment of moderate.')@}</p>

{@/if@}
