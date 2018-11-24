<?php

namespace App\Controller;
use Cake\Mailer\Email;
use Cake\Utility\Security;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout','forgotpassword','resetpassword']);
    }
    // public function beforeFilter(Event $event)
    // {
    //     parent::beforeFilter($event);
    //     // Allow users to register and logout.
    //     // You should not add the "login" action to allow list. Doing so would
    //     // cause problems with normal functioning of AuthComponent.
    //     $this->Auth->allow(['add', 'logout']);
    // }

     public function index()
     {
          $this->paginate = [
            'contain' => ['Articles']
        ]; 
        $users = $this->paginate($this->Users);
        // debug($articles); die();

        $this->set(compact('users'));
    }

    public function view($id)
    {
        $conditions = [];
        $this->paginate = [
            'contain' => ['Articles','Users']
        ]; 
        $user = $this->Users->get($id);
        $users = $this->Users->Articles->get($id);
        //debug($users);die();
        $Users = TableRegistry::get('Articles');
        //debug($users);die();
        $conditions = array_merge($conditions, array('Articles.user_id' => $users['id']));
        $article = $Users->find()->where($conditions)->hydrate(false)->toList();
        //debug($article);die();
        $this->set('article',$article);
        //$this->set('test',$article); view ma $test bata access
        $this->set(compact('user'));
        //compact variable name bata           
    }

    public function add()
    {
         $this->viewBuilder()->setLayout('ajax');
         
         $user = $this->Users->newEntity();
         //$image = $this->Images->newEntity();
        //Check if image has been uploaded
        
         //&& $this->Users->save($image)
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            // debug($this->request->data); die();
            if(!empty($this->request->data['img_name']['name']))
            {
                
                $file = $this->request->data['img_name']; //put the data into a var for easy use
                // debug($file); die();
                //debug($this->request->data()); die();
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                $filename = time().$file['name'];
                //only process if the extension is valid
                if(in_array($ext, $arr_ext))
                {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img' .DS. $filename);
                    //prepare the filename for database entry
                    $this->request->data['img_name'] = $filename;
                }     
            } else{
                $this->request->data['img_name'] = "default.jpg";
            }
                // $this->request->data['img_name'] = "default.jpg";
                $user = $this->Users->patchEntity($user, $this->request->getData());
                //debug($this->request->data()); die();

                if ($this->Users->save($user)) {
                    // $this->Flash->success(__('The user has been saved.'));
                    $this->Flash->success(__('Please check your mail.'));
                    
                    return $this->redirect(['action' => 'login']);
                }
                $this->Flash->error(__('Unable to add the user.'));
        }
            $this->set('user', $user);
            $Users = TableRegistry::get('Users');
                    $user_data = $this->request->data['email'];
                    //debug($user_data);die();
                        //$conditions = array_merge($conditions, array('Users.email' => $user_data));
                        $check_email = $Users->find()->where(['Users.email' => $user_data])->hydrate(false)->first();
                        debug($check_email); die();
                        //debug($check_email); die();
                        if (!empty($check_email)) {
                            $email = new Email('default');
                            $email->template('reset')
                                ->viewVars(['id' => $check_email['id']])
                                ->to($user_data)
                                ->emailformat('html')
                                ->send();
                                //echo "email found";
                        } else {
                            //return $this->redirect(['controller' => 'Users', 'action' => 'forgotpassword']);
                            $this->Flash->error(__('Invalid email, try again'));
                            return $this->redirect(['controller' => 'Users', 'action' => 'add']);
                        } 
            //$this->set(compact('image'));
            // $this->set('_serialize', ['image']);
    }
    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        // debug($id);die();
        if ($this->request->is(['post', 'put'])) {
            // Prior to 3.4.0 $this->request->data() was used.
            if(!empty($this->request->data['img_name']['name']))
            {
                $file = $this->request->data['img_name']; //put the data into a var for easy use
                // debug($file); die();
                //debug($this->request->data()); die();
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                $filename = time().$file['name'];
                //only process if the extension is valid
                if(in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img' .DS. $filename);
                    //prepare the filename for database entry
                    $this->request->data['img_name'] = $filename;
                } else{
                    $this->request->data['img_name'] = "default.jpg";
                }
                if ($user->image == "default.jpg") {
                } else {
                    $dir = WWW_ROOT . 'img' .DS. $user['img_name'];
                    unlink($dir);
                }
            } else{
                unset($this->request->data['img_name']);
            }

            $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('Your user has been updated.'));

                return $this->redirect(['controller' => 'articles' ,'action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your user.'));
        }
        $this->set('user', $user);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('ajax');
        // debug($this->request->data()); die();
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                if ($user['role'] == 'author') {
                    return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
                }
                // debug($user); die();
                                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    
    public function isAuthorized($user)
    {
        // The owner of an article can edit and delete it
        // Prior to 3.4.0 $this->request->param('action') was used.
        if (in_array($this->request->getParam('action'), ['edit','changepassword','forgotpassword'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $userId = (int)$this->request->getParam('pass.0');
            if ($this->Users->isOwnedBy($userId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function changePassword($id=null)
    {
         $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $p = $this->request->getdata();
            $password = $p['old_password'];
            $new = $p['New_password'];
            $confirm = $p['confirm_password'];

            if ((new DefaultPasswordHasher)->check($password, $user['password'])) {
                //debug($p);
                //debug($user['password']);die();
                if($new == $confirm){
                    // $this->request->data['password'] = $p['New_password'];
                    $user->password = $new;
                    $d = $this->Users->patchEntity($user, $this->request->getData());
                    //debug($user);die();
                    // debug($p);debug($this->request->data['password']);
                    if ($this->Users->save($user)) {
                    // debug($user);die();
                    $this->Flash->success(__('The user has been saved.'));
                    if ($user['role'] == 'admin') {
                        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                    }else {
                        return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
                    }
                }
                }else{
                    $this->Flash->error(__('Password didnt matched'));
                    // return $this->redirect(['controller' => 'Users', 'action' => 'index']); 
                }
                
            }else {
                die('false');
            } 
        }
            
        $this->set('changePassword', $user);
        // debug($user);die();
    }
    public function forgotPassword($id=null)
    {
        $conditions = [];
        $this->viewBuilder()->setLayout('ajax');
        $Users = TableRegistry::get('Users');
        if($this->request->is('post'))
        {
            $user_data = $this->request->data['mail'];
            if (!empty($user_data)) {
                $conditions = array_merge($conditions, array('Users.email' => $user_data));
                $check_email = $Users->find()->where($conditions)->hydrate(false)->first();
                //debug($check_email); die();
                //debug($check_email); die();
                if (!empty($check_email)) {
                    $email = new Email('default');
                    $email->template('reset')
                        ->viewVars(['id' => $check_email['id']])
                        ->to($user_data)
                        ->emailformat('html')
                        ->send();
                        //echo "email found";
                } else {
                    //return $this->redirect(['controller' => 'Users', 'action' => 'forgotpassword']);
                    $this->Flash->error(__('Invalid email, try again'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'forgotpassword']);

                }
            }
        }
    }
    public function resetPassword($id=null)
    {
         $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $p = $this->request->getdata();
            $new = $p['New_password'];
            $confirm = $p['confirm_password'];
                if($new == $confirm){
                    // $this->request->data['password'] = $p['New_password'];
                    $user->password = $new;
                    $d = $this->Users->patchEntity($user, $this->request->getData());
                    //debug($user);die();
                    // debug($p);debug($this->request->data['password']);
                    if ($this->Users->save($user)) {
                        // debug($user);die();
                        $this->Flash->success(__('The user has been saved.'));
                        
                        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                    }
                }else{
                    $this->Flash->error(__('Password didnt matched'));
                    // return $this->redirect(['controller' => 'Users', 'action' => 'index']); 
                }  
        }   
        $this->set('changePassword', $user);
        // debug($user);die();
    }
    //oold view
    // public function view($id)
    // {
    //     $user = $this->Users->get($id);
    //     $this->set(compact('user'));
    // }
}

