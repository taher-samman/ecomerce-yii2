<?php
// https://github.com/mohorev/yii2-upload-behavior
namespace common\models;

use Yii;

/**
 * This is the model class for table "products_images".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $value
 *
 * @property Products $product
 */
class ProductsImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['value'], 'string'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::class,
                'attribute' => 'file',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/upload/docs/{category.id}',
                'url' => '@web/upload/docs/{category.id}',
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }
}
