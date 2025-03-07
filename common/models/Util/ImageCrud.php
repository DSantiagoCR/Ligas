<?php


namespace common\models\Util;
use common\models\Menu;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\models;

class ImageCrud
{
    public function almacenaImagen($model,$campoPath,$pathShipServer,$pathShip)
    {
        /*FC: 2023-05-30    CP: Santiago C      FM:         MP
        NOTE:Guarda un archivo de tipo jpg, o png, enla direccion enviada en $pathShipServer
        */
        $resp = true;
        $imageFile = UploadedFile::getInstance($model, $campoPath);
        if(true)//$imageFile->extension == 'jpg' or $imageFile->extension == 'png')
        {
            if (!file_exists($pathShipServer)) {
                //FileHelper::createDirectory($pathShipServer);
                mkdir($pathShipServer, 0777,true);
            }
            $filePath = $pathShipServer. $model->id.'.'. $imageFile->extension;
            // Comprobar si la carpeta es escribible
            //$filePath = 'c:/imagen/'. $model->id.'.'. $imageFile->extension;;
            if (is_writable($pathShipServer))
            {
                if($imageFile->saveAs($filePath))
                {
                    $model->link_foto =  $pathShip. $model->id.'.'. $imageFile->extension;
                    $model->save();
                }
                else
                {

                }

            } else {
                if (chmod($pathShipServer, 0777))
                {
                    if($imageFile->saveAs($filePath))
                    {
                        $model->link_foto =  $pathShip. $model->id.'.'. $imageFile->extension;
                        $model->save();
                    }else
                    {

                    }
                } else {

                }
            }
        }
        else
        {
            $resp = false;
        }
        return $resp;
    }
    public function almacenaImagenEquipos($model,$campoPath,$pathShipServer,$pathShip)
    {
        
        $resp = true;
        $imageFile = UploadedFile::getInstance($model, $campoPath);
        if(true)//$imageFile->extension == 'jpg' or $imageFile->extension == 'png')
        {
            if (!file_exists($pathShipServer)) {
                //FileHelper::createDirectory($pathShipServer);
                mkdir($pathShipServer, 0777,true);
            }
            $filePath = $pathShipServer. $model->id.'.'. $imageFile->extension;
            // Comprobar si la carpeta es escribible
            //$filePath = 'c:/imagen/'. $model->id.'.'. $imageFile->extension;;
            if (is_writable($pathShipServer))
            {
                if($imageFile->saveAs($filePath))
                {
                    $model->link_logotipo =  $pathShip. $model->id.'.'. $imageFile->extension;
                    $model->save();
                }
                else
                {

                }

            } else {
                if (chmod($pathShipServer, 0777))
                {
                    if($imageFile->saveAs($filePath))
                    {
                        $model->link_logotipo =  $pathShip. $model->id.'.'. $imageFile->extension;
                        $model->save();
                    }else
                    {

                    }
                } else {

                }
            }
        }
        else
        {
            $resp = false;
        }
        return $resp;
    }
    public function eliminaImangen($pathServerFile)
    {
        /*FC: 2023-05-30    CP: Santiago C      FM:         MP
        NOTE: elimina el archivo que se envie en el path
        */
        if (file_exists($pathServerFile)) {
            // Intentar eliminar el archivo
            if (unlink($pathServerFile)) {
                // El archivo se ha eliminado correctamente
                //echo 'El archivo se ha eliminado correctamente.';
            } else {
                // No se pudo eliminar el archivo
                //echo 'No se pudo eliminar el archivo.';
            }
        } else {
            // El archivo no existe
            //echo 'El archivo no existe.';
        }
    }
    public function copiaImagen($model,$ruta)
    {
        /*FC: 2023-06-22    CP: Santiago C      FM:         MP
               NOTE: metodo creado para copiar las imagenes del itinerario de back al front
               */
        $imageFile = UploadedFile::getInstance($model, 'path');
        $root = Yii::getAlias('@webroot');
        $pathDirectoryFrontend = $ruta;
        $pathDirectoryFrontend = str_replace('backend', 'frontend', $root).$pathDirectoryFrontend;
        $pathImagenFrontend = $pathDirectoryFrontend. $model->id.'.'. $imageFile->extension;


        $filePath = Yii::getAlias('@webroot').$ruta. $model->id.'.'. $imageFile->extension;

        if (!file_exists($pathDirectoryFrontend)) {
            //FileHelper::createDirectory($pathShipServer);
            mkdir($pathDirectoryFrontend, 0777,true);
        }
        copy($filePath, $pathImagenFrontend);
    }
    public function eliminarImagenCopia($model,$ruta)
    {
        /*FC: 2023-06-22    CP: Santiago C      FM:2023-08-16         MP: Santiago C.
               NOTE: elimina la imagen del frontend de itineario
        */

        $root = Yii::getAlias('@webroot');
        $pathDirectoryFrontend = $ruta;
//        $pathDirectoryFrontend = str_replace('backend', 'frontend', $root).$pathDirectoryFrontend;
        $pathDirectoryFrontend = str_replace('backend', 'frontend', $root);
        $pathImagenFrontend = $pathDirectoryFrontend. $model->path;

        if (file_exists($pathImagenFrontend)) {
            unlink($pathImagenFrontend);
        }
        $model->path ="PATH:".$pathImagenFrontend;

    }

}