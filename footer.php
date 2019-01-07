<div class="wrapper row4">
    <footer id="footer" class="hoc clear">
        <!-- ################################################################################################ -->
        <div class="one_third first">
            <h6 class="title">Kontakt</h6>
            <ul class="nospace linklist contact">
                <li><i class="fa fa-map-marker"></i>
                    <address>
                        UM FERI, Koroška cesta 46, 2000 Maribor
                    </address>
                </li>
                <li><i class="fa fa-envelope-o"></i> Trgovko@domain.com</li>
            </ul>
        </div>
        <!-- ################################################################################################ -->
    </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <!-- ################################################################################################ -->
        <p class="fl_left">Copyright &copy; 2018 - Vse pravice pridržane: Skupina šestih</p>
        <p class="fl_right">RAZVOJ PROGRAMSKIH SISTEMOV</p>
        <!-- ################################################################################################ -->
    </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<!--
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->

<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->

<script>
    var slider_min = document.querySelector("#price-min");
    var output=document.getElementById("cenanizja");
    output.innerHTML = slider_min.value;
    slider_min.oninput = function() {
        output.innerHTML=this.value;
       // console.log("Price-min: ", this.value);
    }
    var slider_max = document.querySelector("#price-max");
    var output=document.getElementById("demo2");
    output.innerHTML = slider_max.value;
    slider_max.oninput = function() {
        output.innerHTML=this.value;
        //console.log("Price-max: ", this.value);
    }


</script>
</body>
</html>