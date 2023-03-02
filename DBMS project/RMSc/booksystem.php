
<?php
    session_start() ;
    $conn = new mysqli('localhost', 'root', '', 'rms') ;

        $seat = "select seat_booked from booking";
    
                $rn = $conn->query($seat) ;
                $ar = array() ;
                
                if ($rn->num_rows > 0 ) {
                    $v = 0 ;
                    while ($rar = $rn->fetch_assoc()) {
                        $re = explode(", ", $rar['seat_booked']) ;
                        $g = 0 ;
                        while ($g < count($re)) {
                            $ar[$v] = $re[$g];
                            $v++ ; $g++ ;
                        }

                    }
                }
                
                $js = json_encode($ar) ;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/book.css">
</head>
<body>
    <div class="container">
        <div class="seats">
            <h2 id="title">Take your seats</h2>
            <div class="seat-container">
                <div class="family">


                    <div class="chairs">
                        <button type="button" class="CHAIR" id="a1" onclick="clicked(this)">A1</button>
                        <button type="button" class="CHAIR" id="a2" onclick="clicked(this)">A2</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="a3" onclick="clicked(this)">A3</button>
                        <button type="button" class="CHAIR" id="a4" onclick="clicked(this)">A4</button>
                    </div>
                
                


                    <div class="chairs">
                        <button type="button" class="CHAIR" id="b1" onclick="clicked(this)">B1</button>
                        <button type="button" class="CHAIR" id="b2" onclick="clicked(this)">B2</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="b3" onclick="clicked(this)">B3</button>
                        <button type="button" class="CHAIR" id="b4" onclick="clicked(this)">B4</button>
                    </div>



                    <div class="chairs">
                        <button type="button" class="CHAIR" id="c1" onclick="clicked(this)">C1</button>
                        <button type="button" class="CHAIR" id="c2" onclick="clicked(this)">C2</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="c3" onclick="clicked(this)">C3</button>
                        <button type="button" class="CHAIR" id="c4" onclick="clicked(this)">C4</button>
                    </div>




                    <div class="chairs">
                        <button type="button" class="CHAIR" id="d1" onclick="clicked(this)">D1</button>
                        <button type="button" class="CHAIR" id="d2" onclick="clicked(this)">D2</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="d3" onclick="clicked(this)">D3</button>
                        <button type="button" class="CHAIR" id="d4" onclick="clicked(this)">D4</button>
                    </div>


                    <div class="chairs">
                        <button type="button" class="CHAIR" id="e1" onclick="clicked(this)">E1</button>
                        <button type="button" class="CHAIR" id="e2" onclick="clicked(this)">E2</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="e3" onclick="clicked(this)">E3</button>
                        <button type="button" class="CHAIR" id="e4" onclick="clicked(this)">E4</button>
                    </div>

                    <div class="chairs">
                        <button type="button" class="CHAIR" id="f1" onclick="clicked(this)">F1</button>
                        <button type="button" class="CHAIR" id="f2" onclick="clicked(this)">F2</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="f3" onclick="clicked(this)">F3</button>
                        <button type="button" class="CHAIR" id="f4" onclick="clicked(this)">F4</button>
                    </div>
                    
                    
                </div>
                <div class="couple">
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co1" onclick="clicked(this)">Co1</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co2" onclick="clicked(this)">Co2</button>
                    </div>



                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co3" onclick="clicked(this)">Co3</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co4" onclick="clicked(this)">Co4</button>
                    </div>


                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co5" onclick="clicked(this)">Co5</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co6" onclick="clicked(this)">Co6</button>
                    </div>



                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co7" onclick="clicked(this)">Co7</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co8" onclick="clicked(this)">Co8</button>
                    </div>



                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co9" onclick="clicked(this)">Co9</button>
                    </div>
                    <div class="table">
                        <p>Table 1</p>
                    </div>
                    <div class="chairs">
                        <button type="button" class="CHAIR" id="co10" onclick="clicked(this)">Co10</button>
                    </div>
                    
                    
                    
                    
                </div>
            </div>
        </div>
        <div class="selected">
            <form action="booked.php?resid=<?php echo $_GET['resid']?>&cid=<?php echo $_GET['cid']?>" method="POST">
                <input type="text" name="booked" id="seat" placeholder="Booked Seats" readonly><br>
                <!-- <button type="submit" name="btn" value="Submit" id="btnn">Submit</button> -->
                <input type="submit" name="btn" value="Submit" id="btnn">
            </form>
        </div>
    </div>

    <script>
        let b= document.getElementById('seat') ;

        function clicked(btn) {
            
            if (b.value == "") {
                b.value = btn.id ;
            }else {
                b.value = b.value.concat(", ", btn.id )
            }
            document.getElementById(btn.id).style.backgroundColor = "green" ;
            document.getElementById(btn.id).style.color = "#000" ;
            document.getElementById(btn.id).disabled = true;
        }

        var arr = <?php 
                    echo $js;
            ?> 
        console.log(arr.length) ;
        if (arr.length > 0 ) {

            for (var i =0; i<arr.length; i++) {
                console.log(arr[i]) ;
                let j = document.getElementById(arr[i]) ;
                j.style.backgroundColor = "green" ;
                j.style.color= "#000" ;
                j.disabled = true ;
            }
        }
    </script>
</body>
</html>