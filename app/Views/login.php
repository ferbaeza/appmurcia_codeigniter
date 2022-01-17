<div class="main_login">
  <div class="logo">
</div>
  <form id="formLogin" method="POST">
    <h1 id="signin">Please sign in</h1>
    <div class="mb-3">
      <input name="mail" placeholder="Email adress" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
      <input name="passwd" placeholder="Password" type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary" id="subLogin">Submit</button>
  </form>
</div><br>




<div class="toast" style=" height: 3em; position: absolute; margin-top: 2em; text-align: right;">
  <div class="toast align-items-center text-white bg-primary border-0" id="bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
          <div class="toast-body" id="toast">
          
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
  </div>
    </div>
<div class="backhome">
  <p id="log_p"><i class='fas fa-copyright'></i>2021_<?= date('Y') ?> Murcia Turismo Project <i class='fas fa-registered'></i></p>
</div>
