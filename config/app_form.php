<?php

return [
    'inputContainer' => '<div class="form-group">{{content}}</div>'
   ,'input' =>  '<input class="form-control" type="{{type}}" name="{{name}}" {{attrs}} />'
   ,'select' => '<select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select>'
   ,'inputSubmit' => '<button class="btn" type="{{type}}" {{attrs}} ></button>'
  
];
?>
