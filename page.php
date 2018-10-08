<?
   $title = "Perfect Tense - Live Editor";
   $page = 'live-editor';
   include('inc/header-live-editor.php');

     //Was everything filled out on website modal form?
  if($_POST['email'] != '' || $_POST['fname'] != '' || $_POST['lname'] != '' || $_POST['company'] != '' || $_POST['message'] != '')
  {
      if(!$_POST['email'] != '' || !$_POST['fname'] != '' || !$_POST['lname'] != '' || !$_POST['company'] != '' || !$_POST['message'] != '')
      {
          $alert_type = 'danger';
          $message = 'You have left some fields empty. Please enter your name, email, subject, and message, and submit your ticket again!';
      }
      else
      { 
        //Submit Zendesk ticket
        $name = $_POST['fname']." ".$_POST['lname'];
        //Settings for ticket
        define('ZDUSER', 'alex@perfecttense.com');
        define('ZDAPIKEY', 'jJSrvhjWIpAKXYoKukny9VFxSoBTgno93n9GLGy7');
        define('ZDURL', 'https://perfecttense.zendesk.com/api/v2');
        $payload = array('ticket' => array('requester' => array('name' => $name, 'email' => $_POST['email']), 'subject' => "API Inquiry: ".$_POST['company'], 'comment' => array('body' => $_POST['message'])));
        $json = json_encode($payload);

        //Actual cURL call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($ch, CURLOPT_URL, ZDURL.'/tickets.json');
        curl_setopt($ch, CURLOPT_USERPWD, ZDUSER."/token:".ZDAPIKEY);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);

          $alert_type = 'success';
          $message = 'Thank you for your contacting us! We have received your message and we will get back to you as soon as possible.';

          unset($_POST);

      }
      $icon['danger'] = 'times-circle';
      $icon['success'] = 'thumbs-o-up';
      $message_display = '
      <div class="row">
      <div class="col-md-10 col-md-offset-1">
      <div class="alert '.$alert_type.'-icon icon" role="alert" style="background-color: white;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-lg fa-'.$icon[$alert_type].'"></i> '.$message.'
                </div><br/>';
  }

   ?>
<body id="top" class="has-header-search" data-spy="scroll" data-target="#materialize-menu" data-offset="100" style="height: 100% width:100% min-height: 100%">
   <style>
      .row-equal-height {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      }
      .row-equal-height > [class*='col-'] > [class*='flat-border-box'] {
      display: flex;
      flex-direction: column;
      min-height: 100%;
      padding-bottom: 0px;
      margin-bottom: 30px;
      }
      .row-equal-height > [class*='col-'] > [class*='border-box'] {
      display: flex;
      flex-direction: column;
      min-height: 100%;
      padding-bottom: 0px;
      margin-bottom: 30px;
      }
      .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      max-height: 100% !important;
      max-width: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.7);
      }
      .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
      }
      .website_close, .browser_close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      }
      .browser_close:hover, .website_close:hover,
      .browser.close:focus .website_close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
      }
      }
   </style>

   <section id="home" class="home-section pink-bg" style="min-height: 100vh; background-size: cover; margin: auto; background-image: url(https://preview.ibb.co/dWgZGU/5kby5k.png)">
      <img src="https://preview.ibb.co/i07UWU/pt_logo.png" href="www.perfecttense.com" style="height: 10vh; padding-left: 20px; padding-top: 15px;">
      <div class="container" style="margin-top: 3vh;">
      <div class="row text-center">
         <div class="col-md-12 headline" style="color: #1A3D42">
            <h1 style="font-weight: 900; font-size: 45px; color: white;">Intelligent Spelling and Grammar Correction, Anywhere.</h1>
         </div>
         <div class="col-md-10 col-md-offset-1 mt-30 mb-10" style="color: white; font-size: 21px;">
            <p>Perfect Tense is smarter than the average spell checker. Our algorithms understand the context and meaning of text to properly identify and fix thousands of errors.</p>
         </div>
         <div class="col-md-12 mt-30" data-toggle="modal" data-target="#video_modal" align="center">
            <div class="video_modal" style="max-width: 700px;">
               <video id="pt_video" style="border-radius: 10px; box-shadow: 2px 20px 75px 15px rgba(10, 10, 10, 0.2);" width="100%" loop muted playsinline>
                  <!--<source src="https://dl.dropboxusercontent.com/s/v2xi40vf8hrzsf6/PT%20Live%20GIF.mp4?dl=0" type="video/mp4">-->
                  <source src="https://dl.dropboxusercontent.com/s/01c3j74uyt23dcv/Live%20Gif%20V5.3%20%28final%29.mp4?dl=0" type="video/mp4">
               </video>
            </div>
         </div>
      </div>
   </div>
      <div class="col-md-10 col-md-offset-1 mb-50 mt-40" style="color: white; font-size: 25px; padding-bottom: 10px;">
         <center>
            <p style="font-size: 30px; margin-bottom: 0px;">Perfect Tense works where you are:</p>
         </center>
      </div>
      <div class="" style="padding-bottom: 10px;">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <center>
               <button id= "websiteBtn" class="featured-item flat-border-box" style="background-color: white; padding-top: 2vh; padding-bottom: 20px; border-radius: 10px; width: 100%; max-width: 400px;">
                  <div class="desc">
                     <h2 style="margin-bottom: 0px; font-size: 25px; text-align: center; color: #009FDA; font-weight: 600;">Add to your website (Free!)</h2>
                  </div>
               </button>
               </center>
            </div>
            <!--Modal-->
            <div id="websiteModal" class="modal">
               <!-- Modal content -->
               <div class="modal-content">
                  <span class="website_close">&times;</span>
                  <h2 style="padding-top: 30px; padding-left: 20px; padding-right: 20px;" align="center">Add intelligent grammar correction to your website, it’s free!</h2>
                  <center>
                     <p style="color: black; font-size: 16px; padding-top: 10px;">Integrating Perfect Tense is as simple as adding a line of code to your website. <br>Improve overall site quality and help all your users correct their grammar!</p>
                        <div id="inquiry">
      <? echo $message_display; ?>
   </div>
                  </center>

          <div class="row">
              <div class="col-md-12" style="padding-left: 30px; padding-right: 30px;">
                  <form id="form1" method="post" action="">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-field">
                          <input type="text" name="fname" class="validate" id="fname" value="<? echo strip_tags($_POST['fname']); ?>">
                          <label for="name" class="">First Name</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-field">
                          <input type="text" name="lname" class="validate" id="lname" value="<? echo strip_tags($_POST['lname']); ?>">
                          <label for="name" class="">Last Name</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                      <div class="input-field">
                          <label class="sr-only" for="email">Email</label>
                          <input id="email" type="email" name="email" class="validate" value="<? echo strip_tags($_POST['email']); ?>">
                          <label for="email" data-error="wrong" data-success="right" class="">Email</label>
                        </div>

                      </div><!-- /.col-md-6 -->
                    <div class="col-md-6">
                      <div class="input-field">
                          <input type="text" name="company" class="validate" id="company" value="<? echo strip_tags($_POST['company']); ?>">
                          <label for="name" class="">Website</label>
                        </div>
                      </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->

                    <div class="row">
                      <!-- /.col-md-6 -->
                  </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="input-field">
                          <textarea name="message" id="message" class="materialize-textarea" style="z-index: auto; position: relative; line-height: 29px; font-size: 14px; transition: none; background: transparent !important; height: 29px;"><? echo strip_tags($_POST['message']); ?></textarea>
                          <label for="message" class="">How would you like to use Perfect Tense?</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="col-lg-2">
                    <button type="submit" name="submit" class="waves-effect waves-light btn submit-button pink mt-10">Submit</button>
                 </div>

                    <div class="col-md-10" style="margin-top: 5px;">
                        <p>This feature is in beta and we want to make sure your integration is flawless. <br>Please submit this form so we can help you get started. </p>
                    </div>
                    </div>
                  </form>

              </div><!-- /.col-md-8 -->
          </div><!-- /.row -->
                     <!-- /.col-md-8 -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Scripts -->
   <script>
      var website_modal = document.getElementById('websiteModal');
      var website_btn = document.getElementById("websiteBtn");
      var website_span = document.getElementsByClassName("website_close")[0];
      website_btn.onclick = function() {
          website_modal.style.display = "block";
      }
      website_span.onclick = function() {
          website_modal.style.display = "none";
      }

   </script>
   <script type="text/javascript">
      setTimeout(function() {
          document.getElementById("pt_video").play();
      }, 3000);
   </script>
   <script>
      var parsed_qs = '';
      var banner = '';
      if (parsed_qs) {
          var myDate = new Date();
          myDate.setDate(myDate.getDate() + 90);
          document.cookie = "ref=" + parsed_qs + ";expires=" + myDate + ";domain=.perfecttense.com;path=/";
          if (banner) {
              document.cookie = "banner=" + banner + ";expires=" + myDate + ";domain=.perfecttense.com;path=/";
          }
          record_click(parsed_qs, banner);
      }

      function record_click(ref, banner) {
          const payload = {
              ref: ref,
              banner: banner
          };
          axios.post('https://backend.perfecttense.com/aff_click', payload)
              .then(res => {
                  console.log('record aff click');
              })
              .catch(res => {
                  console.log('error record click');
              });
      }
   </script>
   <!-- Preloader -->
   <div id="preloader">
      <div class="preloader-position">
         <img src="https://www.perfecttense.com/assets/img/logo.png" style="height:100px;" alt="logo">
         <div class="progress">
            <div class="indeterminate"></div>
         </div>
      </div>
   </div>
   <!-- End Preloader -->
   <!-- jQuery -->
   <script src="https://www.perfecttense.com/assets/js/jquery-2.1.3.min.js"></script>
   <script src="https://www.perfecttense.com/assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="https://www.perfecttense.com/assets/materialize/js/materialize.min.js"></script>
   <script src="https://www.perfecttense.com/assets/js/jquery.easing.min.js"></script>
   <!--<script src="https://www.perfecttense.com/assets/js/smoothscroll.min.js"></script>-->
   <script src="https://www.perfecttense.com/assets/js/menuzord.js"></script>
   <script src="https://www.perfecttense.com/assets/js/bootstrap-tabcollapse.min.js"></script>
   <script src="https://www.perfecttense.com/assets/js/jquery.inview.min.js"></script>
   <script src="https://www.perfecttense.com/assets/js/jquery.countTo.min.js"></script>
   <script src="https://www.perfecttense.com/assets/js/imagesloaded.js"></script>
   <script src="https://www.perfecttense.com/assets/js/jquery.shuffle.min.js"></script>
   <script src="https://www.perfecttense.com/assets/js/jquery.stellar.min.js"></script>
   <script src="https://www.perfecttense.com/assets/magnific-popup/jquery.magnific-popup.min.js"></script>
   <script src="https://www.perfecttense.com/assets/owl.carousel/owl.carousel.min.js"></script>
   <script src="https://www.perfecttense.com/assets/js/scripts.js"></script>
</body>
</html>
