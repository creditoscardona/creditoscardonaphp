<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div style="margin-left: 30%; margin-top: 5%">
            <img src="img/logo.png" alt="creditos cardona" width="80" />
        </div>
        <a class="sidebar-brand" href="<?php echo "index.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "index.php"; } ?>">
            <span class="align-middle">Creditos Cardona</span>
        </a>

        <ul class="sidebar-nav">
            <!-- <li class="sidebar-header">
						Pages
					</li> -->
            <?php if($_SESSION["rolId"] == 3){ ?>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/home.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php  echo "home.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "home.php"; } ?>">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/desprendibles.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php  echo "desprendibles.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "desprendibles.php"; } ?>">
                    <i class="align-middle" data-feather="file-text"></i> <span
                        class="align-middle">Desprendibles</span>
                </a>
            </li>

            <?php } else { ?>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/home.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php echo "home.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "home.php"; } ?>">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/clientes.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php echo "clientes.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "clientes.php"; } ?>">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Clientes -
                        Estudio</span>
                </a>
            </li>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/desprendibles.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php echo "desprendibles.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "desprendibles.php"; } ?>">
                    <i class="align-middle" data-feather="file-text"></i> <span
                        class="align-middle">Desprendibles</span>
                </a>
            </li>

            <!--<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.html">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.html">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
            </a>
					</li> -->

            <!-- <li class="sidebar-header">
						Tools & Components
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
              <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-cards.html">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-typography.html">
              <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="icons-feather.html">
              <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
            </a>
					</li>

					<li class="sidebar-header">
						Plugins & Addons
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="charts-chartjs.html">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="maps-google.html">
              <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
            </a>
					</li> -->

            <?php } ?>
            <?php if($_SESSION["rolId"] == 2) { ?>
            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/estadosasesor.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php  echo "estadosasesor.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "estadosasesor.php"; } ?>">
                    <i class="align-middle" data-feather="pocket"></i> <span class="align-middle">Seguimiento clientes</span>
                </a>
            </li>
            <?php } ?>
            <?php if($_SESSION["rolId"] == 1){ ?>
            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/seguimientoasesor.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php echo "seguimientoasesor.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "seguimientoasesor.php"; } ?>">
                    <i class="align-middle" data-feather="pocket"></i> <span class="align-middle">Seguimiento a
                        asesores</span>
                </a>
            </li>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/usuarios.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php echo "usuarios.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "usuarios.php"; } ?>">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Usuarios</span>
                </a>
            </li>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/estadisticas.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php echo "estadisticas.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "estadisticas.php"; } ?>">
                    <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Estadísticas</span>
                </a>
            </li>

            <li class="sidebar-item <?php if($_SERVER['REQUEST_URI']=="/estadisticaubicacion.php") { echo "active"; } ?>">
                <a class="sidebar-link" href="<?php echo "estadisticaubicacion.php"; //if($_SESSION["blockmenu"] == 1) { echo "javascript:void(0);saveClientFinish();"; }else{ echo "estadisticaubicacion.php"; } ?>">
                    <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Estadísticas según ubicación</span>
                </a>
            </li>
            <!-- <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Menu no
                        funcional</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Menu no
                        funcional</span>
                </a>
            </li> -->
            <?php } ?>
        </ul>

    </div>
</nav>