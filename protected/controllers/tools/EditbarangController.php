<?php

class EditbarangController extends Controller
{

    public function actionIndex()
    {
        $model = new Barang('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Barang']))
            $model->attributes = $_GET['Barang'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionSetna()
    {
        if (isset($_POST['ajaxdata']) && !empty($_POST['items'])) {
            $items = $_POST['items'];
            $this->renderJSON($this->_setStatus($items, Barang::STATUS_TIDAK_AKTIF));
        } else {
            $this->renderJSON([
                'sukses' => false,
                'error' => [
                    'code' => 500,
                    'msg' => 'Tidak ada data!'
                ]
            ]);
        }
    }

    public function actionSeta()
    {
        if (isset($_POST['ajaxdata']) && !empty($_POST['items'])) {
            $items = $_POST['items'];
            $this->renderJSON($this->_setStatus($items, Barang::STATUS_AKTIF));
        } else {
            $this->renderJSON([
                'sukses' => false,
                'error' => [
                    'code' => 500,
                    'msg' => 'Tidak ada data!'
                ]
            ]);
        }
    }

    private function _setStatus($items, $status)
    {
        $condition = 'id in (';
        $i = 1;
        $params = [];
        $pertamax = true;
        foreach ($items as $item) {
            $key = ':item' . $i;
            if (!$pertamax) {
                $condition .= ',';
            }
            $condition .= $key;
            $params[$key] = $item;
            $pertamax = false;
            $i++;
        }
        $condition .= ')';
        $rowAffected = Barang::model()->updateAll(['status' => $status], $condition, $params);
        return [
            'sukses' => true,
            'rowAffected' => $rowAffected,
        ];
    }

}