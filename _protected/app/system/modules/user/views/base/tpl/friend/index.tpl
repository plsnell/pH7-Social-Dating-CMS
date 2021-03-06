<div class="center" id="friend_block">

{@if(empty($error))@}

<p class="italic underline"><strong><a href="{{$design->url('user','friend','index',$username)}}">{friend_number}</a></strong></p><br />

{@foreach($friends as $f)@}

<div class="s_photo" id="friend_{% $f->fdId %}">

  {{ $avatarDesign->get($f->username, $f->firstName, $f->sex, 64, true) }}

  {@if(User::auth() && $sess_member_id == $member_id)@}
    {@if($sess_member_id == $f->friendId && $f->pending == 1)@}
     <small>{@lang('Pending...')@}</small> <a href="javascript:void(0)" onclick="friend('approval',{% $f->fdId %},'{csrf_token}')">{@lang('Approve')@}</a>
    {@/if@}

    <a href="javascript:void(0)" onclick="friend('delete',{% $f->fdId %},'{csrf_token}')">{@lang('Delete')@}</a>
  {@/if@}

</div>

{@/foreach@}

{@main_include('page_nav.inc.tpl')@}
<br />
<p class="center bottom"><a class="m_button" href="{{$design->url('user','friend','search',"$username,$action")}}">{@lang('Search for a friend of %0%', $username)@}</a></p>

{@else@}

<p>{error}</p>

{@/if@}

</div>
