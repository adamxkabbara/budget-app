<?php

  Interface Controller {

    function get($id); 
    function create($obj);
    function delete();
    function update();
    function delete_all();
    
  }