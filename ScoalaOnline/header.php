<?php
include 'connection.php';
$option = $_GET['q'];
if ($option == "DatePersonale") {
    $sql = "SELECT user_data.nume, user_data.prenume, user_data.judet, user_data.localitate, user_data.scoala
FROM user_data WHERE user_data.id_user = ?";
    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nume, $prenume, $judet, $localitate, $scoala);
    $stmt->fetch();
    $stmt->close();

    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>CustomerID</th>";
    echo "<td>" . $nume . "</td>";
    echo "<th>CompanyName</th>";
    echo "<td>" . $prenume . "</td>";
    echo "<th>ContactName</th>";
    echo "<td>" . $judet . "</td>";
    echo "<th>Address</th>";
    echo "<td>" . $localitate . "</td>";
    echo "<th>City</th>";
    echo "<td>" . $scoala . "</td>";
    echo "</tr>";
    echo "</table>";
}

?>

<!doctype html>
<html lang="en">
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="check-session.js"></script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Scoala online</title>
</head>

<body>

<div class="container">
    <div class="card  mt-20 mb-4 text-white rounded bg-dark justify-content-center align-items-center"
         style="height: 140px;">
        <div class="px-1">
            <h1 class="display-4 font-italic"><a href="main.html"> Scoala online</a></h1>
        </div>
    </div>
</div>


<div class="container">

    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-2">
            <div class="alert alert-primary" role="alert"><a href="my_profile.html" class="alert-link">Profilul meu</a>
            </div>
            <div class="alert alert-primary" role="alert"><a href="#" class="alert-link">Clasa mea</a>
            </div>
            <div class="alert alert-primary" role="alert"><a href="#" class="alert-link">Teme</a>
            </div>
            <div class="alert alert-primary" role="alert"><a href="#" class="alert-link">Note</a>
            </div>
            <div class="alert alert-primary" role="alert"><a href="#" class="alert-link">Forum</a>
            </div>
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>


        </div><!-- /.col-lg-4 -->


        <div class="col-lg-8">
            <form action="">
                <select name="customers" onchange="showCustomer(this.value)">
                    <option value="">Selectează o opțiune:</option>
                    <option value="DatePersonale">Date personale</option>
                    <option value="Parola">Parola</option>
                    <option value="Email">Email</option>
                    <option value="ClaseleMele">Clasele mele</option>
                </select>
            </form>
            <br>
            <div id="txtHint">Customer info will be listed here...</div>
            <script>
                function showCustomer(str) {
                    var xhttp;
                    if (str == "") {
                        document.getElementById("txtHint").innerHTML = "";
                        return;
                    }
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "getcustomer.php?q="+str, true);
                    xhttp.send();
                }
            </script>


            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                Date personale
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordionExample">
                        <form method="POST" action="#">

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="user" class="control-label" style="font-size: small">Nume</label>
                                        <input type="text" name="user" id="user" class="form-control"
                                               style="font-size: small">
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="control-label" style="font-size: small">Prenume</label>
                                        <input type="text" name="user" id="prenume" class="form-control"
                                               style="font-size: small">
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="control-label" style="font-size: small">Judet</label>
                                        <input type="text" name="user" id="judet" class="form-control"
                                               style="font-size: small">
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="control-label"
                                               style="font-size: small">Localitate</label>
                                        <input type="text" name="user" id="localitate" class="form-control"
                                               style="font-size: small">
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="control-label" style="font-size: small">Școală</label>
                                        <input type="text" name="user" id="scoala" class="form-control"
                                               style="font-size: small">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-login-raspuns"></div>
                                    </div>
                                    <div class="form-group right">
                                        <button type="submit" class="btn btn-primary">Salvare</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Parola
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <form method="POST" action="#">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="user" class="control-label" style="font-size: small">Parolă
                                                veche</label>
                                            <input type="password" name="user" id="oldpass" class="form-control"
                                                   style="font-size: small">
                                        </div>
                                        <div class="form-group">
                                            <label for="user" class="control-label" style="font-size: small">Introduceți
                                                parolă nouă</label>
                                            <input type="password" name="user" id="newpass" class="form-control"
                                                   style="font-size: small">
                                        </div>
                                        <div class="form-group">
                                            <label for="user" class="control-label" style="font-size: small">Repetă noua
                                                parolă</label>
                                            <input type="password" name="user" id="newpass2" class="form-control"
                                                   style="font-size: small">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-login-raspuns"></div>
                                        </div>
                                        <div class="form-group right">
                                            <button type="submit" class="btn btn-primary">Salvare</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Email
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            <form method="POST" action="#">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="user" class="control-label" style="font-size: small">Email</label>
                                            <input type="email" name="user" id="newemail" class="form-control"
                                                   style="font-size: small">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-login-raspuns"></div>
                                        </div>
                                        <div class="form-group right">
                                            <button type="submit" class="btn btn-primary">Salvare</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Clasa mea
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingThree"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa
                                nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                vice
                                lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                                probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.col-lg-4 -->


        <div class="col-lg-2">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
                 preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#777"></rect>
                <text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
            </svg>
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula
                porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
                fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


</div>



<footer class="blog-footer">
    <p></p>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>


