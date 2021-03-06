<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Connect / Controller
 */
namespace PH7;

class AdminController extends MainController
{

    public function config()
    {
        $this->sTitle = t('Config Universal Login');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;
        $this->output();
    }

}
