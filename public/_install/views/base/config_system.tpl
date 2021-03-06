{include file="inc/header.tpl"}

<h2>{$LANG.config_system}</h2>

{include file="inc/errors.tpl"}

<form method="post" action="{$smarty.const.PH7_URL_SLUG_INSTALL}config_system">

    <p><span class="mandatory">*</span> <label for="db_hostname">{$LANG.db_hostname} :</label><br />
    <small>{$LANG.desc_db_hostname}</small><br />
    <input type="text" name="db_hostname" id="db_hostname" onfocus="if ('localhost' == this.value) this.value='';" onblur="if ('' == this.value) this.value = 'localhost';" value="{$smarty.session.db.db_hostname}" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="db_name">{$LANG.db_name} :</label><br />
    <input type="text" name="db_name" id="db_name" onfocus="if ('PHS-SOFTWARE' == this.value) this.value='';" onblur="if ('' == this.value) this.value = 'PHS-SOFTWARE';" value="{$smarty.session.db.db_name}" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="db_username">{$LANG.db_username} :</label><br />
    <input type="text" name="db_username" id="db_username" onfocus="if ('root' == this.value) this.value='';" onblur="if ('' == this.value) this.value = 'root';" value="{$smarty.session.db.db_username}" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="db_password">{$LANG.db_password} :</label><br />
    <input type="password" id="db_password" name="db_password" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="db_prefix">{$LANG.db_prefix} :</label><br />
    <small>{$LANG.desc_db_prefix}</small><br />
    <input type="text" name="db_prefix" id="db_prefix" onfocus="if ('PH7_' == this.value) this.value='';" onblur="if ('' == this.value) this.value = 'PH7_';" value="{$smarty.session.db.db_prefix}" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="db_charset">{$LANG.charset} :</label><br />
    <small>{$LANG.desc_charset}</small><br />
    <input type="text" name="db_charset" id="db_charset" onfocus="if ('UTF8' == this.value) this.value='';" onblur="if ('' == this.value) this.value = 'UTF8';" value="{$smarty.session.db.db_charset}" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="db_port">{$LANG.db_port} :</label><br />
    <input type="text" name="db_port" id="db_port" onfocus="if ('3760' == this.value) this.value='';" onblur="if ('' == this.value) this.value = '3760';" value="{$smarty.session.db.db_port}" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="ffmpeg_path">{$LANG.ffmpeg_path} :</label><br />
    <input type="text" name="ffmpeg_path" id="ffmpeg_path" value="{$smarty.session.value.ffmpeg_path}" required="required" /></p>

    <p><span class="mandatory">*</span> <label for="bug_report_email">{$LANG.bug_report_email} :</label><br />
    <input type="email" name="bug_report_email" id="bug_report_email" value="{$smarty.session.value.bug_report_email}" required="required" /></p>

    <p><input type="submit" name="config_system_submit" value="{$LANG.next}" /></p>

</form>

{include file="inc/footer.tpl"}
