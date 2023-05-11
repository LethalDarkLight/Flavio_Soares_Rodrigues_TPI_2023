<?php
function ShowNavbar()
{
    echo "
    <header>
        <nav class='navbar navbar-dark bg-dark navbar-expand-lg py-0'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='index.php'><img style='width:203px; height:130px' class='my-0' src='./assets/images/LogoGYM.png' alt='Logo'></a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='d-flex flex-column w-100'>
                    <div class='collapse navbar-collapse my-2 w-100' id='navbarSupportedContent'>
                        <ul class='navbar-nav ms-auto me-5 mb-lg-0 d-flex justify-content-end'>
                            <li class='nav-item mx-2 my-1'>
                                <a class='btn btn-primary navigationBtn' aria-current='page' href='login.php'><i class='fa-solid fa-arrow-right-to-bracket'></i> Se connecter</a>
                            </li>
                            <li class='nav-item mx-2 my-1'>
                                <a class='btn btn-primary navigationBtn' href='register.php'><i class='fa-solid fa-user-plus'></i> S'enregister</a>
                            </li>
                        </ul>
                    </div>
                    <div class='collapse navbar-collapse border-top border-3 border-white w-100 rounded my-1'></div>
                    <div class='collapse navbar-collapse my-2 w-100' id='navbarSupportedContent'>
                        <form class='form-inline w-100'>
                            <ul class='navbar-nav me-auto mb-lg-0 w-100'>
                                <li class='nav-item mx-2 d-flex flex-row class='w-100'>
                                    <input class='form-control search' type='text' placeholder='Saisie'>
                                    <button class='btn btn-primary' type='submit'><i class='fa-solid fa-search'></i></button>
                                </li>
                                <li class='nav-item mx-2'>
                                    <select class='form-select filterControl'>
                                        <option selected>Combobox</option>
                                        <option value='1'>Option 1</option>
                                        <option value='2'>Option 2</option>
                                        <option value='3'>Option 3</option>
                                    </select>
                                </li>
                                <li class='nav-item mx-2'>
                                    <input class='form-control filterControl' type='number' placeholder='Prix min'>
                                </li>
                                <li class='nav-item mx-2'>
                                    <input class='form-control filterControl' type='number' placeholder='Prix max'>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    ";
}
?>