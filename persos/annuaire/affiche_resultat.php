<?php
/**
 * Annuaire des personnages
 * 
 * @author Simonet Fabrice <aigleblanc@gmail.com>
 * @version 
 * @package annuaire
 */
echo '<h2>Annuaire des personnages EwOiens</h2>

<div align="center">
	<table width="400" id="perso_liste" border="0">
		<tr>
			<td colspan="3" align="center" style="background-color:', $couleur , '; color:#fff;"><b><a href="',SERVER_URL,'/persos/event/?id=', $mat, '">', nom_perso($mat), ' (Mat. ', $mat, ')</a></b></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><img src="', SERVER_URL, '/images/', $url, '" alt="avatar"></td>
		</tr>
		<tr>
			<td colspan="3" align="center">Matricule : ', $mat, '</td>
		</tr>';
if (isset($_SESSION['utilisateur']['id'])){
		echo '<tr>';
		if(isset($_SESSION['persos']['current_id'])) {
			echo '<td align="center">[ <a href="',SERVER_URL,'/messagerie/?id=', $_SESSION['persos']['current_id'], '&dest=', $mat, '">Envoyer un message</a> ]</td>';
		} else {
			echo '<td></td>';
		}
			
		echo'	<td align="center">[ <a href="ajout_repertoire.php">Ajouter à mon répertoire</a> ]</td>
			<td align="center">[ <a href="',SERVER_URL,'/jeu/classement/position.php?mat=', $mat,'">Voir le classement</a> ]</td>
		</tr>';
 }
echo '</table>
	<p>[<a href="', SERVER_URL, '/persos/annuaire/">Retour</a>]</p>
</div>';

?>
