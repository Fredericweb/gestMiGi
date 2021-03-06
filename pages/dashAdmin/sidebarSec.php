
 <!-- side bar -->
 <nav class='sidebar sidebar-offcanvas' id='sidebar'>
      <div class='text-center sidebar-brand-wrapper d-flex align-items-center'>
        <a class='sidebar-brand brand-logo' href='index.html'><img src='../../assets/images/logo.svg' alt='logo' /></a>
        <a class='sidebar-brand brand-logo-mini pl-4 pt-3' href='index.html'><img
            src='../../assets/images/logo-mini.svg' alt='logo' /></a>
      </div>
      <ul class='nav'>
        <li class='nav-item nav-profile'>
          <a href='#' class='nav-link'>
            <div class='nav-profile-image'>
              <img src='../../assets/images/faces-clipart/pic-1.png' alt='profile' />
              <span class='login-status online'></span>
              <!--change to offline or busy as needed-->
            </div>
            <div class='nav-profile-text d-flex flex-column pr-3'>
              <span class='font-weight-medium mb-2'><?=$rst['nom']?> <?=$rst['prenom']?></span>
              <span class='font-weight-normal'><?=$rst['login']?></span>
            </div>
          </a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='index.php'>
            <i class='mdi mdi-home menu-icon'></i>
            <span class='menu-title'>Dashboard</span>
          </a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' data-toggle='collapse' href='#ui-basic' aria-expanded='false' aria-controls='ui-basic'>
            <i class='mdi mdi-crosshairs-gps menu-icon'></i>
            <span class='menu-title'>Etudiants</span>
            <i class='menu-arrow'></i>
          </a>
          <div class='collapse' id='ui-basic'>
            <ul class='nav flex-column sub-menu'>
              <li class='nav-item'>
                <a class='nav-link' href='../add_etud.php'>Ajouter un etudiants</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../manage_etud.php'>Gerer etudiants</a>
              </li>
            </ul>
          </div>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='../manage_classe.php'>
            <i class='mdi mdi-contacts menu-icon'></i>
            <span class='menu-title'>Classes</span>
          </a>
        </li>
        <li class='nav-item'>
          <span class='nav-link' href='#'>
            <span class='menu-title'>Docs</span>
          </span>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href=''>
            <i class='mdi mdi-file-document-box menu-icon'></i>
            <span class='menu-title'>Documentation</span>
          </a>
        </li>
      </ul>
    </nav>