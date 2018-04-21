<?php
class ListmembersController extends AppController {

    public function redirectMembers(){
      $this->redirect('/list/members');
      $this->autoRender = false;
    }

    public function index(){
       $this->set('title_for_layout', $this->Lang->get('LISTMEMBERS__TITLE'));
       $this->loadModel('Users');
       $this->loadModel('ListMembers.Perm');
       $permGetMailEtat = $this->Perm->getListMembersByPerm('mail_perm', 'etat');
       $users = $this->Users->find('all', ['order' => 'id ASC']);
       $this->set(compact("users"));
       $this->set(compact("permGetMailEtat"));
    }

    public function profil(){
      //EXTRAIRE LE PARAMETRE ID USER
      $id = $this->request->query['id'];

      //CHARGEMENT DU MODEL USER POUR LA BDD
      $this->loadModel('User');

      //ISOLEMENT DES INFORMATIONS DE L'UTILISATEUR PORTANT L'ID USER SORTIS EN PARAMETRE + REQUETE SQL
      $conditions = array("User.id"  => array($id));
      $userFound = $this->User->find('first', array('conditions' => $conditions));

      //SORTIE DE LA VARIABLE POUR LE VIEW
      $this->set(compact("userFound"));

      //CREATION DE LA VARIABLE TITLE POUR LE TITRE DE L'ONGLET
      $this->set('title_for_layout', $this->Lang->get('LISTMEMBERS__PROFILE').' '.$userFound['User']['pseudo']);
    }

    function admin_add_perm(){
      $this->loadModel('ListMembers.Perm');
      $permMail = $this->Perm->getListMembersByPerm('mail_perm', 'perm');
      if(!isset($permMail)){
          $this->Perm->set(array(
              'perm' => 'mail_perm'
          ));
          $this->Perm->save();
      }
  }

  function admin_update_perm(){
      $this->loadModel('ListMembers.Perm');
      $this->layout = 'admin';
      $this->autoRender = false;
      if($this->isConnected && $this->User->isAdmin()){
          if($this->request->is('post')) {
              $perm_name = $this->request->data['mail_perm_name'];
              $perm_check = $this->request->data['mail_perm_check'];
              $permGetId = $this->Perm->getListMembersByPerm($perm_name, 'id');
              if($perm_check == '0'){
                  $this->Perm->read(null, $permGetId);
                  $this->Perm->set(array(
                     'etat' => '0'
                  ));
                  $this->Perm->save();
              }else{
                  $this->Perm->read(null, $permGetId);
                  $this->Perm->set(array(
                     'etat' => '1'
                  ));
                  $this->Perm->save();
              }
              if($perm_check == '0'){
                  $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('LISTMEMBERS__DISABLED_PERM_MAIL'))));
              }else{
                  $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('LISTMEMBERS__ENABLED_PERM_MAIL'))));
              }
              return;
          }

      }
          else

              throw new ForbiddenException();
  }

  function admin_index(){
      if($this->isConnected AND $this->User->isAdmin()){
          $this->set('title_for_layout', $this->Lang->get('LISTMEMBERS__ADMIN_TITLE'));
          $this->layout = 'admin';
          $this->admin_add_perm();
          $permGetMail = $this->Perm->getListMembersByPerm('mail_perm', 'etat');

          //VERIF_VERSION_INSTALL
          $plugins = $this->EyPlugin->pluginsLoaded;
          $version_install = $plugins->{'empiredev.listmembers.24'}->{'version'};

          //VERIF_VERSION_MARKET
          $version_up = null;
          $json = file_get_contents('http://api.mineweb.org/api/v2/plugin/all');
          $json = json_decode($json, true);
          foreach($json as $pl){
             if($pl['id'] == "24"){
               $version_up = $pl['version'];
             }
          }
          $isUpdateAvaible = false;
          if($version_install != $version_up){
             $isUpdateAvaible = true;
          }
          $this->set(compact('isUpdateAvaible'));
          $this->set('isActiveMail', $permGetMail);
      }
          else

              throw new ForbiddenException();
  }

}
