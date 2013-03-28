<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{
	const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';
    
	public $salt;
	public $new_password;
	public $new_confirm;
	public $verifyCode;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, new_password','required'),
			array('username', 'match', 'pattern'=>'#^[a-zA-Z0-9_\.-]+$#', 'message'=>'Incorrect login'),
			array('email', 'email', 'message'=>'Incorrect e-mail'),
			array('username, email', 'unique', 'caseSensitive'=>false),
			array('email, username', 'unique'), 
			array('new_password', 'length', 'min'=>5, 'allowEmpty'=>true),
			array('new_confirm', 'compare', 'compareAttribute'=>'new_password', 'message'=>'Passwords does not match'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'register'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, ban, role', 'safe', 'on'=>'search'),
			
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'new_password' => 'New password',
			'new_confirm' => 'Confirm password',
			'email' => 'Email',
			'ban' => 'Ban',
			'role' => 'Role',
			'verifyCode'=>'Verification Code',
		);
	}
	
	protected function beforeSave() 
	{ 
		if($this->isNewRecord)
		{
			$this->created = time();
			$this->role = 0;
		}
		
		if($this->email)
			$this->email = trim($this->email);
			
		if($this->username)
			$this->username = trim($this->username);
			
		if ($this->new_password) 
			$this->password = $this->hashPassword(trim($this->new_password));
			
		return parent::beforeSave();
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return md5($this->salt.$password)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return md5($this->generateSalt().$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
	 * requires, for the Blowfish hash algorithm, a salt string in a specific format:
	 *  - "$2a$"
	 *  - a two digit cost parameter
	 *  - "$"
	 *  - 22 characters from the alphabet "./0-9A-Za-z".
	 *
	 * @param int cost parameter for Blowfish hash algorithm
	 * @return string the salt
	 */
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=sha1($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
		$this->salt = $salt;
		return $salt;
	}
	
	public function afterFind()
	{
		$dateFormat = "d.m.Y H:i";
				
		if($this->created)
			$this->created = date($dateFormat,$this->created);

		return parent::afterFind();
	}
	
	public static function allUsers()
	{
		return Chtml::listData(self::model()->findAll(),'id','username');
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('ban',$this->ban);
		$criteria->compare('role',$this->role);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
