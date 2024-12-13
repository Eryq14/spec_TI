<?php require_once dirname(__FILE__) .'/../config.php'; ?>

<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<body>

<h2 >Kantor</h2>


<form action="<?php print(htmlspecialchars(_APP_URL)); ?>/app/calc.php" method="post">
    <label for="id_amount">Kwota: </label>
    <input id="id_amount" type="text" name="amount" value="<?php if (isset($amount)) print(htmlspecialchars($amount)); ?>" /><br />
    
    <label for="id_rate">Kurs: </label>
    <input id="id_rate" type="text" name="rate" value="<?php if (isset($rate)) print(htmlspecialchars($rate)); ?>" /><br />
    
    <label>Przelicz na: </label><br />
    
    <input type="radio" id="eur_to_pln" name="conversion_type" value="eur_to_pln" 
        <?php if (isset($conversion_type) && $conversion_type == 'eur_to_pln') echo 'checked'; ?>>
    <label for="eur_to_pln">Z euro na PLN</label><br />
    
    <input type="radio" id="pln_to_eur" name="conversion_type" value="pln_to_eur" 
        <?php if (isset($conversion_type) && $conversion_type == 'pln_to_eur') echo 'checked'; ?>>
    <label for="pln_to_eur">Z PLN na euro</label><br /><br />
    
    <input type="submit" value="Przelicz" />
</form> 

<?php

if (isset($messages)) {
    if (count($messages) > 0) {
        echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
        foreach ($messages as $msg) {
            echo '<li>'.$msg.'</li>';
        }
        echo '</ol>';
    }
}
?>

<?php if (isset($result)) { ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
    <?php echo 'Przeliczona kwota: '.number_format($result, 2); ?> 
</div>
<?php } ?>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>
</body>
</html>