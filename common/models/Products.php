<?php

namespace common\models;

use common\behaviors\ProductPriceFormatBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property int $status
 * @property string|null $description
 * @property float $price
 * @property float|null $special_price
 * @property int $qty
 * @property int|null $max_qty_allowed
 * @property int|null $min_qty_allowed
 * @property int $created_at
 * @property int $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
    const ENABLED = 1;
    const DISABLED = 0;
    const DATE_FORMAT = 'Y-m-d';
    const DATETIME_FORMAT = 'Y-m-d H:i:s';
    const TIME_FORMAT = 'H:i:s';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sku', 'price', 'qty'], 'required'],
            [['status', 'qty', 'max_qty_allowed', 'min_qty_allowed'], 'integer'],
            [['description'], 'string'],
            [['price', 'special_price'], 'number'],
            [['name', 'sku'], 'string', 'max' => 255],
            [['sku'], 'unique'],
            [['status'], 'default', 'value' => self::ENABLED],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date(self::DATETIME_FORMAT);
                }
            ],
            [
                'class' => ProductPriceFormatBehavior::class,
                'attributes' => ['price', 'special_price']
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sku' => 'Sku',
            'status' => 'Status',
            'description' => 'Description',
            'price' => 'Price',
            'special_price' => 'Special Price',
            'qty' => 'Qty',
            'max_qty_allowed' => 'Max Qty Allowed',
            'min_qty_allowed' => 'Min Qty Allowed',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
