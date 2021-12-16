<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Sign In</title>
    <style>
      #loader {
        transition: all .3s ease-in-out;
        opacity: 1;
        visibility: visible;
        position: fixed;
        height: 100vh;
        width: 100%;
        background: #fff;
        z-index: 90000
      }

      #loader.fadeOut {
        opacity: 0;
        visibility: hidden
      }

      .spinner {
        width: 40px;
        height: 40px;
        position: absolute;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
        background-color: #333;
        border-radius: 100%;
        -webkit-animation: sk-scaleout 1s infinite ease-in-out;
        animation: sk-scaleout 1s infinite ease-in-out
      }

      @-webkit-keyframes sk-scaleout {
        0% {
          -webkit-transform: scale(0)
        }

        100% {
          -webkit-transform: scale(1);
          opacity: 0
        }
      }

      @keyframes sk-scaleout {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0)
        }

        100% {
          -webkit-transform: scale(1);
          transform: scale(1);
          opacity: 0
        }
      }
    </style>
    <script defer="defer" src="<?php echo base_url("template/admin/dist/main.js")?>"></script>
  </head>
  <body class="app">
    <div id="loader">
      <div class="spinner"></div>
    </div>
    <script>
      window.addEventListener("load", (function() {
        const t = document.getElementById("loader");
        setTimeout((function() {
          t.classList.add("fadeOut")
        }), 300)
      }))
    </script>
    <div class="peers ai-s fxw-nw h-100vh">
      <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image:url("<?php echo base_url("template/admin/dist/assets/static/images/bg.jpg")?>")'>
        <div class="pos-a centerXY">
          <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="<?php echo base_url("template/admin/dist/assets/static/images/logo.png")?>" alt=""></div>
        </div>
      </div>
      <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
        <h1 class="fw-300 c-grey-900 mB-40">Login</h1>
        <?php if (!empty($this->session->flashdata('failed'))){ ?>
        <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('failed'); ?></div>
        <?php }?>
        <form method="post">
            <div class="mb-3">
              <label class="text-normal text-dark form-label">username</label><input type="text" class="form-control" name="username" placeholder="username" value="<?php echo !empty(set_value('username')) ? set_value('username') : ''?>"">
              <span class="alert-danger"><?php echo form_error('username'); ?></span>
            </div>
            <div class="mb-3">
                <label class="text-normal text-dark form-label">Password</label><input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo !empty(set_value('password')) ? set_value('password') : ''?>"">
                 <span class="alert-danger"><?php echo form_error('password'); ?></span>
            </div>
          <div class="">
            <div class="peers ai-c jc-sb fxw-nw">
              <div class="peer">
                
              </div>
              <div class="peer"><button class="btn btn-primary btn-color">Login</button></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>