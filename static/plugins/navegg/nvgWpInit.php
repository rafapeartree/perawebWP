<div class="wrap">
  <div id="icon-navegg" class="icon32"><br>
  </div>

  <h2>Navegg Analytics</h2>

  <div id="dashboard-widgets-wrap">
    <div id="dashboard-widgets" class="metabox-holder">
	

<div style="width:49%; float: left;">

      <div class="postbox-container" style="width:99%;">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox ">

            <h3><span><?php echo getTextNvg('nvgMsgAdmInitAbout_1'); ?></span></h3>

            <div class="inside">
		
		<img src="<?php echo plugins_url( 'contents/navegg-analytics.png', __FILE__ ); ?>" style="width: 300px; height: 50px; margin: 0 auto 20px auto;" />

            	<h4><strong><?php echo getTextNvg('nvgMsgAdmInitAbout_2'); ?></strong></h4><br />
				
				
               	<p><?php echo getTextNvg('nvgMsgAdmInitAbout_3'); ?></p>
				
            	<p><strong><?php echo getTextNvg('nvgMsgAdmInitAbout_4'); ?></strong> <?php echo getTextNvg('nvgMsgAdmInitAbout_5'); ?></p>
				
            	<p><strong><?php echo getTextNvg('nvgMsgAdmInitAbout_6'); ?></strong> <?php echo getTextNvg('nvgMsgAdmInitAbout_7'); ?></p>
				
		<p><strong><?php echo getTextNvg('nvgMsgAdmInitAbout_8'); ?></strong> <?php echo getTextNvg('nvgMsgAdmInitAbout_9'); ?></p>
				
	      <ul class="nvg_lst">
              
	      <li class="tlt"><?php echo getTextNvg('nvgMsgAdmInitAbout_10'); ?></li>
              
	      <li class="d">
	       	  <a href="<?php echo getTextNvg('nvgMsgAdmInitAbout_11_link'); ?>" target="_blank">
 	             <?php echo getTextNvg('nvgMsgAdmInitAbout_11'); ?>
	          </a>
	       </li>
              
	      <li class="s">
	           <a href="<?php echo getTextNvg('nvgMsgAdmInitAbout_12_link'); ?>" target="_blank">
		      <?php echo getTextNvg('nvgMsgAdmInitAbout_12'); ?>
		   </a>
	       </li>
              
	      <?php if(getTextNvg('nvgMsgAdmInitAbout_13') != '!empy'){ ?>
	      <li class="b">
	          <a href="<?php echo getTextNvg('nvgMsgAdmInitAbout_13_link'); ?>" target="_blank">
		     <?php echo getTextNvg('nvgMsgAdmInitAbout_13'); ?>
		  </a>
		</li>
	       <?php } ?>

		<li class="f">
		   <a href="<?php echo getTextNvg('nvgMsgAdmInitAbout_14_link'); ?>" target="_blank">
		      <?php echo getTextNvg('nvgMsgAdmInitAbout_14'); ?>
		   </a>
		</li>

               <li class="p">
	          <a href="<?php echo getTextNvg('nvgMsgAdmInitAbout_15_link'); ?>" target="_blank">
	             <?php echo getTextNvg('nvgMsgAdmInitAbout_15'); ?>
	           </a>
	       </li>
              
	      <li class="c">
	          <a href="<?php echo getTextNvg('nvgMsgAdmInitAbout_16_link'); ?>" target="_blank">
		     <?php echo getTextNvg('nvgMsgAdmInitAbout_16'); ?>
		  </a>
	      </li>
              </ul>
               <div class="clearme"></div>
            </div>
          </div>
        </div>
      </div>
	<p style="font-size:11px; margin-left:10px; margin-top:0;">
		<a href="" onclick="lng_ptbr();">Português </a>|<a href="" onclick="lng_es();">Español </a>|<a href="" onclick="lng_en();">English</a>
	</p>
	
	<div class="clearme"></div>
</div>
<div style="width:49%; float: left;">


      <div class="postbox-container" style="width:99%;">
        <div class="meta-box-sortables ui-sortable">
          <div class="postbox id_nvg" style="max-height: 315px;">
           <h3>
	   	<span><?php echo getTextNvg('nvgMsgAdmInitYourId'); ?></span>
	   	<div class="<?php  echo NvgWp::getIdNvg() != ''?'on':'off'; ?>">
	   	   <span></span>
		   <?php  echo NvgWp::getIdNvg() != '' ? getTextNvg('nvgMsgAdmInitYourId_1') : getTextNvg('nvgMsgAdmInitYourId_2') ; ?>
	        </div>
	   </h3>
           
	   <div class="inside">
		
		<p><?php echo getTextNvg('nvgMsgAdmInitYourId_3'); ?> <strong>ID</strong> <?php echo getTextNvg('nvgMsgAdmInitYourId_4'); ?> </p>
		
		<?php /* <p>Verifique sua conta do Navegg Analytics:</p> */ ?>


		<?php 
			//getInfo User
			global 	$current_user; 
			get_currentuserinfo();
		 ?>

		<?php /* <label for="idNvg" style="display: block; float: left; width: 70px; margin-right: 8px; padding-top: 7px; text-align: right;">ID Navegg:</label>*/ ?>
		<form method="post" action="" onSubmit ="return validaFormId()" > 
			<?php
				if( isset( $_POST['idNvg']) )
					$nvgId = str_replace(" ","",$_POST['idNvg']);
				else{
					$nvgId = NvgWp::getIdNvg() != '' ? NvgWp::getIdNvg() : getTextNvg('nvgMsgAdmInitYourId_5');
				}
					
			?>
			<input type="text" name="idNvg" id="idNvg" style="width: 130px;" value="<?php echo $nvgId; ?>" onblur="if (this.value == '') {this.value = '<?php echo getTextNvg('nvgMsgAdmInitYourId_5');?>'}" onfocus="if (this.value == '<?php echo getTextNvg('nvgMsgAdmInitYourId_5');?>') {this.value = '';}"/>

			<button class="button" title="<?php echo getTextNvg('nvgMsgAdmInitYourId_7'); ?>" style="text-transform: uppercase;"><?php echo getTextNvg('nvgMsgAdmInitYourId_6'); ?></button>

	        	<?php if( isset( $_POST['idNvg']) ||  $msgPost['class'] == 'updtSucess'){ ?>
		        	<p class="<?php echo $msgPost['class']; ?>"><?php echo $msgPost['msg'];?></p>
			<?php } ?>					
		</form>



			
<?php
	//verifição para saber se precisa opcao de criar conta ou buscar id
	 if( (!isset($msgPost['class']) &&  NvgWp::getIdNvg() == '')  || (isset($msgPost['class']) && $msgPost['class'] != 'updtSucess') ){ 
?>

		<form method="post" action="" onSubmit ="return validaFormSearch()" <?php echo $msgPost['class'] == 'updtSucess' ? 'styledisplay:none' : ''; ?> > 

			<p><?php echo getTextNvg('nvgMsgAdmInitYourId_11'); ?></p>

			<input type="text" name="emNvg" id="emNvg" value="<?php echo isset($_POST['emNvg']) ? $_POST['emNvg'] : '';?>" style="float: left; width: 200px; padding-left: 6px !important; background-image: none; font-size: 13px;" />
			<button class="button" style="float: left; margin-top: -1px; text-transform: uppercase;" title="<?php echo getTextNvg('nvgMsgAdmInitYourId_12'); ?>" >
				<?php echo getTextNvg('nvgMsgAdmInitYourId_12'); ?>
			</button>
		
                        <?php if( isset( $_POST['emNvg']) ){ ?>
                                <p style="clear:both;" class="<?php echo $msgPost['class']; ?>"><?php echo $msgPost['msg'];?></p>
				<br/>
                        <?php } ?>


			<ul class="nvg_lst" style="clear: both;">
				<?php 
					/* <li class="h">
				   		<a href="<?php echo getTextNvg('nvgMsgAdmInitYourId_8_link'); ?>"  target="_blank">
					     		<?php echo getTextNvg('nvgMsgAdmInitYourId_8'); ?>
				   		</a>
			        	</li> */ 
				?>

				<li class="r">
					<a href="javascript:void(0)" onClick="document.getElementById('containerNewAccount').style.display = 'block'" >
						<?php echo getTextNvg('nvgMsgAdmInitYourId_9'); ?> 
						<span><?php echo getTextNvg('nvgMsgAdmInitYourId_10'); ?></span>
					</a>
				</li>
			</ul>	

		</form>   

	<?php } ?>


		<div class="clearme"></div>

            </div>
          </div>
        </div>
      </div>
	 
 
<?php   
  if( (!isset($msgPost['class']) &&  NvgWp::getIdNvg() == '')  || (isset($msgPost['class']) && $msgPost['class'] != 'updtSucess') ){ 
	$inName 	= isset($_POST['nmNvg']) ? $_POST['nmNvg'] : ($current_user->user_nicename == 'admin' ? '' : $current_user->user_nicename);
	$inEmail 	= isset($_POST['nemNvg']) ? $_POST['nemNvg'] : $current_user->user_email;
	$inSite		= isset($_POST['stNvg']) ? $_POST['stNvg'] : get_bloginfo('name');
	$inUrl		= isset($_POST['urNvg']) ? $_POST['urNvg'] : get_bloginfo('url');
?>   	  
      <div id="containerNewAccount" class="postbox-container" <?php echo !isset($_POST['newNvg']) ? 'style="width:99%; display:none;"' : ''; ?>>
        <div class="meta-box-sortables ui-sortable">
          <div class="postbox cnt_nvg" style="max-height: 315px;">
           	<h3><span><?php echo getTextNvg('nvgMsgAdmInitAccount_1'); ?></span></h3>
	   	<div class="inside">
		   <form method="post" action="" onSubmit ="return validaFormNew()" <?php echo $msgPost['class'] == 'updtSucess' ? 'styledisplay:none' : ''; ?> > 
			<input type="hidden" name="newNvg" value="true"/>	
			<p><?php echo getTextNvg('nvgMsgAdmInitAccount_2'); ?></p>

			<label for="nmNvg" style="display: block; float: left; width: 80px; margin-right: 8px; padding-top: 7px; text-align: right;">
				<?php echo '* '.getTextNvg('nvgMsgAdmInitAccount_3'); ?>
			</label>
			<input type="text" name="nmNvg" id="nmNvg" value="<?php echo $inName; ?>" style="width: 200px; padding-left: 6px !important; background-image: none; font-size: 13px;" /><br />
					
			<label for="nemNvg" style="display: block; float: left; width: 80px; margin-right: 8px; padding-top: 7px; text-align: right;">
				<?php echo '* '.getTextNvg('nvgMsgAdmInitAccount_4'); ?>
			</label>
			<input type="text" name="nemNvg" id="nemNvg" value="<?php echo $inEmail; ?>" style="width: 200px; padding-left: 6px !important; background-image: none; font-size: 13px;" /><br />
					
			<label for="stNvg" style="display: block; float: left; width: 80px; margin-right: 8px; padding-top: 0px; text-align: right;">
				<?php echo getTextNvg('nvgMsgAdmInitAccount_5'); ?>
			</label>
			<input type="text" name="stNvg" id="stNvg" value="<?php echo $inSite; ?>" style="width: 200px; padding-left: 6px !important; background-image: none; font-size: 13px;" /><br />
			
			<label for="urNvg" style="display: block; float: left; width: 80px; margin-right: 8px; padding-top: 0px; text-align: right;">
				<?php echo getTextNvg('nvgMsgAdmInitAccount_6'); ?>
			</label>

			<input type="text" name="urNvg" id="urNvg" value="<?php echo $inUrl ?>" style="float: left; width: 200px; padding-left: 6px !important; background-image: none; font-size: 13px;" />

			<button class="button" style="float: left; margin-top: 4px; text-transform: uppercase;" title="<?php echo getTextNvg('nvgMsgAdmInitAccount_1'); ?>" >
				<?php echo getTextNvg('nvgMsgAdmInitAccount_7'); ?>
			</button><br/><br/>					

			<?php if( isset( $_POST['newNvg']) ){ ?>
				<p style="clear:both;" class="<?php echo $msgPost['class']; ?>"><?php echo $msgPost['msg'];?></p> <br/>
			<?php } ?>

		   </form>
	        </div>
          </div>
        </div>
      </div>
<?php } ?>	  


  
	  
      <div class="postbox-container" style="width:99%;">
        <div class="meta-box-sortables ui-sortable">
          <div class="postbox pn_nvg" style="max-height: 315px;">
           <h3><span><?php echo getTextNvg('nvgMsgAdmInitPainel_3'); ?></span></h3>
	   		<div class="inside">
				<p>
					<?php
						$pnUrl = getTextNvg('nvgMsgAdmInitPainel_1_link');
						if(NvgWp::getAutoInNvg() != '')
							$pnUrl = 'http://panel.navegg.com/account/loginPartner.php?loginkey='.NvgWp::getAutoInNvg();
					?>
					<a href="<?php echo $pnUrl; ?>" target="_blank">
						<?php echo getTextNvg('nvgMsgAdmInitPainel_1'); ?>
					</a> 
					<?php echo getTextNvg('nvgMsgAdmInitPainel_2'); ?>
				</p>
	        </div>
          </div>
        </div>
      </div>

<div class="clearme"></div>
</div>

   <div class="clear"></div>

  </div>
  
</div>
<script type="text/javascript">

function validaFormId(){

  if(document.getElementById('idNvg').value == '' ||  document.getElementById('idNvg').value == '<?php echo getTextNvg('nvgMsgAdmInitYourId_5');?>'){
	alert("<?php echo getTextNvg('nvgMsgAdmInitYourIdAlert_1'); ?>");
	return false;
  }
   return true;
}

function validaFormNew(){

	if(document.getElementById('nmNvg').value == '' ){
        	alert("<?php echo getTextNvg('nvgMsgAdmInitError_3');?>");
		document.getElementById('nmNvg').focus();		
        	return false;
	}		

	if(!validaEmail('nemNvg'))
		return false;

	return true;
}
function validaFormSearch(){
   return validaEmail('emNvg');
}

function validaEmail(id){
  if(document.getElementById(id).value == '' ){
        alert("<?php echo getTextNvg('nvgMsgAdmInitError_4');?>");
	document.getElementById(id).focus();		
        return false;
  }else
        if(!checkMail(document.getElementById(id).value)){
                alert("<?php echo getTextNvg('nvgMsgAdmInitError_5');?>");
		document.getElementById(id).focus();		
                return false;
        }
        
   return true;
}
function checkMail(mail){
	var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
	if(typeof(mail) == "string")
		if(er.test(mail)) return true; 
	else if(typeof(mail) == "object"){
		if(er.test(mail.value))	return true;
	}else	return false;
}

var color = "#2d94d0";

function BlinkIt () {
    if (document.getElementById('idNvg').value == '<?php echo getTextNvg('nvgMsgAdmInitYourId_5');?>'){
      var blink = document.getElementById ('idNvg');
      color = (color == "#CCC")? "#333" : "#CCC";
      blink.style.color = color;
    }else{ document.getElementById('idNvg').style.color = "#333";}
}

window.setInterval(BlinkIt, 700);


function lng_ptbr(){
	document.cookie = 'idioma_nvg=br';
}
function lng_en(){
	document.cookie = 'idioma_nvg=en';
}
function lng_es(){
	document.cookie = 'idioma_nvg=es';
}
</script>

