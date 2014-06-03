<?php
namespace base;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\data\Pagination;
use common\models\Board;

/**
 * Site controller
 */
class BaseController extends Controller
{

	private $_cachedBoards;

	public function getCachedBoards()
	{
		if ($this->_cachedBoards == null)
		{
			$this->_cachedBoards = YiiForum::getAppParam('cachedBoards');
		}
		return $this->_cachedBoards;
	}

	public function getBoard($id, $fromCache = True)
	{
		if ($fromCache)
		{
			$cahcedBoards = $this->getCachedBoards();
			return $cahcedBoards[$id];
		}
		
		return Board::findOne([
				'id' => $id
		]);
	}
	
	public function noPermission()
	{
		return 'no permission';
	}
}
