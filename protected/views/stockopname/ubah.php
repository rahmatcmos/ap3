<?php
/* @var $this StockopnameController */
/* @var $model StockOpname */

$this->breadcrumbs = array(
    'Stock Opname' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Ubah',
);

$this->boxHeader['small'] = 'Ubah';
$this->boxHeader['normal'] = "Stock Opname: {$model->nomor}";
?>

<div class="row">
    <div class="small-12 medium-5 right columns">
        <?php
        echo CHtml::ajaxLink('<i class="fa fa-floppy-o"></i> <span class="ak">S</span>impan SO', $this->createUrl('simpanso', array('id' => $model->id)), array(
            'data' => "simpan=true",
            'type' => 'POST',
            'success' => 'function(data) {
                            if (data.sukses) {
                                location.reload();;
                            }
                        }'
                ), array(
            'class' => 'tiny bigfont button right',
            'accesskey' => 's'
                )
        );
        ?>
        <?php
        if ($manualMode) {
            echo CHtml::link('<i class="fa fa-keyboard-o"></i> <span class="ak">M</span>ode Manual', $this->createUrl('ubah', array('id' => $model->id)), array(
                'class' => 'warning tiny bigfont button right',
                'accesskey' => 'm'
            ));
        } else {
            echo CHtml::link('<i class="fa fa-keyboard-o"></i> <span class="ak">M</span>ode Manual', $this->createUrl('ubah', array('id' => $model->id, 'manual' => true)), array(
                'class' => 'secondary tiny bigfont button right',
                'accesskey' => 'm'
            ));
        }
        ?>
    </div>
    <div class="small-12 medium-7 columns header">
        <div class="hide-for-small-only"><span class="secondary label">Keterangan</span><span class="label"><?php echo empty($model->keterangan) ? '-' : $model->keterangan; ?></span></div>
        <span class="secondary label">Rak</span><span class="label"><?php echo empty($model->rak) ? '-' : $model->rak->nama; ?></span>

    </div>
</div>
<div class="row">
    <?php
    if ($manualMode) {
        $this->renderPartial('_input_manual', array(
            'model' => $model,
            'barangBelumSO' => $barangBelumSO
        ));
    } else {
        $this->renderPartial('_input_detail', array(
            'model' => $model,
        ));
    }
    ?>
</div>
<div class="row" id="so-detail">
    <?php
    $this->renderPartial('_detail', array(
        'model' => $model,
        'modelDetail' => $soDetail
    ));
    ?>
</div>
<?php if (!$manualMode):
    ?>
    <div class="row" id="barang-list" style="display:none">
        <?php
        $this->renderPartial('_barang_list', array(
            'barang' => $barang,
        ));
        ?>
    </div>
    <?php
endif;
?>
<?php
$this->menu = array(
    array('itemOptions' => array('class' => 'divider'), 'label' => false),
    array('itemOptions' => array('class' => 'has-form hide-for-small-only'), 'label' => false,
        'items' => array(
            array('label' => '<i class="fa fa-plus"></i> <span class="ak">T</span>ambah', 'url' => $this->createUrl('tambah'), 'linkOptions' => array(
                    'class' => 'button',
                    'accesskey' => 't'
                )),
            array('label' => '<i class="fa fa-asterisk"></i> <span class="ak">I</span>ndex', 'url' => $this->createUrl('index'), 'linkOptions' => array(
                    'class' => 'success button',
                    'accesskey' => 'i'
                ))
        ),
        'submenuOptions' => array('class' => 'button-group')
    ),
    array('itemOptions' => array('class' => 'has-form show-for-small-only'), 'label' => false,
        'items' => array(
            array('label' => '<i class="fa fa-plus"></i>', 'url' => $this->createUrl('tambah'), 'linkOptions' => array(
                    'class' => 'button',
                )),
            array('label' => '<i class="fa fa-asterisk"></i>', 'url' => $this->createUrl('index'), 'linkOptions' => array(
                    'class' => 'success button',
                ))
        ),
        'submenuOptions' => array('class' => 'button-group')
    )
);
