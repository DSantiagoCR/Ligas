<?php


namespace common\models\util;
use common\models\Menu;
use Yii;
use yii\helpers\Html;
use function PHPUnit\Framework\isNull;

class ScriptMenu
{
    public function obtenerMenu()
    {
        $arrayMenuPantalla=[];
        $arrayIdMunuPadres=$this->scriptBddMenusPadre();

        $modelMenusPrincipal = Menu::find()
            ->where(['in','id',$arrayIdMunuPadres])
            ->all();

        foreach ($modelMenusPrincipal as $menu)
        {
            $arrayMenuPantalla[]=[
                'label' => strtoupper($menu->name),
                'icon' => $menu->icon,
                'badge' => '',
                'items' => $this->obtenerMenuHijos($menu->id),
            ];
        }
        return $arrayMenuPantalla;
    }
    private function obtenerMenuHijos($idMenuPadre)
    {
        $arrayItems=[];
        $arrayMunuHijos=$this->scriptBddMenusHijos();

        foreach ($arrayMunuHijos as $array)
        {
            if($idMenuPadre==$array['parent'])
            {
                $arrayItems[]=['label' => $array['name'], 'url' => [$array['route']], 'iconStyle' =>'fa fa-'.$array['icon'] ];
            }
        }
        return $arrayItems;
    }
    private function scriptBddMenusPadre()
    {
        $idUser = '-1';
        if(isset(Yii::$app->user->identity))
        {
            $idUser=Yii::$app->user->identity->getId();
        }
        $query ="select distinct parent
                            from menu where route IN(
                            select distinct child from auth_item_child where parent in 
                            (
                                    select distinct child from auth_item_child where parent in 
                                    (                                        
                                        select b.item_name from auth_item a , auth_assignment b 
                                            where a.name = b.item_name and a.type = '1' and b.user_id = '$idUser'
                                    )
                            )
                    )
                    and estado =1
                    order by parent;
                ";
        $con = Yii::$app->db;
        $resultado = $con->createCommand($query)->queryColumn();
        return $resultado;
    }
    private function scriptBddMenusHijos()
    {
        $idUser = '-1';
        if(isset(Yii::$app->user->identity))
        {
            $idUser=Yii::$app->user->identity->getId();
        }

        $query ="select distinct id,name,parent,route,menu.order,menu.data,icon,menu.option,estado 
                            from menu where route  IN(
                            select distinct child from auth_item_child where parent in 
                            (
                                    select distinct child from auth_item_child where parent in 
                                    (
                                        
                                        select b.item_name from auth_item a , auth_assignment b 
                                            where a.name = b.item_name and a.type = '1' and b.user_id = '$idUser'
                                    )
                            )
                    )
                    and estado =1
                    order by menu.parent,menu.order;
                ";
        $con = Yii::$app->db;
        $resultado = $con->createCommand($query)->queryAll();
        return $resultado;
    }

}