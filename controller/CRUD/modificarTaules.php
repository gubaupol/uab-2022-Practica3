
<?php
require_once '../../model/database.php';
require_once '../../model/config.php';
require_once './recorrerTaules.php';


if (isset($_GET['modificantPersonsalAjax'])) {

    // updateTable($taula,  $camp, $valor, $id, $conn, $keyField = 'id')
    if ($_GET['inputId'] == 'userName') {
        // before updating the username, we need to check if the username is already taken using seleccionaUsuari function
        $user = seleccionaUsuari($conn, $_GET['value']);
        if ($user) {
            $reponse = 'UsernameTaken';
            //delete spaces
            $reponse = str_replace(' ', '', $reponse);
            echo $reponse;
            die;
        } else {
            echo 'Username available';
        }
    }
    updateTable('usuaris', $_GET['inputId'], $_GET['value'], $id, $conn);
    exit;
}
if (isset($_POST['function'])) {
    switch ($_POST['function']) {
        case 'modificantCompetencies':
            //  ($taula,  $camp, $valor, $id, $conn, $keyField = 'id')
            //  "UPDATE $taula SET $camp = '$valor' WHERE $keyField = $id";


            try {
                updateTable('competencies', 'valor', $_POST['value'], $_POST['inputId'],  $conn);
                echo 'ok';
            } catch (\Throwable $th) {
                echo 'error';
            }
            break;
        case 'modificarestudi':
            try {
                echo "modificarEstudis";
                $userId = $_POST['idUsuari'];
                $taula = $_POST['taula'];
                $idTaula = $_POST['idTaula'];
                $Id = $_POST['estudiId'];
                $DataFi = $_POST['estudiDataFi'];
                $DataInici = $_POST['estudiDataInici'];
                $Descripcio = $_POST['estudiDescripcio'];
                $Empresa = $_POST['estudiEmpresa'];
                $Titol = $_POST['estudiTitol'];
                $Ubicacio = $_POST['estudiUbicacio'];
                modificarEstudis($conn, $Id, $DataInici, $DataFi, $Titol, $Empresa, $Ubicacio, $Descripcio);

                header('Location: ../../profile.php?edit');
                echo 'ok';
            } catch (\Throwable $th) {
                echo 'error';
            }
            break;

        case 'modificarExperiencia':
            try {
                $userId = $_POST['idUsuari'];
                $taula = $_POST['taula'];
                $idTaula = $_POST['idTaula'];
                $Id = $_POST['experienciaId'];
                $DataFi = $_POST['experienciaDataFi'];
                $DataInici = $_POST['experienciaDataInici'];
                $Descripcio = $_POST['experienciaDescripcio'];
                $Empresa = $_POST['experienciaEmpresa'];
                $Titol = $_POST['experienciaTitol'];
                $Ubicacio = $_POST['experienciaUbicacio'];
                modificarExperiencies($conn, $Id, $DataInici, $DataFi, $Titol, $Empresa, $Ubicacio, $Descripcio);

                header('Location: ../../profile.php?edit');
            } catch (\Throwable $th) {
                echo 'error';
                die;
            }



        default:
            # code...
            break;
    }
    die;
}
if (isset($_POST['modificaUnaDadaPersonal'])) {
    echo 'Modificant dades personals';
    $lastUser = $_SESSION['user']['dadesPersonals'][0];
    $userId = $lastUser['id'];
    //name of the received fiels is the same as the name of the column in the database, we need to check if the value is different from the last one
    $nom  = isset($_POST['nom']) ? $_POST['nom'] : $lastUser['nom'];
    $cognoms = isset($_POST['cognoms']) ? $_POST['cognoms'] : $lastUser['cognoms'];
    $email = isset($_POST['email']) ? $_POST['email'] : $lastUser['email'];
    $dataNaixement = isset($_POST['dataNaixement']) ? $_POST['dataNaixement'] : $lastUser['dataNaixement'];
    $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : $lastUser['sexe'];
    $estatCivil = isset($_POST['estatCivil']) ? $_POST['estatCivil'] : $lastUser['estatCivil'];
    $carnetConduir = isset($_POST['carnetConduir']) ? $_POST['carnetConduir'] : $lastUser['carnetConduir'];
    $codiPostal = isset($_POST['codiPostal']) ? $_POST['codiPostal'] : $lastUser['codiPostal'];
    $poblacio = isset($_POST['poblacio']) ? $_POST['poblacio'] : $lastUser['poblacio'];
    $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : $lastUser['provincia'];
    $pais = isset($_POST['pais']) ? $_POST['pais'] : $lastUser['pais'];
    $carrer = isset($_POST['carrer']) ? $_POST['carrer'] : $lastUser['carrer'];
    $telefon = isset($_POST['telefon']) ? $_POST['telefon'] : $lastUser['telefon'];

    echo $nom . ' ' . $cognoms . ' ' . $email . ' ' . $dataNaixement . ' ' . $sexe . ' ' . $estatCivil . ' ' . $carnetConduir . ' ' . $codiPostal . ' ' . $poblacio . ' ' . $provincia . ' ' . $pais . ' ' . $carrer . '<br>';

    // function updateTable($taula,  $camp, $valor, $id, $conn)

    if ($nom != $lastUser['nom']) {
        echo "nom";
        if (strlen($nom) > 0) {
            updateTable('usuaris', 'nom', $nom, $userId, $conn);
        }
    }
    if ($cognoms != $lastUser['cognoms']) {
        echo "cognoms";
        if (strlen($cognoms) > 0) {
            updateTable('usuaris', 'cognoms', $cognoms, $userId, $conn);
        }
    }
    if ($email != $lastUser['email']) {
        echo "email";
        if (strlen($email) > 0) {
            updateTable('usuaris', 'email', $email, $userId, $conn);
        }
    }
    if ($dataNaixement != $lastUser['dataNaixement']) {
        echo "dataNaixement";
        if (strlen($dataNaixement) > 0) {
            updateTable('usuaris', 'dataNaixement', $dataNaixement, $userId, $conn);
        }
    }
    if ($sexe != $lastUser['sexe']) {
        if (strlen($sexe) > 0) {
            updateTable('usuaris', 'sexe', $sexe, $userId, $conn);
        }
    }

    if ($poblacio != $lastUser['poblacio']) {
        echo "poblacio";
        if (strlen($poblacio) > 0) {
            updateTable('usuaris', 'poblacio', $poblacio, $userId, $conn);
        }
    }
    if ($codiPostal != $lastUser['codiPostal']) {
        echo "codiPostal";
        if (strlen($codiPostal) > 0) {
            updateTable('usuaris', 'codiPostal', $codiPostal, $userId, $conn);
        }
    }
    if ($provincia != $lastUser['provincia']) {
        echo "provincia";
        if (strlen($provincia) > 0) {
            updateTable('usuaris', 'provincia', $provincia, $userId, $conn);
        }
    }
    if ($pais != $lastUser['pais']) {
        echo "pais";
        if (strlen($pais) > 0) {
            updateTable('usuaris', 'pais', $pais, $userId, $conn);
        }
    }
    if ($carrer != $lastUser['carrer']) {
        echo "carrer";
        if (strlen($carrer) > 0) {
            updateTable('usuaris', 'carrer', $carrer, $userId, $conn);
        }
    }
    if ($telefon != $lastUser['telefon']) {
        echo "telefon";
        if (strlen($telefon) > 0) {
            $telParsed = strval(str_replace(' ', '', $telefon));
            updateTable('usuaris', 'telefon', $telParsed, $userId, $conn);
        }
    }

    if ($carnetConduir != $lastUser['carnetConduir']) {
        echo "permisConduir";
        if (strlen($carnetConduir) > 0) {
            updateTable('usuaris', 'carnetConduir', $carnetConduir, $userId, $conn);
        }
    }
    if ($estatCivil != $lastUser['estatCivil']) {
        echo "permisConduir";
        if (strlen($estatCivil) > 0) {
            updateTable('usuaris', 'estatCivil', $estatCivil, $userId, $conn);
        }
    }
    header('Location: ../../profile.php?edit');
    exit();
}

if (isset($_POST['modificarIdioma'])) {
    $idIdioma = $_POST['id'];
    $nivell = $_POST['nivell'];
    modificaIdioma($conn, $idIdioma, $nivell);
    header('Location: ../../profile.php?edit');
}

if (isset($_POST['modificaHabilitats'])) {
    $id = $_POST['id'];
    $nivell = $_POST['nivell'];
    modificaHabilitats($conn, $id, $nivell);
    header('Location: ../../profile.php?edit');
}
if (isset($_POST['modificaInformatica'])) {
    $id = $_POST['id'];
    $nivell = $_POST['nivell'];
    modificaInformatica($conn, $id, $nivell);
    header('Location: ../../profile.php?edit');
}


if (isset($_POST['modificarEstudis'])) {

    exit();
}



if (isset($_POST['modificaContrasenya'])) {
    $newPassword = $_POST['password'];
    $userEmail = $_SESSION['user']['dadesPersonals'][0]['email'];
    // we will send a code to user email, and then we will check if the code is correct
    $code = rand(100000, 999999);
    $subject = "Codi de verificació";
    $message = "El teu codi de verificació és: " . $code;
    $headers = "From: " . $userEmail;
    mail($userEmail, $subject, $message, $headers);
    $_SESSION['code'] = $code;
    $_SESSION['newPassword'] = $newPassword;
    header('Location: ../../views/validarContrasenya.php');
}



echo 'no hi ha cap post';
