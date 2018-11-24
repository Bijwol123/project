<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;

class ArticlesController extends AppController
{
    public $paginate = [
        'limit' => 5,
        'order' => [
            'Articles.title' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['index']);
    }

   public function index()
    {
        $id = $this->Auth->user('id'); 
        $role = $this->Auth->user('role');
        if (!empty($id) && $role == "author") {
            // debug($id);die();
        $query = $this->Articles->find('all')->where(['user_id' => $id])->contain(['Categories']);
        $this->set('articles', $this->paginate($query));

        }
        else {

            $this->paginate = ['contain' => ['Users','Categories']];
             $articles = $this->paginate($this->Articles);
             $this->set(compact('articles'));
        }
    }

    public function view($id)
    {
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            // Added this line
            $article->user_id = $this->Auth->user('id');
            $article->category_id = $this->request->data['category_id'];
            // You could also do the following
            //$newData = ['user_id' => $this->Auth->user('id')];
            //$article = $this->Articles->patchEntity($article, $newData);
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // debug($this->request->data); debug($article); die();

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
        // debug($article);die();
        $category = $this->Articles->Categories->find('list', ['keyField' => 'id', 'valueField' => 'title']);

        $this->set('categories', $category);
        // Just added the categories list to be able to choose
        // one category for an article
       
    }
    public function edit($id = null)
    {

        $article = $this->Articles->get($id);
        if ($this->request->is(['post', 'put'])) {
            // Prior to 3.4.0 $this->request->data() was used.
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('article', $article);
    }
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
    public function isAuthorized($user)
    {
        // All registered users can add articles
        // Prior to 3.4.0 $this->request->param('action') was used.
        if ($this->request->getParam('action') == 'add') {
            return true;
        }
        if ($this->request->getParam('action') == 'searchform') {
            return true;
        }
        if ($this->request->getParam('action') == 'search') {
            return true;
        }
        if ($this->request->getParam('action') == 'latestArticle') {
            return true;
        }
        // The owner of an article can edit and delete it
        // Prior to 3.4.0 $this->request->param('action') was used.
        if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $articleId = (int)$this->request->getParam('pass.0');
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
    public function search()
    {
        // z
        //$id = $this->Auth->user('id');
        $conditions=[];
        if ($this->request->is('post')) {
            //$this->request->data['name'] = $_POST['name']
            $title = $this->request->data['title'];
            $id = $this->Auth->User('id');
            $role = $this->Auth->User('role');
            $category = $this->request->data['category'];
            $created = $this->request->data['created'];
            $modified = $this->request->data['modified'];
            $article = TableRegistry::get('Articles');
            //debug($this->request->data());die;
            
            if (!empty($title)) {
                $conditions = array_merge($conditions, array('Articles.title LIKE' => '%'.$title.'%'));
                //debug($query);die();
            }
            if (!empty($startdate)) {
                $conditions = array_merge($conditions, array('Articles.category_id LIKE' => '%'.$category.'%'));
                //debug($query);die();
            }
            if (!empty($created) && !empty($modified)) {
                $conditions = array_merge($conditions, array('Articles.created >=' => $created.'00:00:00','Articles.created <=' => $modified.'23:59:59'));
                //debug($query);die();
            }

            if (!empty($id) && $role == "author") {
                // debug($id);die();
                $query = $article->find()->where($conditions, array('Articles.id' => $id))->contain(['Users','Categories']);
                // $this->set('articles', $this->paginate($query));
            } else {
                $query = $article->find()->where($conditions)->contain(['Users','Categories']);
               // debug($conditions);die();
                /*$articles = $this->paginate($this->Articles);
                $this->set(compact('articles'));*/
            }
            // debug($conditions);
            //$query = $article->find()->where($conditions)->contain(['Users','Categories']);
            $this->set('articles', $query);
        }

    }
    public function searchform()
    {
        
        $category = $this->Articles->Categories->find('list');
        // debug($category);die();
        $this->set('categories', $category);
    }  
    public function latestArticle()
    {
            //debug($id);die();
            $id = $this->Auth->user('id'); 
            $query = $this->Articles->find('all')->where(['Articles.user_id !=' => $id])->order(['Articles.created' => 'DESC'])->contain(['Categories'])->limit(5);
            //->where(['Articles.id !=' => $id])
            // debug($query->toList());die();
            //debug($query->hydrate(false)->toArray());die();
            $this->set('articles', $this->paginate($query));
    }  

}