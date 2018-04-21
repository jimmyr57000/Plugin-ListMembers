<?php

Router::connect('/list/members/', array('controller' => 'listmembers', 'action' => 'index', 'plugin' => 'ListMembers'));

Router::connect('/list/members', array('controller' => 'listmembers', 'action' => 'index', 'plugin' => 'ListMembers'));

Router::connect('/list/profil/', array('controller' => 'listmembers', 'action' => 'profil', 'plugin' => 'ListMembers'));

Router::connect('/list/profil', array('controller' => 'listmembers', 'action' => 'profil', 'plugin' => 'ListMembers'));

Router::connect('/list/', array('controller' => 'listmembers', 'plugin' => 'ListMembers'));

Router::connect('/list', array('controller' => 'listmembers', 'plugin' => 'ListMembers'));

Router::connect('/admin/list', array('controller' => 'listmembers', 'action' => 'index', 'plugin' => 'ListMembers', 'admin' => true));
Router::connect('/admin/list/update_perm', array('controller' => 'Listmembers', 'action' => 'update_perm', 'plugin' => 'ListMembers', 'admin' => true));