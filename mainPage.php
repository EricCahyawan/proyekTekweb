<?php
  require "db_connect.php"; 
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
      #navbar{
        position: fixed;
        z-index: 1;
        left: 1cm;
        right: 1cm;
      }
      body{
        margin-left: 1cm;
        margin-right: 1cm;
      }
      #modal-body{
        display: flex;
        flex-direction: row;
        flex-wrap: Wrap;
        justify-content: flex-start;
      }
      .card{
        flex: 33.33%;
      }
    </style>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">WELCOME TO POSTPULSE <?php echo ", " . $_SESSION['username'] . "(" . $_SESSION['email'] . ")";?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Action
              </a>
              <ul class="dropdown-menu">
                <li><button class="dropdown-item">&#10133; (Add Post)</button></li>
                <li><button class="dropdown-item">&#10134; (Delete Post)</button></li>
                <li><hr class="dropdown-divider"></li>
                <li><!-- Button trigger modal --><button class="dropdown-item" type="button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">&#10067; (View Profile)</button></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <!-- navbar -->
    <!-- nested nav -->
    <div class="row">
      <div class="col-4">
        <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
          <nav class="nav nav-pills flex-column">
            <a class="nav-link" href="#item-1">SPORTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ms-3 my-1" href="#item-1-1">FOOTBALL</a>
              <a class="nav-link ms-3 my-1" href="#item-1-2">BADMINTON</a>
            </nav>
            <a class="nav-link" href="#item-2">Item 2</a>
            <a class="nav-link" href="#item-3">Item 3</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ms-3 my-1" href="#item-3-1">Item 3-1</a>
              <a class="nav-link ms-3 my-1" href="#item-3-2">Item 3-2</a>
            </nav>
          </nav>
        </nav>
      </div>
      <div class="col-8">
        <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
          <div id="item-1">
            <h4>SPORTS</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero quidem excepturi, placeat iste consequatur dolorem saepe eveniet aut nam. Neque, aspernatur! Ex, cumque omnis sint esse a ad iusto eius?</p>
          </div>
          <div id="item-1-1">
            <h5>FOOTBALL</h5>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam libero fuga suscipit reprehenderit saepe nihil facilis. Similique corrupti totam explicabo nemo, inventore dolores quaerat ipsum neque placeat blanditiis dolorem reiciendis?</p>
          </div>
          <div id="item-1-2">
            <h5>BADMINTON</h5>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias cum facere unde architecto eveniet, quis maxime ipsa ex repellendus molestiae quidem asperiores non labore quam rem porro voluptates cumque quaerat.</p>
          </div>
          <div id="item-2">
            <h4>Item 2</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, saepe quis repudiandae optio, velit at qui magni in atque iure quidem perferendis labore excepturi beatae quasi illo! Tenetur, eaque dolor.</p>
          </div>
          <div id="item-3">
            <h4>Item 3</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus eaque unde minus, fugiat eos fugit impedit molestias ullam illum at voluptates totam neque sunt exercitationem porro magnam illo necessitatibus eveniet.</p>
          </div>
          <div id="item-3-1">
            <h5>Item 3-1</h5>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat obcaecati, ipsum mollitia ab sunt incidunt consectetur nulla illo eius aliquam fugit natus voluptate excepturi harum earum amet ut sapiente quidem!</p>
          </div>
          <div id="item-3-2">
            <h5>Item 3-2</h5>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore qui a ad odio inventore ipsa saepe nostrum dicta voluptate quod. Esse corrupti eos velit error quos voluptate debitis eius illum.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore qui a ad odio inventore ipsa saepe nostrum dicta voluptate quod. Esse corrupti eos velit error quos voluptate debitis eius illum.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore qui a ad odio inventore ipsa saepe nostrum dicta voluptate quod. Esse corrupti eos velit error quos voluptate debitis eius illum.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore qui a ad odio inventore ipsa saepe nostrum dicta voluptate quod. Esse corrupti eos velit error quos voluptate debitis eius illum.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore qui a ad odio inventore ipsa saepe nostrum dicta voluptate quod. Esse corrupti eos velit error quos voluptate debitis eius illum.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore qui a ad odio inventore ipsa saepe nostrum dicta voluptate quod. Esse corrupti eos velit error quos voluptate debitis eius illum.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- nested nav -->
    <!-- modal View Profile -->


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modal-body">
            <!-- card -->
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
            </div>
            <!-- card -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
    <a href="loginPage.php">
      Log out <?php session_destroy();?>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>