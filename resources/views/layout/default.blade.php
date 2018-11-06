<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pt" class="no-js">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
    <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="-1"/>

    <title>i-Educar - Pais</title>

    <script>
        dataLayer = [{
            'slug': '{{$config['app']['database']['dbname']}}',
            'user_id': '{{$loggedUser->personId}}',
            'user_name': '{{$loggedUser->name}}',
            'user_email': '{{$loggedUser->email}}'
        }];
    </script>

@if(!empty($config['app']['gtm']['id']))
    <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{$config['app']['gtm']['id']}}');</script>
        <!-- End Google Tag Manager -->
    @endif

    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/main.css') }}'/>
    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/styles.css') }}'/>
    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/novo.css') }}'/>
    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/menu.css') }}'/>
    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/font-awesome.css') }}'/>
<!--link rel=stylesheet type='text/css' href='{{ Asset::get('styles/reset.css') }}'/>
    <link rel=stylesheet type='text/css' href='{{ Asset::get('styles/portabilis.css') }}' /-->
    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/min-portabilis.css') }}'/>
    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/mytdt.css') }}'/>
    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/jquery.modal.css') }}'/>
    <script src="https://maps.google.com/maps/api/js?sensor=true" type="text/javascript" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/localizacaoSistema.css') }} '/>

    <script>(function (e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);</script>

    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/padrao.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/novo.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/dom.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/menu.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/ied/forms.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/ied/phpjs.js") }} "></script>

    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/jquery/jquery-1.8.3.min.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/jquery/jquery.modal.min.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/prototype/prototype-1.7.1.0.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/scriptaculous/effects.js") }} "></script>
    <script type="text/javascript" src="{{ Asset::get("/intranet/scripts/jquery.mask.min.js") }} "></script>
    <script type="text/javascript">
        window.ambiente = 'development';

        var running = false;
        var altura = null;

        function changeImage(div_id) {
            var id = /[0-9]+/.exec(div_id.element.id);
            var imagem = $('seta_' + id);
            var src = imagem.src.indexOf('arrow-up');

            imagem.src = (src != -1) ?
                'imagens/arrow-down2.png' : 'imagens/arrow-up2.png';

            imagem.title = (src != -1) ?
                imagem.title.replace('Abrir', 'Fechar') :
                imagem.title.replace('Fechar', 'Abrir');

            if (src != -1) {
                setCookie('menu_' + id, 'I', 30);
            }
            else {
                setCookie('menu_' + id, 'V', 30);
            }

            running = false;
            $('tablenum1').style.height = $('tablenum1').offsetHeight - altura;
        }

        function teste(div_id) {
            altura = div_id.element.offsetHeight;
        }

        function toggleMenu(div_id) {
            if (running) {
                return;
            }

            var src = $('link1_' + div_id).title.indexOf('Abrir');

            $('link1_' + div_id).title = (src != -1) ?
                $('link1_' + div_id).title.replace('Abrir', 'Fechar') :
                $('link1_' + div_id).title.replace('Fechar', 'Abrir');

            $('link2_' + div_id).title = (src != -1) ?
                $('link2_' + div_id).title.replace('Abrir', 'Fechar') :
                $('link2_' + div_id).title.replace('Fechar', 'Abrir');

            running = true;

            new Effect.toggle($('div_' + div_id), 'slide', {
                afterFinish: changeImage,
                duration: 0.3,
                beforeStart: teste
            });
        }
    </script>

    <!-- #&SCRIPT&# -->

    <script type="text/javascript">

    </script>

    <link rel=stylesheet type='text/css' href='{{ Asset::get('/intranet/styles/custom.css') }}'/>
</head>
<body>

@if(!empty($config['app']['gtm']['id']))
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id={{$config['app']['gtm']['id']}}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif

<div id="DOM_expansivel" class="DOM_expansivel"></div>
<table summary="" class='tabelanum1' id="tablenum1" border='0' cellspacing='0' cellpadding='0'>
    <tr id="topo" class="topo">
        <td class="logo" align="left"><a style="color:#FFF; text-decoration: none;" href="/">i-Educar</a></td>
        <td id="perfil-user-id" class="perfil-user" align="right">
            <a class="icons-top" href="#">
                <img id="notificacao" src="/intranet/imagens/icon-nav-notifications.png">
            </a>
            <a href="/intranet/meusdados.php" title="Meus dados">
                <div id="foto-user" class="foto-user"
                     style="background: url('/intranet/imagens/user-perfil.png')"></div>
            </a>
            <div class="dropdown">
                <div class="dropbtn">Administrador</div>
                <div class="dropdown-content">
                    <a href="/intranet/agenda.php">Agenda</a>
                    <a href="/intranet/index.php">Calendário</a>
                    <a href="/intranet/meusdados.php">Meus dados</a>
                    <a href="/intranet/logof.php">Sair</a>
                </div>
            </div>
            <!--a href="http://www.google.com.br/" target="_blank"><img src="imagens/nvp_bot_internet.jpg" width="62" height="21" border="0" alt="Acessar Internet" title="Acessar a Web"></a-->
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <table summary="" class='tabelanum2' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                    <td id="menu_lateral" class="r3c1" width='170'>
                        <table summary='' cellspacing='0' class='nvp_tabelaMenu'>
                            <tr>
                                <td>
                                    <link rel=stylesheet type='text/css'
                                          href='{{ Asset::get('/intranet/styles/buscaMenu.css') }}'/>
                                    <link rel=stylesheet type='text/css'
                                          href='{{ Asset::get('/intranet/scripts/jquery/jquery-ui.min-1.9.2/css/custom/jquery-ui-1.9.2.custom.min.css') }}'/>
                                    <script type='text/javascript'
                                            src='{{ Asset::get('/modules/Portabilis/Assets/Javascripts/Frontend/Inputs/SimpleSearch.js') }}'></script>
                                    <script type='text/javascript'
                                            src='{{ Asset::get('/modules/Portabilis/Assets/Javascripts/Utils.js') }}'></script>
                                    <script type='text/javascript'
                                            src='{{ Asset::get('/intranet/scripts/buscaMenu.js') }}'></script>
                                    <script type='text/javascript'
                                            src='{{ Asset::get('/intranet/scripts/jquery/jquery-ui.min-1.9.2/js/jquery-ui-1.9.2.custom.min.js') }}'></script>
                                    <div title='Busca rápida' class='title-busca-rapida'>
                                        <table width='168' class='title active-section-title'
                                               style='-moz-user-select: none;'>
                                            <tbody style='-moz-user-select: none;'>
                                            <tr style='-moz-user-select: none;'>
                                                <td style='-moz-user-select: none;'><a
                                                            style='outline:none;text-decoration:none;'>Busca rápida</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @include('layout.menu')
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td valign=top>
                        <table summary="" class='tabelanum2' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td height="0" id="menu_suspenso">
                                    <input type="hidden" value="" id="posx">
                                    <input type="hidden" value="" id="posy">
                                </td>
                            </tr>
                            <tr>
                                <td height="100%" valign="top" id="corpo">
                                    <table class='tablelistagem' width='100%' border='0' cellpadding='0'
                                           cellspacing='0'>
                                        <tr height='10px'>
                                            <td class='fundoLocalizacao' colspan='2'>
                                                @include('layout.breadcrumb')
                                            </td>
                                        </tr>
                                    </table>
                                    <table class='tablelistagem' width='100%' border='0' cellpadding='2'
                                           cellspacing='1'>
                                        <tr>
                                            <td class='formdktd' colspan='2' height='24'>
                                                @yield('content')
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="rodape">
        <td colspan="3">
            <center>
                <p>Conhe&ccedil;a mais sobre o i-Educar e a Portabilis, <a href="   http://blog.portabilis.com.br"
                                                                           target="_blank">acesse nosso blog</a> &nbsp;&nbsp;&nbsp;
                    &copy; Portabilis - Todos os direitos reservados</p>
            </center>
        </td>
    </tr>
</table>

<script type="text/javascript">function go(url) {
        document.location = url;
    }

    var goodIE = (document.all) ? 1 : 0;
    var netscape6 = (document.getElementById && !document.all) ? 1 : 0;
    var aux = '';
    var aberto = false;

    function CarregaDetalhe(id_div, endereco) {
        var elemento_div = document.getElementById(id_div);
        if (endereco != '') {
            xmlhttp.open("GET", endereco, true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    elemento_div.innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.send(null);
        }
    }

    function AbreFecha(id_div, id_img) {
        var elemento_div = document.getElementById(id_div);
        var elemento_img = document.getElementById(id_img);

        if (!aberto) {
            elemento_div.style.overflow = 'visible';
            if (goodIE) {
                elemento_div.style.height = '0px';
                elemento_img.src = 'excluir_1.gif';
                elemento_img.alt = 'Fechar';
            }
            else {
                elemento_div.style.height = '100%';
                elemento_img.src = 'excluir_1.gif';
                elemento_img.alt = 'Fechar';
            }
        }
        else {
            elemento_img.src = 'log-info.gif';
            elemento_div.style.overflow = 'hidden';
            elemento_div.style.height = '1px';
            elemento_img.alt = 'Visualizar detalhes';
        }

        aberto = !aberto;
    }

    function AdicionaItem(chave, item, nome_pai, submete) {
        var x = document.getElementById(nome_pai);

        opt = document.createElement('OPTION');
        opt.value = chave;
        opt.selected = true;
        opt.appendChild(document.createTextNode(item));

        x.appendChild(opt);
        if (submete) {

            document.formcadastro.submit();
        }
    }

    function go(url) {
        document.location = url;
    }

    function excluir() {
        document.formcadastro.reset();

        if (confirm('Excluir registro?')) {
            document.formcadastro.tipoacao.value = 'Excluir';
            document.formcadastro.submit();
        }
    }

    function ExcluirImg() {
        document.formcadastro.reset();
        if (confirm('Excluir imagem?')) {
            document.formcadastro.tipoacao.value = 'ExcluirImg';
            document.formcadastro.submit();
        }
    }
</script>

<script type='text/javascript'
        src='{{ Asset::get('/modules/Portabilis/Assets/Javascripts/Utils.js') }}'></script>
<script type='text/javascript'>(function ($) {
        $(document).ready(function () {
            fixupFieldsWidth();
        });
    })(jQuery);</script>

<script src="{{ Asset::get("/intranet/scripts/custom-file-input.js") }}"></script>
<script type="text/javascript" src="{{ Asset::get("/intranet/scripts/select2/select2.full.min.js") }}"></script>
<script type="text/javascript" src="{{ Asset::get("/intranet/scripts/select2/pt-BR.js") }}"></script>
<link type="text/css" rel="stylesheet" href="{{ Asset::get("/intranet/scripts/select2/select2.min.css") }}"/>
<script type="text/javascript">array_menu = new Array();
    array_id = new Array();
    array_menu[array_menu.length] = new Array("Cadastros ", 999930, '', '', '', '', '_self');
    array_id[array_id.length] = 999930;
    array_menu[array_menu.length] = new Array("Ferramentas ", 999931, '', '', '', '', '_self');
    array_id[array_id.length] = 999931;
    array_menu[array_menu.length] = new Array("Países ", 753, '999930', '', '', 'public_pais_lst.php', '_self');
    array_menu[array_menu.length] = new Array("Unificação de bairros ", 761, '999931', '', '', 'educar_unifica_bairro.php', '_self');
    array_menu[array_menu.length] = new Array("Estados ", 754, '999930', '', '', 'public_uf_lst.php', '_self');
    array_menu[array_menu.length] = new Array("Unificação de logradouros ", 762, '999931', '', '', 'educar_unifica_logradouro.php', '_self');
    array_menu[array_menu.length] = new Array("Municípios ", 755, '999930', '', '', 'public_municipio_lst.php', '_self');
    array_menu[array_menu.length] = new Array("Distritos ", 759, '999930', '', '', 'public_distrito_lst.php', '_self');
    array_menu[array_menu.length] = new Array("Setores ", 760, '999930', '', '', 'public_setor_lst.php', '_self');
    array_menu[array_menu.length] = new Array("Bairros ", 756, '999930', '', '', 'public_bairro_lst.php', '_self');
    array_menu[array_menu.length] = new Array("Logradouros ", 757, '999930', '', '', 'public_logradouro_lst.php', '_self');
    array_menu[array_menu.length] = new Array("CEP ", 758, '999930', '', '', 'urbano_cep_logradouro_lst.php', '_self');</script>
<script type="text/javascript">
    setTimeout("setXY();", 150);
    MontaMenu();
</script>
<script type="text/javascript">

</script>
</body>
</html>