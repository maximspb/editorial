<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[AuthorNews]].
 *
 * @see AuthorNews
 */
class AuthorNewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AuthorNews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AuthorNews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
