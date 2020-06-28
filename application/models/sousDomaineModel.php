<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * summary
 */
class SousDomaineModel extends CI_Model
{
    /**
     * summary
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function recupererNomSousDomaine($domaine)
    {
    	$this->db->select('nom_sous_domaine,id')->from('SousDomaine');
    	$this->db->where('domaine_id', $domaine);
    	return $this->db->order_by('nom_sous_domaine', 'asc')->get()->result();
    }

   
    public function ajouter($domaine_id,$sous_domaine)
    {
    	$data = array('domaine_id' => $domaine_id, 'nom_sous_domaine' => $sous_domaine);
    	do {
    		$this->db->where($data);
    		$this->db->from('SousDomaine');
    		$num = $this->db->count_all_results();
    	}
    	while ($num >= 1); 
    		$resultat = $this->db->insert('SousDomaine', $data);
    		if ($resultat)
    		{
    			return $resultat;
    		} else {
    			return false;
    		}
    }

    public function supprimer_sous_domaine($domaine_id,$sous_domaine)
    {
    	$data = array('domaine_id' => urldecode($domaine_id), 'nom_sous_domaine' => urldecode($sous_domaine));
    	//var_dump($data);
    	$this->db->delete('SousDomaine',$data);
    }

    function modifier_sous_domaine($id,$domaine_id,$sous_domaine)
    {
        $data = array('domaine_id' => $domaine_id,'nom_sous_domaine' => $sous_domaine);
        $this->db->where('id', $id);
        return $this->db->update('SousDomaine', $data);
    } 
}

?>