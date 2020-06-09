<?=

//ListView Widget
//        dataProvier => Data to be Listed
//        options => Html attributes of list wrapper tag
//        layout => Main layout of list view
//        itemView => template for rendering each list item
//        itemOptions => Html attributes for each list item wrapper tag
//        summary => Template for rendering summary hints in list header
//        summaryOptions => Html attributes for summary wrapper tag
//        pager    => Configuration for pagination
//                firstPageLabel
//                lastPageLabel
//                nextPageLabel
//                prePageLabel
//                maxButtonCount
        

yii\widgets\ListView::widget([
    'dataProvider' => $listDataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper'
    ],
    'layout' => "{pager}\n{items}\n{summary}",
    'itemView' => '_list_item',    //4 variants are passed in partual template:  $model, $key, $index, $widget
    //Alternative is:
//    'itemView' => function($model, $key, $index, $widget){
//        return $this->render('_list_item', ['model' => $model]);
//        return $model->title . ' is of status ' . $model->status;
//    },
    'pager' => [
        'firstPageLabel' => 'first',
        'lastPageLabel' => 'last',
        'nextPageLabel' => 'next',
        'prevPageLabel' => 'previous',
        'maxButtonCount' => 3
    ],
    //It is abstracted to a class named yii\widgets\LinkPager.
]);

?>