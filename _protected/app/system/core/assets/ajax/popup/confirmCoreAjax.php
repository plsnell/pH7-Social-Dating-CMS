<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Core / Asset / Ajax / Popup
 */
namespace PH7;
defined('PH7') or exit('Restricted access');

use
PH7\Framework\Mvc\Request\HttpRequest,
PH7\Framework\Layout\Html\Design,
PH7\Framework\Url\Url,
PH7\Framework\Mvc\Router\UriRoute,
PH7\Framework\Url\HeaderUrl;

if (AdminCore::auth() || UserCore::auth() || AffiliateCore::auth())
{
    $oDesign = new Design;
    $oDesign->htmlHeader();
    $oDesign->usefulHtmlHeader();
    $oHttpRequest = new HttpRequest;
    echo '<div class="center">';

    if ($oHttpRequest->getExists( array('mod', 'ctrl', 'act', 'id') ))
    {
        $sLabel = $oHttpRequest->get('label');
        $sMod = $oHttpRequest->get('mod');
        $sCtrl = $oHttpRequest->get('ctrl');
        $sAct = $oHttpRequest->get('act');
        $mId = $oHttpRequest->get('id');

        ConfirmCoreForm::display( array('label' => Url::decode($sLabel), 'module' => $sMod, 'controller' => $sCtrl, 'action' => $sAct, 'id' => $mId) );
    }
    else
    {
        echo '<p>' . t('Bad parameters in the URL!') . '</p>';
    }

    echo '</div>';
    $oDesign->htmlFooter();
    unset($oDesign, $oHttpRequest);
}
else
{
    HeaderUrl::redirect(UriRoute::get('user', 'signup', 'step1'), t('You must register to report the abuse.'));
}
