<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 * @property string $f_name
 * @property string $birth
 *
 * @property BookHasAuthor[] $bookHasAuthors
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    public function getFullName()
    {
        return $this->name.' '.$this->f_name;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'f_name', 'birth'], 'required'],
            [['birth'], 'safe'],
            [['name', 'f_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'f_name' => 'Familly Name',
            'birth' => 'Birth Day',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookHasAuthors()
    {
        return $this->hasMany(BookHasAuthor::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('book_has_author', ['author_id' => 'id']);
    }
}
