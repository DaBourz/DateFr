<?php

namespace dabourz;

/**
 * DateFr Class
 *
 * @category	Libraries
 * @author		Stéphane Bourzeix
 * @package		dabourz
 */
 
class DateFr {

	private $defaulttime;

	public function __construct()
    {
        $this->defaulttime = time();
    }

	/**
	 * Format and return the date in french
	 *
	 * @access	public
	 * @param	timestamp	unix timestamp
	 * @param	string		day display formatting
	 * @param	string		month display formatting
	 * @param	string		hour display formatting
	 * @return	string	
	 *
	 * Usage:
	 * Function has 4 params:
	 * - timestamp: date/time (UNIX format)
	 * - modejour: l:long (lundi 23) ; c:short (lun 23) ; n:day number (23) ; h:nothing
	 *   L or C in Caps puts the first letter of the day in Caps (ex C : Lun)
	 * - modemois: l:long (septembre) ; c:short (sept) ; n:number (09) ; h:nothing
	 *   L or C in Caps puts the first letter of the day in Caps (ex C : Lun)
	 * - modeheure: l:long (7 heures 35) ; c:short (7h35) ; n:nothing
	 *
	 * Examples :
	 * $this->load->library('dateutils');
	 *
	 * echo $this->dateutils->datefr()					=	27/04/1980
	 * echo $this->dateutils->datefr(325689845,'C','L','n');	=	Dim 27 Avril 1980
	 * echo $this->dateutils->datefr(325689845,'n','c','n');	=	27 avr 1980
	 * echo $this->dateutils->datefr(325689845,'l','n','l');	=	dimanche 27/04/1980 7 heures 35
	 * echo $this->dateutils->datefr(325689845,'h','h','l');	=	7 heures 35
	 */
	function datefr($timestamp = null, $modejour = 'n', $modemois = 'n', $modeheure = 'n')
	{
		if ($timestamp==null){$timestamp = $this->defaulttime;}
		
    	 /* On formate notre date */
    	$jour=date( "d",$timestamp);      // jour
    	$mois=date( "m",$timestamp);      // mois
    	$annee=date( "Y",$timestamp);      // annee
    	$num_jour=date( "w",$timestamp);     // numero du jour de la semaine
    	$hour=date( "H",$timestamp);         // heure
    	$minute=date( "i",$timestamp);     // minute
		
    	 /* Initialisation*/
    	$heure= '';
    	$aff_heure= ' heures ';
    	if ($hour==0 || $hour==1)
    	    $aff_heure= ' heure ';
		
    	 /* On definit numero du mois */
		$zero  =  substr($mois,0,1);
		if  ($zero  ==   "0")  {
			$num_mois  =  substr($mois,1,1);  // On supprime le premier zero
		} else { 
    	    $num_mois = $mois ; 
		}
		
    	 /* Nom long des jours */
    	$noml_jour[0]  =   "dimanche";
    	$noml_jour[1]  =   "lundi";
    	$noml_jour[2]  =   "mardi";
    	$noml_jour[3]  =   "mercredi";
    	$noml_jour[4]  =   "jeudi";
    	$noml_jour[5]  =   "vendredi";
    	$noml_jour[6]  =   "samedi";
    	 /* Nom court des jours */
    	$nomc_jour[0]  =   "dim";
    	$nomc_jour[1]  =   "lun";
    	$nomc_jour[2]  =   "mar";
    	$nomc_jour[3]  =   "mer";
    	$nomc_jour[4]  =   "jeu";
    	$nomc_jour[5]  =   "ven";
    	$nomc_jour[6]  =   "sam";
		
    	 /* Nom long des mois */
    	$noml_mois[1]    =   "janvier";
    	$noml_mois[2]    =   "f&eacute;vrier";
    	$noml_mois[3]    =   "mars";
    	$noml_mois[4]    =   "avril";
    	$noml_mois[5]    =   "mai";
    	$noml_mois[6]    =   "juin";
    	$noml_mois[7]    =   "juillet";
    	$noml_mois[8]    =   "ao&ucirc;t";
    	$noml_mois[9]    =   "septembre";
    	$noml_mois[10]   =   "octobre";
    	$noml_mois[11]   =   "novembre";
    	$noml_mois[12]   =   "d&eacute;cembre";
    	 /* Nom court des mois */
    	$nomc_mois[1]    =   "jan";
    	$nomc_mois[2]    =   "f&eacute;v";
    	$nomc_mois[3]    =   "mars";
    	$nomc_mois[4]    =   "avr";
    	$nomc_mois[5]    =   "mai";
    	$nomc_mois[6]    =   "juin";
    	$nomc_mois[7]    =   "juil";
    	$nomc_mois[8]    =   "ao&ucirc;t";
    	$nomc_mois[9]    =   "sept";
    	$nomc_mois[10]   =   "oct";
    	$nomc_mois[11]   =   "nov";
    	$nomc_mois[12]   =   "d&eacute;c";
		
    	 /* Affichage du jour */
    	switch ($modejour) {
    	    case  "l":
    	    $jour = $noml_jour[$num_jour]. ' '.$jour;                 // samedi 23
    	    break;
    	    case  "L":
    	    $jour = ucfirst($noml_jour[$num_jour]). ' '.$jour;         // Samedi 23
    	    break;
    	    case  "c":
    	    $jour = $nomc_jour[$num_jour]. ' '.$jour;                 // sam 23
    	    break;
    	    case  "C":
    	    $jour = ucfirst($nomc_jour[$num_jour]). ' '.$jour;         // Sam 23
    	    break;
    	    case  "h":
    	    $jour =  '';
    	    break;
    	}                                                             // default : 23
    	 /* Affichage du mois */
    	switch ($modemois) {
    	    case  "l":
    	    $mois =  ' '.$noml_mois[$num_mois]. ' '.$annee;              // janvier 1999
    	    break;
    	    case  "L":
    	    $mois =  ' '.ucfirst($noml_mois[$num_mois]). ' '.$annee;     // Janvier 1999
    	    break;
    	    case  "c":
    	    $mois =  ' '.$nomc_mois[$num_mois]. ' '.$annee;              // jan 1999
    	    break;
    	    case  "C":
    	    $mois =  ' '.ucfirst($nomc_mois[$num_mois]). ' '.$annee;     // Jan 1999
    	    break;
    	    case  "h":
    	    $mois =  '';
    	    break;
    	    default:
    	    $mois =  '/'.$mois. '/'.$annee;                             // /08/1999
    	    break;
    	}
    	 /* Affichage de l'heure */
    	switch ($modeheure) {
    	    case  "l":
    	    $heure =  ' '.$hour.$aff_heure.$minute;                     // 23 heures 54
    	    break;
    	    case  "c":
    	    $heure =  ' '.$hour. 'h'.$minute;                             // 23h54
    	    break;
    	}
		
    	 /* Valeur retournée */
    	return $jour.$mois.$heure;
	}		



}

