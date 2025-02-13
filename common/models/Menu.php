<?php

namespace common\models;

use Yii;
use mdm\admin\components\Configs;
use yii\db\Query;
use yii\helpers\Url;
use bedezign\yii2\audit\AuditTrailBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent
 * @property string|null $route
 * @property int|null $order
 * @property resource|null $data
 * @property string $icon
 * @property string $option
 * @property int $estado
 * @property int|null $tipo
 * @property Menu[] $menus
 * @property Menu $parent0
 */
class Menu extends \yii\db\ActiveRecord
{
    public $parent_name;

//    public function behaviors() {
//        return [
//            AuditTrailBehavior::className()
//        ];
//    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','parent','route','order','estado','tipo'], 'required'],
            [['parent_name'], 'in',
                'range' => static::find()->select(['name'])->column(),
                'message' => 'Menu "{value}" not found.'],
            [['parent', 'order','tipo'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 255],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['parent' => 'id']],
            [['parent', 'route', 'data', 'order'], 'default'],
            [['parent'], 'filterParent', 'when' => function() {
                return !$this->isNewRecord;
            }],
            [['order'], 'integer'],
            [['route'], 'in',
                'range' => static::getSavedRoutes(),
                'message' => 'Route "{value}" not found.'],
            [['icon', 'option'], 'string']
        ];
    }
    /**
     * Use to loop detected.
     */
    public function filterParent() {
        $parent = $this->parent;
        $db = static::getDb();
        $query = (new Query)->select(['parent'])
            ->from(static::tableName())
            ->where('[[id]]=:id');
        while ($parent) {
            if ($this->id == $parent) {
                $this->addError('parent_name', 'Loop detected.');
                return;
            }
            $parent = $query->params([':id' => $parent])->scalar($db);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
//            'name' => 'Name',
//            'parent' => 'Parent',
//            'route' => 'Route',
//            'order' => 'Order',
//            'data' => 'Data',

            'id' => Yii::t('rbac-admin', 'ID'),
            'name' => Yii::t('rbac-admin', 'Name'),
            'parent' => Yii::t('rbac-admin', 'Parent'),
            //'parent_name' => Yii::t('rbac-admin', 'Parent Name'),
            'route' => Yii::t('rbac-admin', 'Route'),
            'order' => Yii::t('rbac-admin', 'Order'),
            'data' => Yii::t('rbac-admin', 'Data'),
            //'icon' => Yii::t('rbac-admin', 'Icono'),
            //'option' => Yii::t('rbac-admin', 'Opcion'),
        ];
    }

    /**
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Menu::class, ['id' => 'parent']);
    }
    /**
     * Get menu children
     * @return \yii\db\ActiveQuery
     */
    public function getMenus() {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }

    private static $_routes;

    /**
     * Get saved routes.
     * @return array
     */
    public static function getSavedRoutes() {
        if (self::$_routes === null) {
            self::$_routes = [];
            foreach (Configs::authManager()->getPermissions() as $name => $value) {
                if ($name[0] === '/' && substr($name, -1) != '*') {
                    self::$_routes[] = $name;
                }
            }
        }
        return self::$_routes;
    }

    public static function getMenuSource() {
        $tableName = static::tableName();
        return (new \yii\db\Query())
            ->select(['m.id', 'm.name', 'm.route', 'parent_name' => 'p.name'])
            ->from(['m' => $tableName])
            ->leftJoin(['p' => $tableName], '[[m.parent]]=[[p.id]]')
            ->all(static::getDb());
    }

    public static function getArbolMenu() {

        return self::makeTree(self::find()->orderBy(['order' => SORT_ASC])->all());
    }
    public static function addToTree($id) {
        $tree = [];

        if ($menus = self::find()->where(['parent' => $id])->orderBy(['order' => SORT_ASC])->all()) {
            foreach ($menus as $item) {
                if (self::find()->where(['parent' => $item->id])->count()) {
                    $tree[] = [
                        'icon' => "fa fa-" . $item->icon,
                        'text' => $item->name,
                        'nodes' => self::addToTree($item->id),
                        'state' => [
                            'expanded' => true,
                        ],
                        'href' => Url::to(['menu/update', 'id' => $item->id])
                    ];
                } else {
                    $tree[] = [
                        'icon' => "fa fa-" . $item->icon,
                        'text' => $item->name,
                        'state' => [
                            'expanded' => true,
                        ],
                        'href' => Url::to(['menu/update', 'id' => $item->id])
                    ];
                }
            }
        }

        return $tree;
    }

    public static function makeTree($values) {
        $tree = [];
        $rTree = &$tree;
        foreach ($values as $item) {
            if (!$item->parent) {
                if (self::find()->where(['parent' => $item->id])->count()) {
                    $tree[] = [
                        'icon' => "fa fa-" . $item->icon,
                        'text' => $item->name,
                        'nodes' => self::addToTree($item->id),
                        'href' => Url::to(['menu/update', 'id' => $item->id])
                    ];
                } else {
                    $tree[] = [
                        'icon' => "fa fa-" . $item->icon,
                        'text' => $item->name,
                        'href' => Url::to(['menu/update', 'id' => $item->id])
                    ];
                }
            }
        }
        return $tree;
    }
}
