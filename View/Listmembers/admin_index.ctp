<?php App::import('Controller', 'ListmController'); ?>
<?= $this->Html->css('ListMembers.bootstrap-switch.css'); ?>
<?= $this->Html->css('ListMembers.plugin.css'); ?>
<section class="content">
    <div class="col-md-12">
        <?php if($isUpdateAvaible){ ?>
          <div class="alert alert-warning">
            <div class="row">
              <div class="col-sm-1 col-icon-maj">
                <i class="fa fa-refresh fa-maj"></i>
              </div>
              <div class="col-sm-10 col-text-maj">
                <span class="title-info-maj">INFORMATION</span><br />
                Une mise à jour du plugin "Liste des membres" est disponible ! <br /> Pensez à la télécharger ;) <br />
                <hr>
                <button data-toggle="tooltip" title="Vous allez être rédirigé vers la page de gestion des plugins" class="btn btn-warning btn-maj">Mettre à jour</button>
              </div>
            </div>
          </div>
        <?php }?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $Lang->get("LISTMEMBERS__ADMIN_TITLE"); ?> | <?= $Lang->get("LISTMEMBERS__TITLE"); ?></h3>
            </div>
            <div class="box-body">
                <div id="msg_perm_change"></div>
                <form id="mail_perm_form" class="form-horizontal" method="POST" data-ajax="true" action="<?= $this->Html->url(array('controller' => 'Listmembers', 'action' => 'update_perm')) ?>" data-redirect-url="?">
                    <div id="error_msg"></div>
                    <div class="ajax-msg"></div>
                    <div style="margin-left: 0px;" class="form-group">
                        <label><h4><?= $Lang->get('LISTMEMBERS__DESC_PERM_MAIL'); ?></h4></label><br />
                        <input type="hidden" id="mail_perm_name" value="mail_perm" name="mail_perm_name">
                        <input type="checkbox" id="mail_perm_check" <?php if($isActiveMail == 1){ ?>checked<?php }?> name="mail_perm_check">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<?= $this->Html->script('ListMembers.bootstrap-switch.js'); ?>
<script>
$('.btn-maj').click(function (){
  $(location).attr('href', '<?= $this->Html->url(array('controller' => 'plugin','plugin' => false, 'admin' => true, 'action' => 'update', '24', 'ListMembers')); ?>');
});
$.fn.bootstrapSwitch.defaults.onText = '<?= $Lang->get("LISTMEMBERS__ENABLED_TXT"); ?>';
$.fn.bootstrapSwitch.defaults.offText = '<?= $Lang->get("LISTMEMBERS__DISABLED_TXT"); ?>';
$("[type='checkbox']").bootstrapSwitch();
$('input[type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
    if(this.id == 'mail_perm_check'){
        $("#mail_perm_check").bootstrapSwitch('disabled',true);
        $('#mail_perm_form').submit();
        $("#mail_perm_check").bootstrapSwitch('disabled',false);
    }
});
$('[data-toggle="tooltip"]').tooltip();
</script>
