<?php

  Interface Controller {

    function get($id); 
    function create($obj);
    function delete();
    function update($obj, $uid);
    function delete_all();
    
  }