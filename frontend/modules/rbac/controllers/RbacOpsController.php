<?php


namespace frontend\modules\rbac\controllers;

class RbacOpsController extends \yii\web\Controller{

    //User has Roles and Roles has Permissions
    //1) make sure table exists for rbac (run default rbac migration)
    //2) Create Permissions
    //3) Create Roles
    //4) Assign Roles
    
    
    //Will be added in auth item table
    public function actionCreatePermissions(){
        $auth = \Yii::$app->authManager;
        
        //Index
        $index = $auth->createPermission('rbac/default/index');
        $index->description = "Access Index";
        $auth->add($index);
        
        //Create
        $create = $auth->createPermission("rbac/default/create");
        $create->description = "Create Default Data";
        $auth->add($create);
        
        $view = $auth->createPermission("rbac/default/view");
        $view->description = "View Defaulr data";
        $auth->add($view);
        
        $update = $auth->createPermission("rbac/default/update");
        $update->description = "Update default data";
        $auth->add($update);
        
        $delete = $auth->createPermission("rbac/default/delete");
        $delete->description = "Delete Default data";
        $auth->add($delete);
        
        $this->actionCreateRoles($index, $create, $view, $update, $delete);
    }
    
    
    //Will be added in auth irem child table
    public function actionCreateRoles($index, $create, $view, $update, $delete){
        $auth = \Yii::$app->authManager;
        
//        Author => Create/View/Index
//        Admin => {Author} and Update/Delete
    
        $author = $auth->createRole("author");
        $auth->add($author);
        $auth->addChild($author, $index);
        $auth->addChild($author, $view);
        $auth->addChild($author, $create);
        
        $admin = $auth->createRole("admin");
        $auth->add($admin);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $delete);
        
        $this->actionAssignRoles($author, $admin);
    }
    
    //Will be added to auth assignment table
    public function actionAssignRoles($author, $admin){
        $auth = \Yii::$app->authManager;
        
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }
    
    
    //SigningUp
//    public function actionSignup(){
//        if($this->validate()){
//            $user = new User();
//            $user->username = $this->username;
//            $user->email = $this->email;
//            $user->setPassword($this->password);
//            $user->generateAuthKey();
//            $user->save(false);
//            
//            $auth = \Yii::$ap->authManager;
//            $authorRole = $auth->getRole("author");
//            $auth->assign($authorRole, $user->getId());
//            
//            return $user;
//        }
//    }
    
    //Usage
//    public function behaviors() {
//        parent::behaviors();
//    
//        $behaviors['access'] = [
//            'class'=> \yii\filters\AccessControl::className(),
//            'rules' => [
//                [
//                    'allow'=> true,
//                    'roles' => ['@'],
//                    'matchCallback' => function($rule, $action){
//                        $module = \Yii::$app->controller->module->id;
//                        $action = \Yii::$app->controller->action->id;
//                        $controller = \Yii::$app->controller->id;
//                        $route = "$module/$controller/$action";
//                        $post = \Yii::$app->request->post();
//                        if(\Yii::$app->user->can($route)){
//                            return true;
//                        }
//                    }
//                ]
//            ]
//        ];
//                
//        return $behaviors;
//    }
}
