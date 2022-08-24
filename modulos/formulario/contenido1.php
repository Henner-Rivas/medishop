

     <style>


.conta{
  margin: auto;
  width: 900px;
  padding: 20px;
}

ul, li {
    padding: 0;
    margin: 0;
    list-style: none;
}

ul.slider{
  position: relative;
  width: 900px;
  height: 350px;
}

ul.slider li {
    position: absolute;
    left: 0px;
    top: 0px;
    opacity: 0;
    width: inherit;
    height: inherit;
    transition: opacity .5s;
    background:#fff;
}

ul.slider li img{
  width: 100%;
  height: 350px;
  object-fit: cover;
}

ul.slider li:first-child {
    opacity: 1; /*Mostramos el primer <li>*/
}

ul.slider li:target {
    opacity: 1; /*Mostramos el <li> del enlace que pulsemos*/
}

.men{
  text-align: center;
  margin: 20px;
}

.men li{
  display: inline-block;
  text-align: center;
}

.men li a{
  display: inline-block;
  color: white;
  text-decoration: none;
  background-color: grey;
  padding: 10px;
  width: 20px;
  height: 20px;
  font-size: 20px;
  border-radius: 100%;
}
     </style>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
        <h1 style="text-align: center;">BIENVENIDOS A MEDISHOP</h1>
 <div class="conta">
  
  <ul class="slider">
    <li id="slide1">
        <img src="img/foto2.jpg"/>
    </li>
    <li id="slide2">
        <img src="img/foto3.jpg"/>
    </li>
    <li id="slide3">
         <img src="img/foto1.jpg"/>

    </li>
       <li id="slide4">
         <img src="img/j.jpeg"/>

    </li>
  </ul>
  
  <ul class="men">
    <li>
      <a href="#slide1"></a>
    </li>
    <li>
      <a href="#slide2"></a>
    </li>
     <li>
      <a href="#slide3"></a>
    </li>
        <li>
      <a href="#slide4"></a>
    </li>
  </ul>
  
</div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
