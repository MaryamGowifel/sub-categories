<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Categories & Sub categories </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
        <link href = '{{ asset("bootstrap/css/bootstrap.css") }} rel="stylesheet"' />
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

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

           
            .m-b-md {
                margin-bottom: 30px;
            }
            #catego{
                width:30em;
                height:3em;
                font:20px Arial, sans-serif;
                color:#333;
                text-align-last:center;
            }
            #catego option{
               
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="title m-b-md">
                Choose your category
                   
                   
                </div>
                
                    {!!Form::open(array('url' => 'done','method' => 'get')) !!}
                    
                    <select name="category" class="form-control browser-default" id="catego" required>
                        <option value=""> -- Select One --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                            
                                {{ $category->category_name }}
                            </option>
                           
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-default" aria-label="Left Align" id="back">  
                
                    </button>
                    
                    {!! Form::button('<i class="fa fa-plus"></i> Submit',array(
                                'class'=>'btn btn-success',
                                'type'=>'submit')) !!}
                        {!!Form::close() !!}
                
            </div>

        </div>
        <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        <script>
                $(document).ready(function () {
                   
                $('#catego').on('change', function () {
                    var id = $(this).val();
                $.ajax({
                type: 'GET',
                url: 'list/' + id,
                success: function (response) {
                var response = JSON.parse(response);   
                if(response.length>0)
                {$('#catego').empty();
                response.forEach(element => {
                    $('#catego').append(`<option value="${element['id']}">${element['category_name']}</option>`);
                    });
                }
                
                }
            });
        });
         
        });
    });
    </script>
    </body>

</html>
