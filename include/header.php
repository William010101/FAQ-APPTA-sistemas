<div class="container-fluid" id="navbar">
    <div class="container">

        <header class="header">
            <nav class="navbar navbar-light">
                <a class="navbar-brand" href="inicio" title="Página inicial">
                    <img src="img/logocentralajuda.svg" height="50" class="logocentral" alt="Logotipo">
                </a>
                <?php if($pagina != "inicio"): ?>
                <form method="POST" action="search" id="searchnav">
                    <div class="input-group" id="pesquisacategoria">
                        <input id="inputpesquisa" type="search" name="pesquisar" class="form-control"
                            placeholder="Tente buscar por tópicos ou palavras-chave">
                        <div class="input-group-append">
                            <button class="btn " id="btnpesquisar" type="text"><i class="material-icons"
                                    id="">search</i></button>
                        </div>
                    </div>
                </form>
                <?php endif;?>
                <div class="nav-wrapper" title="Site APPTA Sistemas">
                    <div class="btn-group">
                        <button class="btn btn-link btn-sm dropdown-toggle text-light" id="btnLinkConheca" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Conheça nossos sistemas
                        </button>
                        <div class="dropdown-menu bg-light">
                        <a class="dropdown-item" href="https://apptasistemas.com.br/appta">APPTA</a>
                        <a class="dropdown-item" href="https://apptasistemas.com.br/food">APPTA FOOD</a>
                        <a class="dropdown-item" href="https://apptasistemas.com.br/fidelizappta">FidelizAPPTA</a>
                        </div>
                    </div>
                </div>
            </nav>

        </header>

    </div>
</div>