<div class="center">

{@if(empty($error))@}

<h3>{% Framework\Security\Ban\Ban::filterWord($picture->title) %}</h3>

<div class="picture_block">
<a href="{url_data_sys_mod}picture/img/{% $picture->username %}/{% $picture->albumId %}/{% str_replace('original', 1200, $picture->file) %}" title="{% $picture->title %}" data-popup="image"><img src="{url_data_sys_mod}picture/img/{% $picture->username %}/{% $picture->albumId %}/{% str_replace('original', '600', $picture->file) %}" alt="{% $picture->title %}" title="{% $picture->title %}" class="thumb" /></a>
</div>

<p>{% nl2br(Framework\Parse\Emoticon::init(Framework\Security\Ban\Ban::filterWord($picture->description))) %}</p>
<p class="italic">{@lang('Album created on %0%.', $picture->createdDate)@} {@if(!empty($picture->updatedDate))@} <br>{@lang('Modified on %0%.', $picture->updatedDate)@} {@/if@}</p>
<p class="italic">{@lang('Views:')@} {% Framework\Mvc\Model\Statistic::getView($picture->pictureId,'Pictures') %}</p>

{@if(UserCore::auth() && $member_id == $picture->profileId)@}
 <div class="small">
   <a href="{{$design->url('picture', 'main', 'editphoto', "$picture->albumId,$picture->title,$picture->pictureId")}}">{@lang('Edit')@}</a> |
   {{ LinkCoreForm::display(t('Delete'), 'picture', 'main', 'deletephoto', array('album_title'=>$picture->name, 'album_id'=>$picture->albumId, 'picture_id'=>$picture->pictureId, 'picture_link'=>$picture->file)) }}
 </div>
{@/if@}

{{ ShareUrlCoreForm::display(Framework\Mvc\Router\UriRoute::get('picture','main','photo',"$picture->username,$picture->albumId,$picture->title,$picture->pictureId")) }}
{{ RatingDesignCore::voting($picture->pictureId,'Pictures','center') }}
{{ CommentDesignCore::link($picture->pictureId, 'Picture') }}

<p class="center">{{ $design->like($picture->username, $picture->firstName, $picture->sex) }} | {{ $design->report($picture->profileId, $picture->username, $picture->firstName, $picture->sex) }}</p>
{{ $design->likeApi() }}

{@else@}

<p>{error}</p>

{@/if@}

</div>
