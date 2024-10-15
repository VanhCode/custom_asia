<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <style>
        .image-list-small {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0 auto;
            text-align: center;
            max-width: 640px;
            padding: 0;
        }

        .image-list-small li {
            display: inline-block;
            width: 181px;
            margin: 0 12px 30px;
        }


        /* Photo */

        .image-list-small li>a {
            display: block;
            text-decoration: none;
            background-size: cover;
            background-repeat: no-repeat;
            height: 137px;
            margin: 0;
            padding: 0;
            border: 4px solid #ffffff;
            outline: 1px solid #d0d0d0;
            box-shadow: 0 2px 1px #DDD;
        }

        .image-list-small .details {
            margin-top: 13px;
        }


        /* Title */

        .image-list-small .details h3 {
            display: block;
            font-size: 12px;
            margin: 0 0 3px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .image-list-small .details h3 a {
            color: #303030;
            text-decoration: none;
        }

        .image-list-small .details .image-author {
            display: block;
            color: #717171;
            font-size: 11px;
            font-weight: normal;
            margin: 0;
        }
    </style>
    <ul class="image-list-small">
        <li>
            <a href="#" style="background-image: url('assets/images/pictures/bahnhoff.jpg');"></a>
            <div class="details">
                <h3><a href="#">In the subway</a></h3>
                <p class="image-author">Matt Stone</p>
            </div>
        </li>
        <li>
            <a href="#" style="background-image: url('assets/images/pictures/industrial-mech.jpg');"></a>
            <div class="details">
                <h3><a href="#">Industrial</a></h3>
                <p class="image-author">Earnest Leming</p>
            </div>
        </li>
        <li>
            <a href="#" style="background-image: url('assets/images/pictures/colosseum.jpg');"></a>
            <div class="details">
                <h3><a href="#">When in Rome..</a></h3>
                <p class="image-author">Edward Flint</p>
            </div>
        </li>
        <li>
            <a href="#" style="background-image: url('assets/images/pictures/sahale-wa.jpg');"></a>
            <div class="details">
                <h3><a href="#">Mountain Top</a></h3>
                <p class="image-author">Rick Alpine</p>
            </div>
        </li>
        <li>
            <a href="#" style="background-image: url('assets/images/pictures/sahale-wa.jpg');"></a>
            <div class="details">
                <h3><a href="#">Mountain hihi</a></h3>
                <p class="image-author">Rick hihi</p>
            </div>
        </li>
        <li>
            <a href="#" style="background-image: url('assets/images/pictures/sahale-wa.jpg');"></a>
            <div class="details">
                <h3><a href="#">Mountain hoho</a></h3>
                <p class="image-author">Rick hoho</p>
            </div>
        </li>
    </ul>





            <script type="text/javascript" src="{{asset('lib/jquery/jquery-3.2.1.min.js')}} "></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(function() {
                    $(".image-list-small").sortable();
                });
            </script>


</body>

</html>