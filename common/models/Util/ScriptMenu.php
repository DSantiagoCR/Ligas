<?php


namespace common\models\util;
use common\models\Menu;
use Yii;
use yii\helpers\Html;
use function PHPUnit\Framework\isNull;

class ScriptMenu
{
    public function obtenerMenuBackend()
    {
        $arrayMenuPantalla=[];
        $tipo = 0; //0 = backend
        $arrayIdMunuPadres=$this->scriptBddMenusPadre($tipo);

        $modelMenusPrincipal = Menu::find()
            ->where(['in','id',$arrayIdMunuPadres])
            ->all();

        foreach ($modelMenusPrincipal as $menu)
        {
            $arrayMenuPantalla[]=[
                'label' => strtoupper($menu->name),
                'icon' => $menu->icon,
                'badge' => '',
                'items' => $this->obtenerMenuHijos($menu->id,$tipo),
            ];
        }
        return $arrayMenuPantalla;
    }
    public function obtenerMenuFrontend()
    {
        $arrayMenuPantalla=[];
        $tipo = 1; //1 = frontend
        $arrayIdMunuPadres=$this->scriptBddMenusPadre($tipo);

        $modelMenusPrincipal = Menu::find()
            ->where(['in','id',$arrayIdMunuPadres])
            ->all();

        foreach ($modelMenusPrincipal as $menu)
        {
            $arrayMenuPantalla[]=[
                'label' => strtoupper($menu->name),
                'icon' => $menu->icon,
                'badge' => '',
                'items' => $this->obtenerMenuHijos($menu->id,$tipo),
            ];
        }
        return $arrayMenuPantalla;
    }
    private function obtenerMenuHijos($idMenuPadre,$tipo)
    {
        $arrayItems=[];
        $arrayMunuHijos=$this->scriptBddMenusHijos($tipo);

        foreach ($arrayMunuHijos as $array)
        {
            if($idMenuPadre==$array['parent'])
            {
                $arrayItems[]=['label' => $array['name'], 'url' => [$array['route']], 'iconStyle' =>'fa fa-'.$array['icon'] ];
            }
        }
        return $arrayItems;
    }
    private function scriptBddMenusPadre($tipo)
    {
        $idUser = '-1';
        if(isset(Yii::$app->user->identity))
        {
            $idUser=Yii::$app->user->identity->getId();
        }
        $query ="select distinct parent 
                            from menu where route IN (
                            select distinct child from auth_item_child where parent in 
                            (
                                    select distinct child from auth_item_child where parent in 
                                    (                                        
                                        select b.item_name from auth_item a , auth_assignment b 
                                            where a.name = b.item_name and a.type = '1' and b.user_id = '$idUser'
                                    )
                            )
                    )
                    and menu.estado =1 and menu.tipo = $tipo
                    order by parent;
                ";
        $con = Yii::$app->db;
        $resultado = $con->createCommand($query)->queryColumn();
        return $resultado;
    }
    private function scriptBddMenusHijos($tipo)
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
                    and menu.estado =1 and menu.tipo = $tipo
                    order by menu.parent,menu.order;
                ";
        $con = Yii::$app->db;
        $resultado = $con->createCommand($query)->queryAll();
        return $resultado;
    }

}