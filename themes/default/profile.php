                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  
                  <!--========PROFILE=====---->
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">My Profile</div>
                               <div class="panel-body">
                                 <div class="my_pic">
                                 <?php if(htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8') == ""){$m_thumbnail="no-image.gif";}?>
                                 <img src="<?php echo ISVIPI_MEMBER_URL.'pics/'.htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8');?>" height="100%" width="100%" alt="" />
                                 </div>
                                 <div class="my_details">
                                  <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                        <td>Profile Name</td>
                                        <td><?php echo htmlspecialchars($m_name, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <tr>
                                        <td>Gender</td>
                                        <td><?php echo htmlspecialchars($m_gender, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <tr>
                                        <td>Age</td>
                                        <td><?php echo htmlspecialchars($m_age, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <tr>
                                        <td>Location</td>
                                        <td><?php echo htmlspecialchars($m_city, ENT_QUOTES, 'utf-8');?>, <?php echo htmlspecialchars($m_country, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                 </div>
                                 <div class="profile_edit">
                                 <?php if($id==$user) {?>
                                    <?php if ($m_thumbnail !="no-image.gif"){?>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#profilePic">Change Profile Pic</button>
                                    <?php } else {?>
                                 <button class="btn btn-primary" data-toggle="modal" data-target="#profilePic">Upload Profile Pic</button>							<?php }?>
                                 <a href="edit_profile.php" class="btn btn-info" role="button">Edit my Profile</a>
                                 
                                 <?php } else{?>
                                <button class="btn btn-info" data-toggle="modal" data-target="#sendPM">
  									Send Message
								</button>
                                <?php if(checkFriendship($id,$user)){?>
                                <a href="#" id="focus"><button type="submit" class="btn btn-danger">Remove Friend</button></a>
                                <?php }?>
                                 <a href="<?php $from_url = $_SERVER['HTTP_REFERER']; echo $from_url;?>" class="btn btn-default pull-right" role="button">Back</a>
                                 <?php }?>
                                 </div>
                               </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                  <!--========/PROFILE=====---->
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========ALERT=====---->
					<script>
                            function reset () {
                                $("#toggleCSS").attr("href", "../themes/alertify.default.css");
                                alertify.set({
                                    labels : {
                                        ok     : "Yes",
                                        cancel : "No"
                                    },
                                    delay : 5000,
                                    buttonReverse : false,
                                    buttonFocus   : "ok"
                                });
                            }
                            $("#focus").on( 'click', function () {
                                reset();
                                alertify.set({ buttonFocus: "cancel" });
                                alertify.confirm("Are you sure you want to unfriend <span><?php echo $m_name ?></span>?", function (e) {
                                    if (e) {
                                        window.location = "../lib/users.inc/users.frequests.php?action=4&id=<?php echo $id;?>";
                                    } else {
                                        alertify.error("Cancelled");
                                    }
                                });
                                return false;
                            });
                    </script>

                  <!--========/ALERT=====---->
                 
                 <!--=========SEND PM MODAL===========--->
                <!-- Modal -->
                <div class="modal fade" id="sendPM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">To: <span class="green"><?php echo htmlspecialchars($m_name, ENT_QUOTES, 'utf-8');?></span></h4>
                      </div>
                      <div class="modal-body">
                              <form method="post" action="<?php echo ISVIPI_USER_INC_URL. 'users.pm.process.php'?>">
                                <input type="hidden" name="msg" value="0">
                              <div class="form-group">
                                <input class="form-control" type="hidden" name="recip" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'utf-8');?>" placeholder="Recipient" onclick="this.value='';" required="required">
                              </div>
                              <div class="form-group">
                                <textarea id="message" name="message" required="required"><?php if(isset($_POST['message'])){echo $_POST['message'];}?></textarea>
                              </div>
                                

                      </div>
                      <div class="modal-footer">
                      <button class="btn btn-lg btn-primary" type="submit">Send Message</button>
                       </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->       
                
                                 <!--=========PROFILE PIC MODAL===========--->
                 <!-- Modal -->
                <div class="modal fade" id="profilePic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Profile Pic</h4>
                      </div>
                      <div class="modal-body">
                       <form action="<?php echo ISVIPI_USER_INC_URL. 'users.profilepic.php'?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="op" value="newpic">
                        <input type="hidden" name="userid" value="<?php echo $user?>">
                        <label for="file">Filename:</label>
                        <input type="file" class="form-control" name="file"><br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit"/>Upload</button>
                        </form>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
         