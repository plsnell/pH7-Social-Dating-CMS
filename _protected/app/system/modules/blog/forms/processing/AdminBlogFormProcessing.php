<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Blog / Form / Processing
 */
namespace PH7;
defined('PH7') or die('Restricted access');

use
PH7\Framework\Mvc\Model\Engine\Db,
PH7\Framework\Mvc\Request\HttpRequest,
PH7\Framework\Url\HeaderUrl,
PH7\Framework\Mvc\Router\UriRoute;

class AdminBlogFormProcessing extends Form
{

    private $sMsg;

    public function __construct()
    {
        parent::__construct();

        $oBlog = new Blog;
        $oBlogModel = new BlogModel;

        if (!$oBlog->checkPostId($this->httpRequest->post('post_id')))
        {
            \PFBC\Form::setError('form_blog', t('The ID of the article is invalid or incorrect.'));
        }
        else
        {
            $aData = [
                'post_id' => $this->httpRequest->post('post_id'),
                'lang_id' => $this->httpRequest->post('lang_id'),
                'title' => $this->httpRequest->post('title'),
                'content' => $this->httpRequest->post('content', HttpRequest::ONLY_XSS_CLEAN), // HTML contents, So we use the constant: \PH7\Framework\Mvc\Request\HttpRequest::ONLY_XSS_CLEAN
                'slogan' => $this->httpRequest->post('$slogan'),
                'tags'=> $this->httpRequest->post('tags'),
                'page_title' => $this->httpRequest->post('page_title'),
                'meta_description' => $this->httpRequest->post('meta_description'),
                'meta_keywords' => $this->httpRequest->post('meta_keywords'),
                'meta_robots' => $this->httpRequest->post('meta_robots'),
                'meta_author' => $this->httpRequest->post('meta_author'),
                'meta_copyright' => $this->httpRequest->post('meta_copyright'),
                'enable_comment' => $this->httpRequest->post('enable_comment'),
                'created_date' => $this->dateTime->get()->dateTime('Y-m-d H:i:s')
            ];

            if (!$oBlogModel->addPost($aData))
            {
                $this->sMsg = t('An error occurred while adding the article.');
            }
            else
            {
                $iBlogId = Db::getInstance()->lastInsertId();

                // Thumbnail
                $oPost = $oBlogModel->readPost($iBlogId);
                $oBlog->setThumb($this->file, $oPost);

                // WARNING: Be careful, you should use the \PH7\Framework\Mvc\Request\HttpRequest::ONLY_XSS_CLEAN constant otherwise the post method of the HttpRequest class removes the tags special
                // and damages the SET function SQL for entry into the database.
                foreach ($this->httpRequest->post('category_id', HttpRequest::ONLY_XSS_CLEAN) as $iCategoryId)
                    $oBlogModel->addCategory($iCategoryId, $iBlogId);

                /* Clean BlogModel Cache */
                (new Framework\Cache\Cache)->start(BlogModel::CACHE_GROUP, null, null)->clear();

                $this->sMsg = t('Post created successfully!');
            }
            HeaderUrl::redirect(UriRoute::get('blog', 'main', 'read', $this->httpRequest->post('post_id')), $this->sMsg);
        }
    }

}
