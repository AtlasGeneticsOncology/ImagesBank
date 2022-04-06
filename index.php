<!DOCTYPE html>
<html lang="en">

<head>
    <title>Index</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">

</head>

<body>

    <div class="container">

        <img id="logo" src="assets/img/logo-atlas-4.svg" alt="Logo-Atlas"></img>

        <form action="" method="GET" class="needs-validation" novalidate>

            <div class="input-group mb-3 input-group-lg w-100 mt-5">
                <select id="category" class="form-control">
                    <option value="" selected>All categories</option>
                    <option value="hematological">Hematological diseases</option>
                    <option value="tumors">Solid Tumors</option>
                    <option value="genes">Genes</option>
                    <option value="cancer" disabled="disabled">Cancer Prone Diseases</option>
                    <option value="case" disabled="disabled">Case Reports</option>
                    <option value="deep" disabled="disabled">Deep Insight</option>
                    <option value="teaching" disabled="disabled">Educational Items</option>
                </select>
                <input type="text" class="form-control" placeholder="Input your search here..." aria-label="Input your search here..." aria-describedby="basic-addon2" id="text" pattern="[a-zA-Z0-9@#$%&/]+[a-zA-Z0-9@#$%&/ ]+" required>

                <div class="input-group-append">
                    <button style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
                <div class="invalid-feedback" style="padding-left:46%">
                    Please input your search.
                </div>
            </div>
        </form>
        <div id="results">
        </div>

        <div id="gallery" class="w-100">

        </div>

        <div class="show-errors" style="display:none;text-align:center;">
            <p style="text-align:center;margin-top:20%;font-size:25px"><strong>Bad News :(</strong><br>Image Not Found</p>
        </div>

        <nav aria-label="Page navigation example" style="margin-top:2%;">
            <ul class="pagination" id="pagbox">
            </ul>
        </nav>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="assets/js/zoomerang.js"></script>

    <script type="text/javascript" src="assets/js/code.js"></script>


</body>

</html>