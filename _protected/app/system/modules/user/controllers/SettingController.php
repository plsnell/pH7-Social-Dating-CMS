<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / User / Controller
 */
namespace PH7;

use PH7\Framework\Url\HeaderUrl, PH7\Framework\Mvc\Router\UriRoute;

class SettingController extends Controller
{

    private $_sUsername, $_sFirstName, $_sSex, $_sTitle, $_iProfileId, $_bAdminLogged;

    public function __construct()
    {
        parent::__construct();

        $this->_bAdminLogged = (AdminCore::auth() && !User::auth());
        $this->_iProfileId = (int) ($this->_bAdminLogged && $this->httpRequest->getExists('profile_id')) ? $this->httpRequest->get('profile_id') : $this->session->get('member_id');
        $this->_sUsername = ($this->_bAdminLogged && $this->httpRequest->getExists('username')) ? $this->httpRequest->get('username') : $this->session->get('member_username');
        $this->_sFirstName = ($this->_bAdminLogged && $this->httpRequest->getExists('first_name')) ? $this->httpRequest->get('first_name') : $this->session->get('member_first_name');
        $this->_sSex = ($this->_bAdminLogged && $this->httpRequest->getExists('sex')) ? $this->httpRequest->get('sex') : $this->session->get('member_sex');

        /** For the avatar on the index and avatar page **/
        $this->view->username = $this->_sUsername;
        $this->view->first_name = $this->_sFirstName;
        $this->view->sex = $this->_sSex;
        $this->view->avatarDesign = new AvatarDesignCore; // Avatar Design Class

        /** For the wallpaper on the index and design page **/
        $this->view->path_img_background = $this->_getWallpaper();

        /** For the 'display_status' function on the index and privacy page **/
        $this->design->addJs(PH7_LAYOUT . PH7_SYS . PH7_MOD . $this->registry->module . PH7_DS . PH7_TPL . PH7_TPL_MOD_NAME . PH7_DS . PH7_JS, 'common.js');
    }

    public function index()
    {
        // Add Css Style for Tabs
        $this->design->addCss(PH7_LAYOUT . PH7_TPL . PH7_TPL_NAME . PH7_DS . PH7_CSS, 'tabs.css');

        $this->_sTitle = t('Account Settings');
        $this->view->page_title = $this->_sTitle;
        $this->view->h2_title = $this->_sTitle;
        $this->output();
    }

    public function edit()
    {
        $this->_sTitle = t('Edit Your Profile');
        $this->view->page_title = $this->_sTitle;
        $this->view->h2_title = $this->_sTitle;
        $this->output();
    }

    public function avatar()
    {
        $this->view->page_title = t('Photo of profile');
        $this->view->h2_title = t('Change your Avatar');

        if ($this->httpRequest->postExists('del'))
            $this->_removeAvatar();

        $this->output();
    }

    public function design()
    {
        $this->_sTitle = t('Your Wallpaper');
        $this->view->page_title = $this->_sTitle;
        $this->view->h2_title = $this->_sTitle;

        if ($this->httpRequest->postExists('del'))
            $this->_removeWallpaper();

        $this->output();
    }

    public function notification()
    {
        $this->_sTitle = t('Notifications');
        $this->view->page_title = $this->_sTitle;
        $this->view->h2_title = $this->_sTitle;
        $this->output();
    }

    public function privacy()
    {
        $this->_sTitle = t('Privacy Settings');
        $this->view->page_title = $this->_sTitle;
        $this->view->h2_title = $this->_sTitle;
        $this->output();
    }

    public function password()
    {
        $this->_sTitle = t('Change Password');
        $this->view->page_title = $this->_sTitle;
        $this->view->h2_title = $this->_sTitle;
        $this->output();
    }

    public function delete()
    {
        $this->_sTitle = t('Delete Account');
        $this->view->page_title = $this->_sTitle;
        $this->view->h2_title = $this->_sTitle;

        if ($this->httpRequest->get('delete_status') == 'yesdelete')
        {
            $this->session->set('yes_delete', 1);
            HeaderUrl::redirect(UriRoute::get('user', 'setting', 'yesdelete'));
        }
        elseif ($this->httpRequest->get('delete_status') == 'nodelete')
        {
            $this->view->content = t('<span class="bold green1">Great, you stay with us!<br />
            You see, you will not regret it!<br />We will do our best to you our %site_name%!</span>');
            $this->design->setRedirect(UriRoute::get('user', 'main', 'index'), null, null, 3);
        }
        else
        {
            $this->view->content = '<span class="bold red">' . t('Are you really sure you want to delete your account?') . '</span><br /><br />
                <a class="bold" href="' . UriRoute::get('user', 'setting', 'delete', 'nodelete') . '">' . t('No I changed my mind and I stay with you!') .
                '</a> &nbsp; ' . t('OR') . ' &nbsp; <a href="' . UriRoute::get('user',
                'setting', 'delete', 'yesdelete') . '">' . t('Yes I really want to delete my account') . '</a>';
        }

        $this->output();
    }

    public function yesDelete()
    {
        if (!$this->session->exists('yes_delete'))
            HeaderUrl::redirect(UriRoute::get('user', 'setting', 'delete'));
        else
            $this->output();
    }


    private function _removeAvatar()
    {
        (new UserCore)->deleteAvatar($this->_iProfileId, $this->_sUsername);
        HeaderUrl::redirect(null, t('Your avatar has been deleted successfully!'));
    }

    private function _getWallpaper()
    {
        $sBackground = (new UserModel)->getBackground($this->_iProfileId, 1);
        return (!empty($sBackground)) ? PH7_URL_DATA_SYS_MOD . 'user/background/img/' . $this->_sUsername . PH7_DS . $sBackground : PH7_URL_TPL .
            PH7_TPL_NAME . PH7_DS . PH7_IMG . 'icon/none.jpg';
    }

    private function _removeWallpaper()
    {
        (new UserCore)->deleteBackground($this->_iProfileId, $this->_sUsername);
        HeaderUrl::redirect(null, t('Your wallpaper has been deleted successfully!'));
    }

}
