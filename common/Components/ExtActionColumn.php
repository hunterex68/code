<?php

namespace common\components;

use yii\grid\ActionColumn;
use yii\helpers\Html;

class ExtActionColumn extends ActionColumn {

    public $filter;

    /**
     * Renders the filter cell.
     */
    public function renderFilterCell() {
        return Html::tag('td', '<div class="filter-container">' . $this->filter . '</div>', $this->filterOptions);
    }
}
