<?php

namespace app\models;

use Yii;
use yii\web\HttpException;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property string $isbn
 * @property string $date_pub
 *
 * @property BookHasAuthor[] $bookHasAuthors
 * @property Author[] $authors
 * @property int[] $authorIds
 */
class Book extends \yii\db\ActiveRecord
{

    // new property
    private $_authorIds;
    public function getAuthorIds()
    {
        return $this->_authorIds;
    }
    public function setAuthorIds($ids)
    {
        $this->_authorIds = $ids;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'isbn', 'date_pub'], 'required'],
            [['date_pub'], 'safe'],
            [['date_pub'],'date', 'format' => 'php:Y-m-d'],
            [['title'], 'string', 'max' => 45],
            [['isbn'], 'string', 'max' => 10],
            [['isbn'], 'unique'],
            [['isbn'], 'match','pattern'=>'/^\d{9}[\d|X]$/'],
            [['authorIds'],'required' , 'message'=>'Please choose an author or create one if it does not exist'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'isbn' => 'Code ISBN',
            'date_pub' => 'Publishing Date',
            'authorIds' => 'Add Ahthors'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookHasAuthors()
    {
        return $this->hasMany(BookHasAuthor::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])->viaTable('book_has_author', ['book_id' => 'id']);
    }
    

     public function afterSave($insert,$chngedAttributes)
    {

        //deleting all existing record for update
        BookHasAuthor::deleteAll(['book_id' => $this->id]);
        
        //setting the new relations
        foreach ($this->_authorIds as $id) {
            $r = new BookHasAuthor();
            $r->book_id = $this->id ;
            $r->author_id = $id;
            $r->save();
        }
        
    }
}
