<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * summary
 */
class DomaineModel extends CI_Model
{
    /**
     * summary
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function recupererNomDomaine()
    {
    	return $this->db->select('nom_domaine,id')->from('Domaine')->order_by('nom_domaine','asc')->get()->result();
    }
    
    public function ajouter($nom_domaine)
    {
    	$data = array('nom_domaine' => $nom_domaine);
    	//return $this->db->insert('Domaine', $data);
    	do {
    		$this->db->where('nom_domaine', $data['nom_domaine']);
    		$this->db->from('Domaine');
    		$num = $this->db->count_all_results();
    	}
    	while ($num >= 1) ;//{
    	    $result = $this->db->insert('Domaine', $data);
    	//}
    	    if ($result)
    	    {
    	    	return $result;
    	    } else {
              //  echo $nom_domaine ." existe déjà!";
    	    	return false;
    	    }
    }

    function recupererIdDomaine($nom_domaine)
    {
    	return $this->db->select('id')->where('nom_domaine', $nom_domaine)->get('Domaine')->result();
    }

    public function supprimer($nom_domaine)
    {
    	
    	$id = $this->recupererIdDomaine($nom_domaine);
    	$data = array('id' => $id);
    	$data['nom_domaine'] = urldecode($nom_domaine);
    	//var_dump($data['id'][0]->id);
    	//$this->db->where('id', $data['id']);
    	$this->db->delete('Domaine', array('nom_domaine' => $data['nom_domaine']));
    	//$this->db->delete('Domaine',array('id' => $data['id'][0]->id));
    }

    function total_enregistrer()
    {
        return $this->db->count_all_results('Domaine');
    }

    function modifier_domaine($id,$nom_domaine)
    {
        $data = array('nom_domaine' => $nom_domaine);
        
        $this->db->where('id', $id);
        return $this->db->update('Domaine', $data);
    }
}


?>