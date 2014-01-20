                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  <!--========TIMELINE=====---->
                  <?php getFeeds();?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">Timeline</div>
                               <div class="panel-body">
                                <div id="isvipi-timeline">
                         <form id="tweetForm" action="<?php echo ISVIPI_USER_INC_URL. 'users.process.php'?>" method="post">
                         <input type="hidden" value="<?php echo $username; ?>" name="user" />
                         <input type="hidden" value="feed" name="op" />
                         <span class="counter">500</span>
                         <label for="inputField">What are you doing?</label>
                         <textarea name="myfeed" class="form-control" id="inputField" tabindex="1"rows="2" cols="40"></textarea>
                                  <input type="submit" class="btn btn-primary" value"Update"/>
                                 <div class="clear"></div>
                                 </form>
                                  </div>
                                <h4>Activity Feed</h4>
                                <hr />
                                <div class="scrollable">
								<?php while ($getusr->fetch()) {?>
                                <?php 	
								$xid = $act_user;
								xtractUID($xid)
								?>
                                                                    
                                    <div class='timeline_pic'>
                                    <?php t_thumb($uid);?>
                                    <?php if(htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8') == ""){$t_thumb="no-image.gif";}?>
                                    <a href="profile.php?id=<?php echo htmlspecialchars($uid, ENT_QUOTES, 'utf-8');?>"><img src='<?php echo ISVIPI_MEMBER_URL.'pics/'.htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8');?>' height='60' width='60' alt='' /></a>
                                    </div>
                                    <div class='timeline_posts'>
                                    <li>
                                    <a href='profile.php?id=<?php echo htmlspecialchars($uid, ENT_QUOTES, 'utf-8');?>'><?php echo htmlspecialchars($act_user, ENT_QUOTES, 'utf-8');?></a><br/>
                                    <?php echo $activity;?><br/>
                                    <span class='time_stamp'><?php echo relativeTime($time)?></span> <br/>
                                    </li>
                                    </div>
                                    <?php } ?>
								</div>
                               </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                  <!--========/TIMELINE=====---->
                  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
                             <script type="text/javascript">
							 $(document).ready(function(){
	                         $('#inputField').bind("blur focus keydown keypress keyup", function(){recount();});
	                         $('#tweetForm').submit(function(e){
		                     tweet();
		                   e.preventDefault();
	                     });
                      });
                 function recount()
                  {
	               var maxlen=500;
	               var current = maxlen-$('#inputField').val().length;
	               $('.counter').html(current);
	               if(current<0 || current==maxlen)
	               {
		            $('.counter').css('color','#D40D12');
		            $('input.submitButton').attr('disabled','disabled').addClass('inact');
	               }
	             else
		           $('input.submitButton').removeAttr('disabled').removeClass('inact');
	               if(current<20)
		           $('.counter').css('color','#D40D12');
	               else if(current<50)
		           $('.counter').css('color','#5C0002');
	             else
		           $('.counter').css('color','#cccccc');
                 }
              </script>
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
