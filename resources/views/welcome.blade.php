<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Categories & Sub categories </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <!--  CSS -->
        <link href="/css/app.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .content {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a  class="nav-item nav-link"href="#">Add to category</a>
        <a  class="nav-item nav-link"href="#" >add sub category</a>
        <a class="nav-item nav-link"href="#">Edit / Delete</a>
        <!-- <a class="nav-item nav-link" href="#">Navbar</a> -->
      
    </nav>         
       <div class="flex-center ">
        

            <div class="content">
              
                    {!!Form::open(array('url' => 'done','method' => 'get')) !!}

                        <label>New category :</label>
                        {!! Form::text('new','',array('id'=>'newCategory','placeholder'=>'enter ','required' => 'required', 'class'=>"form-control"))!!} 
                        <button type="button" class="btn btn-success"  id="addButton">  
                            Add
                        </button>
                        <br/><br/>
                    {!!Form::close() !!}
                   
                    <hr/>
                    <br/>
                    <h1 class="title">Choose your category</h1>
                    {!!Form::open(array('url' => 'done','method' => 'get')) !!}
                        <select name="category" class="form-control browser-default" id="catego" required>
                            <option value="" class="form-control form-control-lg"> -- Select One --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-parent="{{$category->parent_id}}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                           
                        </select>
                        <button type="button" class="btn btn-primary" aria-label="Left Align" id="back">  
                         << back
                        </button>
                    
                        {!! Form::button('<i class="fa fa-plus"></i> Submit',array(
                                    'class'=>'btn btn-success',
                                    'type'=>'submit')) !!}
                    {!!Form::close() !!}
                    <hr/>
                    <br/>
                {!!Form::open(array('url' => 'done','method' => 'get')) !!}

                        <label>New sub category :</label>
                        {!! Form::text('sub','',array('id'=>'newSubCategory','placeholder'=>'Sub category  ','required' => 'required', 'class'=>"form-control"))!!} 
                        <button type="button" class="btn btn-success"  id="addSubButton">  
                            Add Sub Category
                        </button>
                        <br/><br/>
                    {!!Form::close() !!}
                 
               

           </div> 
        </div>
        <br/><br/><br/>
        <div class="addBox">
            {!!Form::open(array('url' => 'add','method' => 'get')) !!}
               
            {!!Form::close() !!}
        </div> 
        <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        <script>
            $(document).ready(function () {
                //change category to sub category
                $('#catego').on('change', function () {
                    var id = $(this).val();
                    $.ajax({
                        type: 'GET',
                        url: 'list/' + id,
                        success: function (response) {
                            var response = JSON.parse(response);  
                            if(response.length>0)
                            {
                                $('#catego').empty();
                                response.forEach(element => {
                                    $('#catego').append(`<option value="${element['id']}"
                                                                value2="${element['parent_id']}">
                                                                ${element['category_name']}
                                                                </option>`);
                                
                                    });
                                   
                                
                            }else{
                                // alert("no more sub");
                            }
                        }
                    });
                });
        //return to the previous list of categories
                $('#back').on('click', function() {
                    let parent_id = $('select option').attr('value2');
                    console.log("p"+parent_id);
                    if(parent_id != undefined){
                        $.ajax({
                            type: 'GET',
                            url: 'back/' + parent_id,
                            success: function (response) {
                                $('#catego').empty();
                                if(response[0].parent_id==0){
                                        $('#catego').append('<option value="" class="form-control form-control-lg">-- Select one --</option>"');
                                    }
                                response.forEach(element => {
                                    $('#catego').append(`<option value="${element['id']}" value2="${element['parent_id']}">${element['category_name']}</option>`);
                                    });
                            } 
                        });
                    }
                });
        // end of return to the previous list  
            // add to existing category or existing subcategory
            $('#addButton').on('click', function() {
                    let parent_id = $('select option').attr('value2');
                    let category_name=$('#newCategory')[0].value;
                    console.log(parent_id , category_name);
                   if(parent_id==undefined||category_name==''){
                       console.log("complete all requirements to add new category");
                   } 
                   else{
                        $.ajax({
                            type: 'GET',
                            url: 'add/' +parent_id+'/'+category_name,
                            success: function (response) {
                                $('#catego').append(`<option  value2="${response[0]}">${response[1]}</option>`);
                                $('#newCategory')[0].value='';
                            } 
                        });
                    }
                });
            //
             // add  subcategory
             $('#addSubButton').on('click', function() {
                    let category_id = $('select option').attr('value');
                    let category_name=$('#newSubCategory')[0].value;
                    console.log(category_id , category_name);
                   if(category_id==undefined||category_name==''){
                       console.log("complete all requirements to add new category");
                   } 
                   else{
                        $.ajax({
                            type: 'GET',
                            url: 'addSub/' +category_id+'/'+category_name,
                            success: function (response) {
                                $('#catego').empty();
                                $('#catego').append(`<option  value2="${response[0]}">${response[1]}</option>`);
                                $('#newCategory')[0].value='';
                                console.log(response);
                            } 
                        });
                    }
                });
            // end of add sub category
    });
    </script>
    </body>

</html>
