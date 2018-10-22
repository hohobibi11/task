<?php

namespace app\models;

use Yii;

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
 */
class Book extends \yii\db\ActiveRecord
{
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
            [['title'], 'string', 'max' => 45],
            [['isbn'], 'string', 'max' => 10],
            [['isbn'], 'unique'],
            [['authors'],'required' , 'message'=>'Please choose an author'],
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
            'date_pub' => 'Date Publication',
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
    public function setAuthors($authors)
    {
        foreach ($authors as $author) {
            $r = new BookHasAuthor();
            $r->book_id = $this->id;
            $r->author_id = 3;
            $r->save();
        }   
    }

    /* public function afterSave($insert,$chngedAttributes)
    {
        foreach ($this->authors as $author) {
            $r = new BookHasAuthor();
            $r->book_id = $this->id;
            $r->author_id = $author->id;
            $r->save();
        }
        
    }*/
}
