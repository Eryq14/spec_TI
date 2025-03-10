`<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty
require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';

//pobranie parametrów
function getParams(&$form){
	$form['kw'] = isset($_REQUEST['kw']) ? $_REQUEST['kw'] : null;
	$form['ku'] = isset($_REQUEST['ku']) ? $_REQUEST['ku'] : null;
	$form['operacja'] = isset($_REQUEST['operacja']) ? $_REQUEST['operacja'] : null;	
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form,&$infos,&$msgs,&$hide_intro){

	//sprawdzenie, czy parametry zostały przekazane - jeśli nie to zakończ walidację
	if ( ! (isset($form['kw']) && isset($form['ku']) && isset($form['operacja']) ))	return false;	
	
	//parametry przekazane zatem
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	// - ta zmienna zostanie użyta w widoku aby nie wyświetlać całego bloku itro z tłem 
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['kw'] == "") $msgs [] = 'Nie podano liczby kwoty';
	if ( $form['ku'] == "") $msgs [] = 'Nie podano liczby kursu';
	if ( $form['kw'] < 0) $msgs [] = 'Kwota nie powinna być mniejsza niż 0';
	if ( $form['ku'] < 0) $msgs [] = 'Kurs nie powinien być mniejszy niż 0';
	
	//nie ma sensu walidować dalej gdy brak parametrów
	if ( count($msgs)==0 ) {
		// sprawdzenie, czy $x i $y są liczbami całkowitymi
		if (! is_numeric( $form['kw'] )) $msgs [] = 'Kwota nie jest liczbą';
		if (! is_numeric( $form['ku'] )) $msgs [] = 'Kurs nie jest liczbą';
	}
	
	if (count($msgs)>0) return false;
	else return true;
}
	
// wykonaj obliczenia
function process(&$form,&$infos,&$msgs,&$result){
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
	
	//konwersja parametrów na int
	$form['x'] = floatval($form['kw']);
	$form['y'] = floatval($form['ku']);
	
	//wykonanie operacji
	switch ($form['operacja']) {
	case 'plneur' :
		$result = $form['kw'] / $form['ku'];
		$form['operacja_nazwa'] = 'plneur';
		break;
	case 'eurpln' :
		$result = $form['kw'] * $form['ku'];
		$form['operacja_nazwa'] = 'eurpln';
		break;
	}
}

//inicjacja zmiennych
$form = null;
$infos = array();
$messages = array();
$result = null;
	
getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty\Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Przykład 04');
$smarty->assign('page_description','Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header','Szablony Smarty');

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.html');